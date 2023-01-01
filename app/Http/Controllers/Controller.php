<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\Referral;
use App\Models\Setting;
use App\UniqeCode;
use App\Theme;
use Auth;
use File;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Image;
use Session;
use View;
use App\Mail\NotifMail;
use Mail;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $paymentDetail = [
        '702' => ['/images/payment_channel/Logo-Bank-BCA.png', 'va'], // virtual account
        '800' => ['/images/payment_channel/bri-1.png', 'va'], // virtual account
        '802' => ['/images/payment_channel/MANDIRI.png', 'va'], // virtual account
        '801' => ['/images/payment_channel/bni.png', 'va'], // virtual account
        '402' => ['/images/payment_channel/permataa.png', 'va'], // virtual account
        '408' => ['/images/payment_channel/maybank.png', 'va'], // virtual account
        '818' => ['/images/payment_channel/logoj-300x72.png', 'va'], // virtual account
        '825' => ['/images/payment_channel/cimb-1.png', 'va'], // virtual account
        '825' => ['/images/payment_channel/cimb-1.png', 'va'], // virtual account
        '708' => ['/images/payment_channel/danamon.png', 'va'], // virtual account
        '401' => ['/images/payment_channel/bri-epay.png', 'ib'], // internet banking
        '405' => ['/images/payment_channel/bca-klikpay.png', 'ib'], // internet banking
        '700' => ['/images/payment_channel/OCTO-Clicks-600-x-175px.png', 'ib'], // internet banking
        '701' => ['/images/payment_channel/danamon.png', 'ib'], // internet banking
        '814' => ['/images/payment_channel/maybank-1.png', 'ib'], // internet banking
        '404' => ['/images/payment_channel/klikbca200.jpg', 'ib'], // internet banking
        '420' => ['/images/payment_channel/permata-net.png', 'ib'], // internet banking
        '810' => ['/images/payment_channel/b-secure.png', 'od'], // online debit
        '709' => ['/images/payment_channel/kredivo-1.png', 'oc'], // online credit
        '807' => ['/images/payment_channel/akulaku.png', 'oc'], // online credit
        '820' => ['/images/payment_channel/logo-indodana.png', 'oc'], // online credit
        '711' => ['/images/payment_channel/Logo-ShopeePay-QRIS.png', 'qp'], // qris payment
        '713' => ['/images/payment_channel/Logo-ShopeePay.png', 'em'], // e money
        '812' => ['/images/payment_channel/ovo-copy.png', 'em'], // e money
        '819' => ['/images/payment_channel/BALANCE-copy.png', 'em'], // e money
        '716' => ['/images/payment_channel/linkaja-logo.png', 'em'], // e money
        '704' => ['/images/payment_channel/sakuku.png', 'em'], // e money
        '302' => ['/images/payment_channel/linkaja-logo.png', 'em'], // e money
        '706' => ['/images/payment_channel/indomart.png', 'rp'], // retail payment
        '707' => ['/images/payment_channel/ALFAgroup-copy.png', 'rp'], // retail payment
        '400' => ['/images/payment_channel/bri-1.png', 'rp'], // etc
        '410' => ['/images/payment_channel/unicount-logo-002.jpg', 'rp'], // etc
    ];
    public $theme = null;

    public function getWithCache($model, $name) {
        $count = Redis::get('_'.$name);
        if($model->count() != $count) {
            Redis::set($name, json_encode($model));
            Redis::set('_'.$name, $model->count());
        }else{
            $model = json_decode(Redis::get($name));
        }
        return $model;
    }

    public function __construct()
    {
        $web_set = Setting::find(1);
        $meta = new \stdClass();
        $meta->title = envdb('APP_NAME');
        $meta->description = envdb('APP_NAME')."- Bayar Donasi Waqaf Infaq dan Qurban dengan mudah dimana saja dan kapan saja";
        $meta->type = "website";
        $meta->url = url('/');
        $meta->icon = asset('storage/'.$web_set->path_icon);

        if($web_set->path_logo){
            $meta->image = asset('storage/' . $web_set->path_logo);
        }else{
            $meta->image = asset('assets/media-berbagi/assets/images/website/logo-media-berbagi.png');
        }

        $this->loadTheme();

        Session::put('web_set', $web_set);
        View::share('web_set', $web_set);
        View::share('meta', $meta);
    }

    public function loadTheme() {
        $theme = Theme::where("active", true)->first();
        if($theme != null){
            $this->theme = $theme;
            $this->theme->script = json_decode($theme->script);
        }
    }

    public function setWeb()
    {
        $web_set = Setting::find(1);
        Session::put('web_set', $web_set);
        View::share('web_set', $web_set);
        return $web_set;
    }

    public function slugify($text)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
    }

    public static function form_meta($field, $param = 0)
    {
        if ($field == "bank") {
            $datas = Bank::all();
        }

        return $datas;
    }

    public static function get_value($field = "", $param = 0, $target = "", $default = "-")
    {
        $data = null;

        if ($field == "bank") {
            $data = Bank::where('id', $param)
                ->first();
        }

        if ($target == "") {
            return $data;
        }
        if (!empty($data)) {
            return $data->$target;
        }
        return $default;
    }

    public static function date_to_idn($date)
    {
        if($date != null) {
            $explode = explode('-', $date);
            $month = self::get_idn_month($explode[1]);
            return $explode[2] . ' ' . $month . ' ' . $explode[0];
        }else{
            return "-";
        }
    }

    public static function get_idn_month($month)
    {
        $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        if ((int) $month > 0 && (int) $month <= 12) {
            return $months[(int) $month];
        } else {
            return '';
        }
    }

    public function getIcon($method)
    {
        switch ($method) {
            case 'Maybank Virtual Account':
                return 'images/bank/maybank.webp';
            case 'Permata Virtual Account':
                return 'images/bank/permata.webp';
            case 'BNI Virtual Account':
                return 'images/bank/bniva.webp';
            case 'BRI Virtual Account':
                return 'images/bank/briva.webp';
            case 'Mandiri Virtual Account':
                return 'images/bank/mandiri.webp';
            case 'BCA Virtual Account':
                return 'images/bank/bcava.webp';
            case 'Muamalat Virtual Account':
                return 'images/bank/muamalat.webp';
            case 'Sinarmas Virtual Account':
                return 'images/bank/sinarmas.webp';
            case 'BRI Virtual Account (Open Payment)':
                return 'images/bank/briva.webp';
            case 'BNI Virtual Account (Open Payment)':
                return 'images/bank/bniva.webp';
            case 'CIMB Niaga Virtual Account (Open Payment)':
                return 'images/bank/cimb.webp';
            case 'BCA Virtual Account (Open Payment)':
                return 'images/bank/bcava.webp';
            case 'Alfamart':
                return 'images/bank/alfamart.webp';
            case 'Alfamidi':
                return 'images/bank/alfamidi.webp';
            case 'QRIS':
                return 'images/bank/qris.webp';
            case 'Dompet Abudar':
                return 'images/logo.png';

            default:
                return 'images/bank/default.png';
                break;
        }
    }

    public function paymentMethod($type = 'all')
    {
        $ewallet = [];
        $wallet = [];
        $stores = [];
        $instants = [];
        $banks = Bank::all();

        if ($type == 'bank') {

            foreach ($banks as $key => $value) {
                $value->request_code = 'bank-' . $value->id . '-' . $value->bank_name;
                $value->fee = 0;
            }
        }
        if ($type == 'instant') {
            $baseUrl = config('app.tripay_url');
            $apiKey = config('app.tripay_api_key');

            $client = new Client([
                'base_uri' => $baseUrl,
            ]);
            $response = $client->get('merchant/payment-channel', [
                'headers' => [
                    'authorization' => 'Bearer ' . $apiKey,
                    'accept' => 'Application/json',
                ],
                'http_errors' => false,
            ]);

            $status = $response->getStatusCode();
            if ($status == 200) {
                $body = json_decode($response->getBody())->data;
                foreach ($body as $key => $value) {
                    if ($value->active) {
                        if ($value->group == 'Convenience Store') {
                            $value->icon = $this->getIcon($value->name);
                            $value->service_name = $value->name;
                            $value->request_code = 'stores-' . $value->code . '-' . $value->name;
                            $stores[] = $value;
                        } else {
                            if ($value->name == 'QRIS') {
                                $value->icon = $this->getIcon($value->name);
                                $value->service_name = $value->name;
                                $value->request_code = 'ewallet-' . $value->code . '-' . $value->name;
                                $ewallet[] = $value;
                            } else {
                                $value->icon = $this->getIcon($value->name);
                                $value->service_name = $value->name;
                                $value->request_code = 'instant-' . $value->code . '-' . $value->name;
                                $instants[] = $value;
                            }
                        }
                    }
                }
            }
        }

        if ($type == 'all') {
            $accounts = [
                'ewallet' => $ewallet,
                'instant' => $instants,
                'bank' => $banks,
                'stores' => $stores,
            ];

            if (Auth::check()) {
                $wallet = [
                    [
                        'name' => 'Dompet Forfund',
                        'service_name' => 'dompet',
                        'icon' => 'images/logo.png',
                        'request_code' => 'wallet-dompet-Dompet Forfund',
                    ],
                ];

                $accounts['wallet'] = $wallet;
            }

        } else {
            $accounts = $banks;
        }

        return $accounts;
    }

    public static function generatePhone($phone)
    {
        if ($phone[0] == '+') {
            $phone = str_replace('+', '', $phone);
        }

        if ($phone[0] == 0) {
            return '62' . substr($phone, 1, strlen($phone));
        } else {
            return $phone;
        }
    }

    public static function sendWa($phone, $message)
    {
        $client = new Client();
        $response = $client->post('https://goowa.id/api/send_message', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'token' => envdb("RUANGWA_TOKEN"),
                'number' => $phone,
                'message' => $message,
                'date' => date('Y-m-d'),
                'time' => date('H:i:s'),
            ],
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            $output = json_decode($stringBody);
            return $output;
        }else{
            return null;
        }
    }

    public function success($data)
    {
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $data,
        ], 200);
    }
    public function error($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
        ], $code);
    }

    public function resizeImage($file, $path = null, $width = null)
    {
        $path = 'uploads/' . ($path ?? 'resized_image') . '/';
        $fullpath = storage_path('/app/public/') . $path;
        $size = $width ?? 250;

        File::isDirectory($fullpath) or File::makeDirectory($fullpath, 0777, true, true);
        $fileName = Date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $resizeImage = Image::make($file)->resize(null, $size, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resizeImage->save(storage_path('/app/public/') . $path . $fileName);
        return $path . $fileName;
    }

    public function number($amount, $currency = false)
    {
        if ($currency == true) {
            return 'Rp.' . number_format($amount, 0, ',', '.');
        } else {
            return number_format($amount, 0, ',', '.');
        }
    }

    public function getUnique()
    {
        $u = UniqeCode::find(1);
        if ($u) {
            if ($u->code >= 0) {
                if ($u->code <= 888) {
                    $u->code += 1;
                    $u->save();
                } else {
                    $u->code = 0;
                    $u->save();
                }
            } else {
                UniqeCode::create([
                    'code' => 0,
                ]);
            }
        } else {
            UniqeCode::create([
                'code' => 0,
            ]);
            return 0;
        }

        return $u->code;
    }

    // public function paymentGroup() {
    //     $group = [
    //         'Virtual Account' => ['702', '800', '802', '801', '402', '408', '818', '825'],
    //         'Internet Banking' => ['401', '405', '700', '701', '814', '404'],
    //         'Online Debit' => ['810'],
    //         // 'Direct Debit' => []
    //         'Online Credit' => ['709', '807', '820'],
    //         // 'Credit Card' => [],
    //         'QRIS Payment' => ['711'],
    //         'E-Money' => ['812', '819', '716', '704', '302'],
    //         // 'Mobile Banking' => [],
    //         'Lain - lain' => ['400', '410'],
    //     ];
    // }

    public function paymentAll()
    {
        if (envdb('MERCHANT_NAME') == null) {
            return [];
        }
        $baseUrl = envdb('MERCHANT_URL');

        $signature = sha1(md5((envdb('MERCHANT_USER') . envdb('MERCHANT_PASSWORD'))));

        $client = new Client();
        $response = $client->post($baseUrl . 'cvr/100001/10', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            RequestOptions::JSON => [
                'request' => 'Request List of Payment Gateway',
                'merchant_id' => envdb('MERCHANT_ID'),
                'merchant' => envdb('MERCHANT_NAME'),
                'signature' => $signature,
            ],
            'http_errors' => false,
        ]);

        $payment;

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            if ($stringBody == null || $stringBody == "") {
                // $payment = $stringBody;
                $payment = [];
            } else {
                $json = json_decode($stringBody);
                $payment = $json->payment_channel;
                $group = [];
                foreach ($payment as $p) {
                    $p->pg_detail = $this->paymentDetail[$p->pg_code];
                    if (isset($group[$this->paymentDetail[$p->pg_code][1]])) {
                        array_push($group[$this->paymentDetail[$p->pg_code][1]], $p);
                    } else {
                        $group[$this->paymentDetail[$p->pg_code][1]] = [$p];
                    }
                }
                $payment = $group;
            }
        } else {
            abort(404);
        }
        return $payment;

    }

    public function callback(Request $data)
    {
        $funding = Funding::where('reference', $data->trx_id)->first();
        if ($funding == null) {
            abort(404);
        } else {
            return redirect('/donation/' . $funding->id)->with([
                'success' => 'Transaksi anda telah disimpan, silahkan melakukan pembayaran',
            ]);
        }
    }

    public function payment_notification(Request $data)
    {
        $user_id = envdb('MERCHANT_USER');
        $passw = envdb('MERCHANT_PASSWORD');

        // $data_notif = file_get_contents('php://input');

        // $data = json_decode($data_notif);

        $signature = sha1(md5(($user_id . $passw . $data->bill_no . $data->payment_status_code)));

        // ======= Make Signature Validation =====
        if ($data->signature == $signature) {

            /* ====== Update Transaction Status ==== */
            if ($data->payment_status_code == '2') {

                /* === update your transaction status === */
                $datas = array(
                    "response" => "Payment Notification",
                    "trx_id" => $data->trx_id,
                    "merchant_id" => $data->merchant_id,
                    "merchant" => $data->merchant,
                    "bill_no" => $data->bill_no,
                    "response_code" => "00",
                    "response_desc" => "Success",
                    "response_date" => date('Y-m-d H:is'),
                );

                $response = json_encode($datas);

                echo $response;
                $red = Funding::where('reference', $data->trx_id)->first();
                if ($red == null) {
                    abort(404);
                }

                if ($red->referral_id != null) {
                    $referral = Referral::where('id', $red->referral_id)->first();
                    if ($referral) {

                        $referral->update([
                            'referred' => $referral->referred + 1,
                            'collected' => $referral->collected + $red->nominal,
                        ]);
                    }
                }
                $db = Funding::where('reference', $data->trx_id)->update([
                    'status' => 'paid',
                ]);

                if ($db) {
                    if ($red['donature_email'] != null) {
                        Mail::to($red['donature_email'])->send(new PaySucceed($red, $project));
                        echo "email sent";
                    }
                    if ($red['donature_phone'] != null) {
                        self::sendWa($red['donature_phone'], 'Terima kasih, Donasi untuk program ' . $project['title'] . '\nSenilai Rp ' . number_format($red['total'], 0, ',', '.') . '\n*Sudah kami terima dan sudah disalurkan.\n\nSemoga berkah rezekinya dalam kehidupannya.\n\n*Ajrakallaahu fiima a\'thoita, Wa baraka fii ma abqoita, waj\'alhu laka Thohuuroo\n(Semoga Allah membalas segala sesuatu yg Engkau berikan dengan segala kebaikan darinya, dan menjadikan Rezeki yang tersisa sebagai keberkahan, dan rezeki yang diberikan itu Menjadi pembersih bagi harta dan rezekimu wahai saudaraku).');
                        echo "wa sent";
                    }
                } else {
                    abort(500);
                }

            } else {
                abort(500);
            }
        } else {
            abort(500);
        }
    }

    // $this->templateMessage([
    //     "type" => "reminder",
    //     "funding" => $fund,
    // ]);

    public function templateMessage($data = []) {
        $setting = Setting::whereIn('key', ['donation_reminder', 'donation_thanks'])
            ->pluck('value', 'key');
        $reminder = $setting['donation_reminder'];
        $thanks = $setting['donation_thanks'];

        if($data["type"] == "reminder") {

            $funding = $data["funding"];

            $inv = "INV-" . date('ymd').sprintf("%05d", $funding->id);
            if($funding->project == null) {
                $title = "Program instan ".$funding->fund_type;
            }else{
                $title = $funding->project->title;
            }

            $reminder = str_replace("<<app_name>>", envdb("APP_NAME"), $reminder);
            $reminder = str_replace("<<invoice_number>>", $inv, $reminder);
            $reminder = str_replace("<<campaign_name>>", $title, $reminder);
            $reminder = str_replace("<<donation_amount>>", "Rp".$funding->nominal, $reminder);
            $reminder = str_replace("<<payment_method>>", $funding->payment_method, $reminder);
            $reminder = str_replace("<<time_limit>>", $funding->time_limit, $reminder);
            $reminder = str_replace("<<donature_name>>", $funding->donature_name, $reminder);
            $reminder = str_replace("<<payment_link>>", url("donation/".$inv), $reminder);
            if($funding->payment_type == "virtualaccount") {
                $reminder = str_replace("<<virtual_account>>", $funding->reference, $reminder);
            }else{
                $reminder = str_replace("<<virtual_account>>", "", $reminder);
            }

            if($funding->donature_phone != null) {
                self::sendWa($funding->donature_phone,$reminder);
            }
            if($funding->donature_email != null) {
                $html = new \stdClass();
                $html->title = "Reminder pembayaran donasi";
                $html->content = str_replace("\n","<br/>",$reminder);
                Mail::to($funding->donature_email)->send(new NotifMail($html));
            }

        }else{
            $funding = $data["funding"];

            $inv = "INV-" . date('ymd').sprintf("%05d", $funding->id);
            if(isset($funding->project)) {
                $title = $funding->project->title;
            }else{
                $title = "Program instan ".$funding->fund_type;
            }

            $thanks = str_replace("<<app_name>>", envdb("APP_NAME"), $thanks);
            $thanks = str_replace("<<invoice_number>>", $inv, $thanks);
            $thanks = str_replace("<<campaign_name>>", $title, $thanks);
            $thanks = str_replace("<<donation_amount>>", "Rp".$funding->nominal, $thanks);
            $thanks = str_replace("<<payment_method>>", $funding->payment_method, $thanks);
            $thanks = str_replace("<<time_limit>>", $funding->time_limit, $thanks);
            $thanks = str_replace("<<donature_name>>", $funding->donature_name, $thanks);
            $thanks = str_replace("<<payment_link>>", url("donation/".$inv), $thanks);

            if($funding->donature_phone != null) {
                self::sendWa($funding->donature_phone,$thanks);
            }
            if($funding->donature_email != null) {
                $html = new \stdClass();
                $html->title = "Pembayaran donasi berhasil";
                $html->content = str_replace("\n","<br/>",$thanks);
                Mail::to($funding->donature_email)->send(new NotifMail($html));
            }
        }
    }

    public function getRandom()
    {
        $nominal = Session::get('nominal');
        $method = Session::get('payment');

        $number = mt_rand(100, 500);
        $check = Funding::where('nominal', $nominal)
            ->where('status', 'pending')
            ->where('unique_code', $number)
            ->first();

        if ($check) {
            return $this->getRandom();
        } else {
            return $number;
        }
    }

    public function usernamify($name)
    {
        $checkSpace = explode(' ', $name);
        if (count($checkSpace) == 1) {
            if(strlen($name) == 1){
                return $name;
            }else{
                return strtoupper($name[0] . $name[1]);
            }
        } else {
            return strtoupper($checkSpace[0][0] . $checkSpace[1][0]);
        }

        return "00";
    }

    public function getProvinces()
    {
        return [
            'Nanggroe Aceh Darussalam',
            'Sumatera Utara',
            'Sumatera Selatan',
            'Sumatera Barat',
            'Bengkulu',
            'Riau',
            'Kepulauan Riau',
            'Jambi',
            'Lampung',
            'Bangka Belitung',
            'Banten',
            'DKI Jakarta',
            'Jawa Barat',
            'Jawa Tengah',
            'DI Yogyakarta',
            'Jawa timur',
            'Kalimantan Barat',
            'Kalimantan Timur',
            'Kalimantan Selatan',
            'Kalimantan Tengah',
            'Kalimantan Utara',
            'Bali',
            'Nusa Tenggara Timur',
            'Nusa Tenggara Barat',
            'Gorontalo',
            'Sulawesi Barat',
            'Sulawesi Tengah',
            'Sulawesi Utara',
            'Sulawesi Tenggara',
            'Sulawesi Selatan',
            'Maluku Utara',
            'Maluku',
            'Papua',
            'Papua Barat',
        ];
    }

    public function referralClick(Request $request)
    {
        if ($request->r) {
            $fundraiser = Fundraiser::where('referral_code', $request->r)
                ->first();
            $clicks = $fundraiser->clicks + 1;
            if ($fundraiser) {
                $fundraiser->update([
                    'clicks' => $clicks,
                ]);
            }
        }

        return true;
    }

    // scrapping harga emas
    public function getHargaEmas()
    {
        $url = "https://www.hargaemas.com/";
        $html = file_get_contents($url);
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        // xpath document.querySelectorAll(".price-current")[2].innerHTML
        $price = $xpath->query('//*[@class="price-current"]')->item(2)->nodeValue;

        return str_replace(".", "", $price);
    }

}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Controller;
use App\Mail\PayReminder;
use App\Models\Funding;
use App\Models\Project;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Mail;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email and wa reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pending = Funding::where('status', 'pending')
        ->where('time_limit', '>=', now())
        ->get();

        foreach ($pending as $key => $value) {
            $project = Project::find($value->project_id);
            $payment = null;
            $limit = Date('d F Y H:i', strtotime($value->time_limit)).' WIB';

            $baseUrl = config('app.tripay_url');
            $apiKey = config('app.tripay_api_key');

            $client = new Client([
                'base_uri' => $baseUrl
            ]);
            $response = $client->get('transaction/detail', [
                'headers' => [
                    'authorization' => 'Bearer '.$apiKey,
                    'accept' => 'Application/json'
                ],
                'http_errors' => false,
                'query' => [
                    'reference' => $value->reference,
                ]
            ]);
            $inv = date('ymd').sprintf("%05d", $value->id);

            $status = $response->getStatusCode();
            if($status == 200){
                echo("Payment parsed\n");
                $payment = json_decode($response->getBody())->data;

                if($value->donature_email != null){
                    Mail::to($value->donature_email)->send(new PayReminder($value, $inv, $project, $payment, $limit));
                    echo("- Email sent\n");
                }
                if($value->donature_phone != null){
                    Controller::sendWa($value->donature_phone, "Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nTerima kasih telah berniat untuk investasi akhirat di Forfund.\n\nKami hanya ingin mengingatkan niat baik Bapak/Ibu untuk berinvestasi akhirat di Forfund\nPahala besar dan keberkahan sudah menunggu segera tunaikan niat baik Anda\n\nIni Nomor Transaksinya : INV-".$inv."\nWakaf untuk program: ".$project->title.".\nTinggal selangkah lagi pahala Anda langsung mengalir in syaa Allah.\n\nSilahkan transfer sejumlah Rp ".number_format($payment->amount,0,",",".")."\n(Pastikan nominal transfernya sama persis, agar bisa kami konfirmasi dengan tepat)\n\nPembayaran dengan: ".$value->payment_method."\nLakukan sebelum ".date("d M Y H:i", strtotime($value->created_at))."\n\nSemoga niat baik kita semua, dimudahkan oleh Allah.\n\nSilahkan simpan kontak ini sebagai Admin Amal Forfund untuk mendapatkan info terkait program lainnya.\n\nTerima kasih.");
                    echo("-- wa sent\n");
                }
            }
        }
    }
}

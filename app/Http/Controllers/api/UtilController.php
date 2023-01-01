<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UtilController extends Controller
{
    public function zakatType()
    {
    	return $this->success([
    		[
    			'type' => 'Zakat Harta',
    			'description' => 'zakat yang dikenakan atas harta yang dimiliki oleh individu dengan syarat-syarat dan ketentuan-ketentuan yang telah ditetapkan secara syarak.'
    		],
    		[
    			'type' => 'Zakat Emas & Perak',
    			'description' => 'zakat yang wajib dikeluarkan oleh seorang muslim yang mempunyai emas dan perak bila telah mencapai nisab dan haul.'
    		],
    		[
    			'type' => 'Zakat Perdagangan',
    			'zakat yang dikeluarkan atas kepemilikan harta yang diperuntukkan untuk jual-beli.'
    		],
    		[
    			'type' => 'Zakat Pertanian',
    			'merupakan salah satu jenis zakat maal, objeknya meliputi hasil tumbuh-tumbuhan atau tanaman yang bernilai ekonomis seperti biji-bijian, umbi-umbian, sayur-mayur, buah-buahan, tanaman hias, rumput-rumputan, dedaunan, dll.'
    		],
    		[
    			'type' => 'Zakat Harta Karun',
    			'description' => 'zakat yang wajib dikeluarkan untuk barang yang ditemukan terpendam di dalam tanah, atau yang biasa disebut dengan harta karun. Zakat barang temuan tidak mensyaratkan baik haul (lama penyimpanan) maupun nisab (jumlah minimal untuk terkena kewajiban zakat), sementara kadar zakatnya adalah sebesar seperlima atau 20% dari jumlah harta yang ditemukan. Jadi setiap mendapatkan harta temuan berapapun besarnya, wajib dikeluarkan zakatnya sebesar seperlima dari besar total harta tersebut.'
    		],
    	]);
    }


    public function nishabPrice()
    {
        $gold_price = Setting::where('key', 'gold_price')
        ->pluck('value')
        ->first() ?? 0;
        $silver_price = Setting::where('key', 'silver_price')
        ->pluck('value')
        ->first() ?? 0;
        
        try{
            $emas_url = config('app.emas_url', 'http://wamazing.asia:3005');
            $client = new Client([
                'base_uri' => $emas_url
            ]);
            $response = $client->get("/", [
                'http_errors' => false,
            ]);
            $status = $response->getStatusCode();
            if($status == 200){
                $body = json_decode($response->getBody())->data;
                if(count($body) == 2){
                    $gold_price = $this->reformatPrice($body[0]->current_price);
                    $silver_price = $this->reformatPrice($body[1]->current_price);
                }
            }
        }catch(RequestException $e){
            // #E
        }

        return $this->success([
            'gold_price' => $gold_price,
            'silver_price' => $silver_price,
        ]);
    }

    private function reformatPrice($price)
    {
        $format = str_replace("Rp", "", $price);
        $format = str_replace(".", "", $format);
        $format = str_replace(",00", "", $format);

        return $format;
    }
}

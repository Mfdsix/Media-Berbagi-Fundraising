<?php

namespace App\Http\Controllers\Gateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\TripayController as Tripay;
use Cekmutasi;
use App\Models\Funding;

class CekMutasiController extends Controller
{

	public static function methodList(){
		$bank = Cekmutasi::bank()->list();
		return $bank->data;
	}


	public static function callback(){
		$cekmutasi = array(
			"api_signature" => config('app.cekmutasi_sign')
		);

		$incomingApiSignature = isset($_SERVER['HTTP_API_SIGNATURE']) ? $_SERVER['HTTP_API_SIGNATURE'] : '';

		if( !hash_equals($cekmutasi['api_signature'], $incomingApiSignature) ) {
			exit("Invalid Signature");
		}

		$post = file_get_contents("php://input");
		$json = json_decode($post);

		if( json_last_error() !== JSON_ERROR_NONE ) {
			exit("Invalid JSON");
		}

		if( $json->action == "payment_report" )
		{
			$paymentMethod = [
				'service_name' => $json->content->service_name,
				'service_code' => $json->content->service_code,
				'account_number' => $json->content->account_number,
				'account_name' => $json->content->account_name,
			];

			foreach( $json->content->data as $data )
			{
				$time = $data->unix_timestamp;
				$type = $data->type;
				$amount = $data->amount;
				$description = $data->description;
				$balance = $data->balance;

				if( $type == "credit" )
				{
					$check = Funding::where('total', $amount)
					->where('status', 'pending')
					->first();

					if($check){
						$check->update([
							'status' => 'paid'
						]);
					}

					echo "ok";
				}
			}
		}
	}

}
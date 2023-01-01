<?php

namespace App\Http\Controllers\Gateway;

use Illuminate\Http\Request;
use App\Models\Funding;
use App\Models\Project;
use App\Models\Topup;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\Controller;
use App\Mail\PaySucceed;
use App\User;
use Mail;

class TripayController extends Controller
{
	public static function methodList(){
		$methods = [];
		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');

		$client = new Client([
			'base_uri' => $baseUrl
		]);
		$response = $client->get('merchant/payment-channel', [
			'headers' => [
				'authorization' => 'Bearer '.$apiKey,
				'accept' => 'Application/json'
			],
			'http_errors' => false,
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			$body = json_decode($response->getBody())->data;
			foreach ($body as $key => $value) {
				if($value->active){
					$methods[] = $value;
				}
			}
		}

		return $methods;
	}

	public static function callback(){
		$privateKey = config('app.tripay_private_key');
		$json = file_get_contents("php://input");

		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

		$signature = hash_hmac('sha256', $json, $privateKey);
		if( $callbackSignature !== $signature ) {
			exit("Invalid Signature");
		}

		$data = json_decode($json);
		$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];

		if( $event == 'payment_status' )
		{
			if( $data->status == 'PAID' )
			{
				$check = Funding::where('reference', $data->reference)
				// ->where('total', $data->total_amount)
				->where('status', 'pending')
				->first();
				

				if($check){

					$project = Project::find($check['project_id']);
					
					$check->update([
						'status' => 'paid'
					]);

					if($check['donature_email'] != null){
						Mail::to($check['donature_email'])->send(new PaySucceed($check, $project));
					}
					if($check['donature_phone'] != null){
						self::sendWa($check['donature_phone'], "Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nAlhamdulillah investasi akhirat Anda sebesar Rp ".number_format($check['nominal'],0,',','.')." telah kami terima\n\nKami berdoa semoga membalasnya dengan pahala yang besar dan tidak putus putus nya. Menambahkan keberkahan pada harta yang tersisa dan memberikan kebahagiaan bagi Anda dan keluarga. Serta Allah mudahkan semua urusan Anda.\nAmin Ya Robbal Alamin\n\nTerima kasih.");
					}
				}

			}else{
				print_r("Not Found");
				return;
			}
		}
		echo json_encode(['success' => true]);
		return;
	}

	public static function topup(){
		$privateKey = config('app.tripay_private_key');
		$json = file_get_contents("php://input");

		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

		$signature = hash_hmac('sha256', $json, $privateKey);
		if( $callbackSignature !== $signature ) {
			exit("Invalid Signature");
		}

		$data = json_decode($json);
		$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];

		if( $event == 'payment_status' )
		{
			if( $data->status == 'PAID' )
			{
				$check = Topup::where('reference', $data->reference)
				->first();

				if($check){

					$check->update([
						'status' => 1
					]);

					$user = User::where('id', $check->user_id)
					->first();

					if($user){
						$user->update([
							'saldo' => $user->saldo + $check->nominal,
						]);
					}
				}else{
					echo json_encode(['success' => false, 'message' => 'Transaction Not Found']);
					return;
				}
			}
		}

		echo json_encode(['success' => true]);
		return;
	}
}

<?php

namespace App\Http\Controllers\Gateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\TripayController as Tripay;
use App\Http\Controllers\Gateway\CekMutasiController as CekMutasi;

class MainController extends Controller
{
	public static function methodList(){
		$accounts = [
			'bank' => [],
			'instant' => []
		];
		
		$accounts['bank'] = CekMutasi::methodList();
		$accounts['instant'] = Tripay::methodList();

		return $accounts;
	}

	public static function callback($provider = "cek-mutasi"){
		switch ($provider) {
			case 'cek-mutasi':
			CekMutasi::callback();
			break;
			case 'tripay':
			Tripay::callback();
			break;
		}
	}
}

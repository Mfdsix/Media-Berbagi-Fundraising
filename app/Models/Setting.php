<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $table = 'settings';
    protected $guarded = [
    	'id'
    ];

    public static function get($key){
		return Setting::where('key', $key)
		->pluck('value')
		->first();
	}

	public static function set($data = []){
		foreach ($data as $key => $value) {
			$check = Setting::where('key', $key)
			->first();

			if(!$check){
				Setting::create([
					'key' => $key,
					'value' => $value
				]);
			}else{
				$check->update([
					'value' => $value
				]);
			}	
		}

		return true;
	}
}

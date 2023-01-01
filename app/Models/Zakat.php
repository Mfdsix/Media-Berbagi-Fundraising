<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
	protected $table = 'zakats';
	protected $guarded = [
		'id'
	];
	protected $casts = [
		'detail' => 'array'
	];
}

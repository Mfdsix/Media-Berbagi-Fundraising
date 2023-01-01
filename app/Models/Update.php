<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
	public $table = 'updates';
	protected $guarded = [
		'id', 'created_at', 'updated_at'
	];

	public function project(){
		return $this->hasOne('App\Models\Project', 'id', 'project_id');
	}

	public function withdrawal(){
		return $this->hasOne('App\Models\Withdrawal', 'id', 'target_id');
	}
}

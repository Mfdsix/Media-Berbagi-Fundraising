<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $guarded = [
    	'id'
    ];

    public function project(){
    	return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }

    public function fundraiser(){
    	return $this->hasOne('App\Models\Fundraiser', 'user_id', 'user_id');
    }
}

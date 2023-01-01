<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $guarded = [
    	'id'
    ];

    public function project(){
    	return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
}

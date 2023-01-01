<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $table = 'banks';
    protected $guarded = [
    	'id'
    ];
}

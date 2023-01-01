<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    public $table = 'docs';
    protected $guarded = [
    	'id'
    ];
}

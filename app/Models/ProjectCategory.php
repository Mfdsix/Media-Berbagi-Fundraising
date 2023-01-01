<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    public $table = 'project_categories';
    protected $guarded = [
    	'id'
    ];
}

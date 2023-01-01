<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectCategory;
use App\User;

class Funding extends Model
{
    public $table = 'fundings';
    protected $guarded = [
    	'id'
    ];

    public function project(){
    	return $this->belongsTo('App\Models\Project');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function category()
    {
        $project = $this->project;
        if($project){
           return ProjectCategory::find($this->project->category_id);
       }
       return null;
   }
   // relation with fudraiser
    public function fundraiser()
    {
        return $this->hasOne(User::class, 'id', 'referral_id');
    }
}
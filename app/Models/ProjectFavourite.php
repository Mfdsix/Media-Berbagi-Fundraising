<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFavourite extends Model
{
    protected $table = 'projects_favourite';
    protected $guarded = ['id'];

    public function project() {
        return $this->hasOne(Project::class, 'project_id', 'id');
    }
}

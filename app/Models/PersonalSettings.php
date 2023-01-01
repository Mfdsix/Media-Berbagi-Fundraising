<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalSettings extends Model
{
    protected $table = 'personal_settings';
    protected $guarded = ['id'];

    public function user() {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}

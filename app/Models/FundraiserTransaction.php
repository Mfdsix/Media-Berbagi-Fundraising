<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundraiserTransaction extends Model
{
    protected $guarded = ['id'];

    public function donation()
    {
        return $this->hasOne('App\Models\Funding', 'id', 'reference_id');
    }

    public function fundraiser()
    {
        return $this->hasOne('App\Models\Fundraiser', 'id', 'fundraiser_id');
    }
}

<?php

namespace App\Models;

use App\Models\Funding;
use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    protected $guarded = [
    	'id'
    ];

    // get all the fundraiser_transactions
    public function transactions()
    {
        $transaction = $this->hasMany('App\Models\FundraiserTransaction');
        $transaction = $transaction
        ->where('status', 'success')
        ->select('reference_id')
        ->get();

        $sum = 0;

        foreach ($transaction as $key => $value) {
            $fund = Funding::find($value->reference_id);
            $sum ++;
        }

        return $sum;
    }
    // get all the fundraiser_transactions
    public function collecteds()
    {
        $transaction = $this->hasMany('App\Models\FundraiserTransaction');
        $transaction = $transaction
        ->where('status', 'success')
        ->select('reference_id', 'status')
        ->get();

        $sum = 0;

        foreach ($transaction as $key => $value) {
            $fund = Funding::find($value->reference_id);
            if($fund != null) {
                $sum += $fund->total;
            }
        }

        return $sum;
    }
    // relation to funding
    public function funding()
    {
        return $this->hasMany('App\Models\Funding');
    }
}

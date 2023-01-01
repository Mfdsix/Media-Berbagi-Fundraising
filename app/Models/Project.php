<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Project extends Model
{
    public $table = 'projects';
    use SoftDeletes;
    protected $guarded = [
        'id',
    ];

    protected $mediaberbagi = 1; // 1%

    public function category()
    {
        return $this->hasOne('App\Models\ProjectCategory', 'id', 'category_id');
    }

    public function countDonation($referral = null)
    {
        $donations = $this->hasMany('App\Models\Funding', 'project_id', 'id')
            ->when($referral, function ($q) use ($referral) {
                return $q->where('referral_id', $referral);
            })
            ->where('fund_type', $this->type)
            ->where('status', 'paid')
            ->selectRaw('SUM(nominal) as donation')
            ->pluck('donation')
            ->first();

        if ($donations == null) {
            return 0;
        } else {
            return $donations;
        }
    }

    public function netoDonation($referral = null) {
        $donations = $this->hasMany('App\Models\Funding', 'project_id', 'id')
            ->when($referral, function ($q) use ($referral) {
                return $q->where('referral_id', $referral);
            })
            ->where('fund_type', $this->type)
            ->where('status', 'paid')
            ->selectRaw('SUM(nominal) as donation, SUM(additional_fee) as fee')
            // ->pluck('donation', 'fee')
            ->first();

        if ($donations == null) {
            return 0;
        } else {
            return $donations;
        }
    }

    public function countPGDonation()
    {
        $donations = $this->hasMany('App\Models\Funding', 'project_id', 'id')
            ->where('status', 'paid')
            ->where('payment_type', '!=', 'bank')
            ->selectRaw('SUM(nominal) as donation')
            ->pluck('donation')
            ->first();

        if ($donations == null) {
            return 0;
        } else {
            return $donations;
        }
    }

    public function getFundraisers()
    {
        $fundraisers = Funding::where('project_id', $this->id)
            ->where('status', 'paid')
            ->pluck('referral_id');

        return Fundraiser::whereIn('user_id', $fundraisers)
            ->get();
    }

    public function getFundraisersProject()
    {
        // $fund = Funding::where('project_id', $this->id)->get();
        // dd($fund);
        // return FundraiserTransaction::all();
        return DB::table("fundraiser_transactions")
            ->join('fundings', 'fundings.id', '=', 'fundraiser_transactions.reference_id')
            ->join('fundraisers', 'fundings.referral_id', '=', 'fundraisers.user_id')
            ->select('*')
            ->where('fundings.project_id', $this->id)
            ->where('fundings.status', 'paid')
            ->where('fund_type', $this->type)
            ->get();
    }

    public function countPeopleDonation()
    {
        return $this->hasMany('App\Models\Funding', 'project_id', 'id')
            ->where('status', 'paid')
            ->selectRaw('COUNT(id) as donation')
            ->pluck('donation')
            ->first();
    }

    public function countWithdrawal()
    {
        $withdrawal = $this->hasMany('App\Models\Withdrawal', 'project_id', 'id')
            ->whereIn('status', [0, 1])
            ->selectRaw('SUM(nominal) as withdrawal')
            ->pluck('withdrawal')
            ->first();

        if ($withdrawal == null) {
            return 0;
        } else {
            return $withdrawal;
        }
    }

    public function news()
    {
        return $this->hasMany('App\Models\Update', 'project_id', 'id');
    }

    public function favourite()
    {
        return $this->hasOne(ProjectFavourite::class, 'project_id', 'id');
    }

    public function withdrawal($type = 'distribution')
    {
        return $this->hasMany('App\Models\Withdrawal', 'project_id', 'id')
            ->where('withdrawal_type', $type)
            ->where('project_id', $this->id)
            ->where('project_type', $this->type)
            ->selectRaw('SUM(nominal) as withdrawal')
            ->pluck('withdrawal')
            ->first();
    }


    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    // functino sum fee
    public function sumFee()
    {
        return  $this->hasMany('App\Models\Funding', 'project_id', 'id')
            ->where('status', 'paid')
            ->where('fund_type', $this->type)
            ->selectRaw('SUM(additional_fee) as fee')
            ->pluck('fee')
            ->first();
    }

    // function count donation offline
    public function countDonationOffline()
    {
        $donations = $this->hasMany('App\Models\Funding', 'project_id', 'id')
            ->where('fund_type', $this->type)
            ->where('status', 'paid')
            // ->where('user_id',null)
            ->where('payment_method','Admin')
            ->where('payment_method','Gerai')
            ->selectRaw('SUM(nominal) as donation')
            ->pluck('donation')
            ->first();

        if ($donations == null) {
            return 0;
        } else {
            return $donations;
        }
    }

     // function count donation online
     public function countDonationOnline()
     {
         $donations = $this->hasMany('App\Models\Funding', 'project_id', 'id')
             ->where('fund_type', $this->type)
             ->where('status', 'paid')
            //  ->where('user_id','<>','null')
            ->where('payment_method','!=','Admin')
            ->where('payment_method','!=','Gerai')
             ->selectRaw('SUM(nominal) as donation')
             ->pluck('donation')
             ->first();
 
         if ($donations == null) {
             return 0;
         } else {
             return $donations;
         }
     }
    
    // function get donation
    public function getDonation() {
        $donation = $this->countDonation();
        $mediaberbagi = $donation * ($this->mediaberbagi / 100);

        $instance = $donation * ($this->operational_percentage / 100) ?? 0; // operational

        $fee = $this->sumFee();

        $commision = $donation * $this->fundraiser_reward / 100 ?? 0; // fee fundraiser commision

        $withdrawal = $this->withdrawal(); // withdrawal

        $neto = $donation - $mediaberbagi - $instance - $fee - $commision - $withdrawal;

        return [
            'donation' => $donation,
            'mediaberbagi' => $mediaberbagi,
            'operational' => $instance,
            'fee' => $fee,
            'commision' => $commision,
            'withdrawal' => $withdrawal,
            'neto' => $neto,
        ];
    }
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Qurban extends Model
{

    protected $table = 'qurbans';
    protected $guarded = ['id'];

    public function details() {
        return $this->hasMany(QurbanDetail::class, 'qurban_id', 'id');
    }

    //public $table = 'qurbans';
    protected $fillable = [
        'id',
        'title',
        'nama',
        'email',
        'no_wa',
        'price',
        'atas_nama',
        'path_icon',
        'grand_price',
    ];

     public function countDonation(){
        // dd($this->hasMany('App\Models\QurbanDetail', 'qurban_id', 'id')->select('SUM(total_price * quantity)')->get());
        // dd($this->id);
        $result = DB::table('qurbans')->join('qurban_details','qurbans.id','=','qurban_details.qurban_id')->select(DB::raw('SUM(qurban_details.total_price * qurban_details.quantity) as donation'))->where('qurbans.id', $this->id)->first();
        return $result->donation;
        // $donations = $this->hasMany('App\Models\QurbanDetail', 'qurban_id', 'id')
        // ->where('status', 'paid')
        // ->selectRaw('SUM(total_price) as donation')
        // ->pluck('donation')
        // ->first();

        // if($donations == null){
        //     return 0;
        // }else{
        //     return $donations;
        // }
    }
    public function countPeopleDonation(){
        $result = DB::table('qurbans')->join('qurban_details','qurbans.id','=','qurban_details.qurban_id')->select(DB::raw('COUNT(qurban_details.id) as donation'))->where('qurbans.id', $this->id)->first();
        return $result->donation;
    }

}

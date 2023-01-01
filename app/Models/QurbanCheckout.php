<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QurbanCheckout extends Model
{

    protected $table = 'qurban_checkouts';
    protected $guarded = ['id'];

    public function details() {
        return $this->hasMany(QurbanDetail::class, 'qurban_id', 'id');
    }

    public function payment() {
        return $this->hasOne(QurbanPayment::class, 'qurban_id', 'id');
    }
}

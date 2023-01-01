<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QurbanPayment extends Model
{
    protected $table = 'qurban_payments';
    protected $guarded = ['id'];

    public function qurban_detail() {
        return $this->hasOne(QurbanDetail::class, 'qurban_payment_id', 'id');
    }

    public function qurban_details() {
        return $this->hasMany(QurbanDetail::class, 'qurban_payment_id', 'id');
    }
}

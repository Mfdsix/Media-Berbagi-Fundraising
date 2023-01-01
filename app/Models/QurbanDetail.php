<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QurbanDetail extends Model
{
    protected $table = 'qurban_details';
    protected $guarded = ['id'];

    public function qurban_payment() {
        return $this->hasOne(QurbanPayment::class, 'id', 'qurban_payment_id');
    }

    public function qurban() {
        return $this->hasOne(Qurban::class, 'id', 'qurban_id');   
    }
}

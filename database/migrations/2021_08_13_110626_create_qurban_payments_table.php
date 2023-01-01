<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQurbanPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qurban_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('qurban_id');
            $table->bigInteger('user_id')->nullable();
            $table->string('donatur_name')->nullable();
            $table->string('donatur_email')->nullable();
            $table->string('donatur_whatsapp')->nullable();
            $table->string('atas_nama')->nullable();
            $table->boolean('contact_whatsapp')->default(0);
            $table->double('nominal');
            $table->string('payment_type');
            $table->string('payment_method');
            $table->string('payment_code');
            $table->string('status'); // checkout, pending, paid, canceled
            $table->timestamp('time_limit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qurban_payments');
    }
}

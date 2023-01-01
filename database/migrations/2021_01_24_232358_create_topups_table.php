<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->double('nominal');
            $table->double('extra_cost');
            $table->double('grand_total');
            $table->string('payment_type');
            $table->string('payment_code');
            $table->string('payment_method');
            $table->string('reference')->nullable();
            $table->dateTime('req_at');
            $table->dateTime('pay_at')->nullable();
            $table->dateTime('expire_at')->nullable();
            $table->integer('status')->default(0); // 0, 1, 2, 3
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
        Schema::dropIfExists('topups');
    }
}

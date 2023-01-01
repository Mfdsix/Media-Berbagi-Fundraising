<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundraisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundraisers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('fullname');
            $table->text('description')->nullable();
            $table->string('type')->default('personal'); // personal, instance
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('person_in_charge')->nullable();
            $table->string('province')->nullable();
            $table->string('reference')->nullable();
            $table->string('referral_code')->nullable();
            //
            $table->integer('commissions')->default(0);
            $table->integer('collected')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('transaction')->default(0);
            $table->integer('success_transaction')->default(0);
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
        Schema::dropIfExists('fundraisers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundraiserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundraiser_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('commission'); // commission, withdraw, donation
            $table->integer('amount')->default(0);
            $table->string('status')->default('pending'); // pending, processed, success
            $table->integer('reference_id')->nullable();
            $table->integer('fundraiser_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('fundraiser_transactions');
    }
}

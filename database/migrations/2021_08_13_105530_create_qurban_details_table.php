<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQurbanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qurban_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qurban_id');
            $table->string('field'); //e.g: kambing, sapi, 1/7 sapi
            $table->integer('quantity');
            $table->double('total_price'); // quantity * price per animal
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
        Schema::dropIfExists('qurban_details');
    }
}

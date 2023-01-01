<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQurbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qurbans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('nama')->nullable();
            $table->string('email')->nullable();
            $table->integer('no_wa')->nullable();
            $table->integer('price');
            $table->integer('atas_nama')->nullable();
            $table->string('path_icon')->nullable();
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
        Schema::dropIfExists('qurbans');
    }
}

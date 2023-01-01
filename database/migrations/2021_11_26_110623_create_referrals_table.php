<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('donature_id')->nullable();
            $table->integer('project_id');
            $table->string('title');
            $table->string('slug');
            $table->integer('target');
            $table->integer('collected')->default(0);
            $table->integer('referred')->default(0);
            $table->integer('status')->default(1); // 1 open, 2 closed, 3 full ...
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
        Schema::dropIfExists('referrals');
    }
}

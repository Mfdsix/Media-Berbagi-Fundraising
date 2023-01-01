<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("APP_NAME")->nullable();
            $table->string("MAIL_MAILER")->nullable();
            $table->string("MAIL_HOST")->nullable();
            $table->string("MAIL_PORT")->nullable();
            $table->string("MAIL_USERNAME")->nullable();
            $table->string("MAIL_PASSWORD")->nullable();
            $table->string("MAIL_ENCRYPTION")->nullable();
            $table->string("MAIL_FROM_ADDRESS")->nullable();
            $table->string("MAIL_FROM_NAME")->nullable();
            $table->string("MB_HOST")->nullable();
            $table->string("MB_ACCESS_KEY")->nullable();
            $table->string("RUANGWA_TOKEN")->nullable();
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
        Schema::dropIfExists('configs');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content');
            $table->string('path_featured')->nullable();
            $table->double('nominal_target')->nullable();
            $table->date('date_target')->nullable();
            $table->bigInteger('category_id');
            $table->bigInteger('user_id');
            $table->tinyInteger('is_fixed')->default(1); // 0 -> not fixed, 1 -> fixed
            $table->tinyInteger('status')->default(1); // 1 -> active, 2 -> closed
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
        Schema::dropIfExists('projects');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVariableToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('path_logo')->nullable();
            $table->string('title')->nullable();
            $table->string('primary')->nullable();
            $table->string('secondary')->nullable();
            $table->string('danger')->nullable();
            $table->string('trans_primary')->nullable();
            $table->string('trans_secondary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('path_logo');
            $table->dropColumn('title');
            $table->dropColumn('primary');
            $table->dropColumn('secondary');
            $table->dropColumn('danger');
            $table->dropColumn('trans_primary');
            $table->dropColumn('trans_secondary');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentProofToFundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->string('path_proof')->nullable();
            $table->text('reject_reason')->nullable();
            $table->string('donature_name')->nullable();
            $table->string('donature_email')->nullable();
            $table->text('special_message')->nullable();
            $table->integer('unique_code')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->double('total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->dropColumn('path_proof');
            $table->dropColumn('reject_reason');
            $table->dropColumn('donature_name');
            $table->dropColumn('donature_email');
            $table->dropColumn('special_message');
            $table->dropColumn('is_anonymous');
            $table->dropColumn('unique_code');
            $table->dropColumn('total');
        });
    }
}

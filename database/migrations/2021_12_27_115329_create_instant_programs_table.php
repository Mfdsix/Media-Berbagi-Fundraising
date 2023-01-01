<?php

use App\Models\InstantProgram;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstantProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instant_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        InstantProgram::insert([
            [
                'program' => 'sedekah',
            ],
            [
                'program' => 'wakaf',
            ],
            [
                'program' => 'zakat',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instant_programs');
    }
}

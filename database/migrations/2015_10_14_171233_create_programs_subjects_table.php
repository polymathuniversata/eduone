<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsSubjectsTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_id');
            $table->integer('subject_id');
            $table->integer('period');
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
        Schema::drop('programs_subjects');
    }
}

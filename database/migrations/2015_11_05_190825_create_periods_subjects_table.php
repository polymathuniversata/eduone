<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('period_id');
            $table->integer('subject_id');
            $table->integer('program_id')->nullable();
            $table->integer('ordr')->default(0);
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
        Schema::drop('periods_subjects');
    }
}

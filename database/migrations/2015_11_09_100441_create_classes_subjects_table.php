<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id');
            $table->integer('period_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('user_id'); // Teacher
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classes_subjects');
    }
}

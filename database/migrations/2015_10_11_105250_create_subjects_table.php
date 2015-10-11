<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('author_id');
            $table->integer('grades_count')->nullable();
            $table->integer('session_count')->nullable();
            $table->integer('total_grade_rate')->default(0); // This subject hold how much in program?
            $table->float('minimum_student_present_session')->nullable();
            $table->string('minimum_student_grade')->nullable(); // 7.6 means 76. A means 80
            $table->string('grade_type'); // A+..F, 0..10, 0..5
            $table->integer('equal_to')->nullable(); // This subject is equal to another subject

            $table->text('sessions_plan')->nullable(); // JSON Format
            $table->text('grades_plan')->nullable(); // JSON Format
            // Grade plan included
            // Name, Percent, Min
            
            $table->integer('creator');
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
        Schema::drop('subjects');
    }
}

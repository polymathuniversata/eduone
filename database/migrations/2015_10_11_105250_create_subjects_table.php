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
            $table->string('name')->unique();
            $table->string('slug')->unique()->nullable();
            $table->integer('grades_count')->nullable();
            $table->integer('sessions_count')->nullable();
            $table->integer('weight')->default(0); // This subject hold how much in program?
            $table->float('minimum_student_present_session')->nullable();
            $table->string('minimum_student_mark')->nullable(); // 7.6 means 76. A means 80

            $table->text('sessions_plan')->nullable(); // JSON Format
            $table->text('grades_plan')->nullable(); // JSON Format
            $table->boolean('is_required')->default(0);
            // Grade plan included
            // Name, Percent, Min
            
            $table->integer('creator_id');
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

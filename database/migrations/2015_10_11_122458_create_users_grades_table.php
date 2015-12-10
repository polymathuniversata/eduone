<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGradesTable extends Migration
{
    public function up()
    {
        Schema::create('users_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('subject_id');
            $table->integer('class_id')->nullable();
            $table->integer('grade_id');
            $table->integer('total');
            $table->integer('creator_id');
            $table->string('status')->nullable(); // Passed or not
            $table->string('notes')->nullable();

            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->unique(['user_id', 'subject_id', 'class_id', 'grade_id']);
        });
    }

    public function down()
    {
        Schema::drop('users_grades');
    }
}

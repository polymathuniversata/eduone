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
            $table->integer('grade_id');
            $table->integer('total');
            $table->integer('creator');
            $table->string('status')->nullable(); // Passed or not
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('users_grades');
    }
}

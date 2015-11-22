<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('users_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('subject_id');
            $table->integer('class_id')->nullable();
            $table->text('attendance_detail')->nullable();
            $table->text('grade_detail')->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('creator_id');
            $table->integer('branch_id'); // This helps query only in branch scope
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
        Schema::drop('users_subjects');
    }
}

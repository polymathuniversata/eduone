<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->nullable();
            $table->integer('room_id');
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('session_id')->nullable();
            $table->integer('event_id')->nullable();
            $table->integer('slot_id')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('finished_at');
            $table->text('attendance_detail');
            $table->integer('creator_id');
            // User 1: P, User 2: A, User 3: A, User 4: P
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('schedules');
    }
}

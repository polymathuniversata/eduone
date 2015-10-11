<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_programs', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('program_id');
            $table->string('status')->nullable(); // Awaiting, Inprogress, Completed, Failed, Dropout
            $table->date('started_at');
            $table->date('finished_at')->nullable();
            $table->text('meta');
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
        Schema::drop('users_programs');
    }
}

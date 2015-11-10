<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('group_id');
            $table->integer('creator_id'); // Who invite
            // User can have special role in class. 
            // For example, users can becomes teacher and vise versa
            $table->integer('role')->nullable(); 
            $table->string('status')->nullable();
            $table->date('date_joined')->nullable();
            $table->date('date_finished')->nullable();
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
        Schema::drop('users_groups');
    }
}

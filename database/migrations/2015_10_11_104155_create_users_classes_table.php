<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersClassesTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('class_id');
            $table->integer('creator_id');
            // User can have special role in class. 
            // For example, users can becomes teacher and vise versa
            $table->integer('role')->nullable(); 
            $table->text('permission')->nullable(); // Parent, Sibling...
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
        Schema::drop('users_classes');
    }
}

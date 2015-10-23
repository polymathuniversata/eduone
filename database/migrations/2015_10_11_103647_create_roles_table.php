<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('permissions');
            $table->integer('count');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('roles');
    }
}

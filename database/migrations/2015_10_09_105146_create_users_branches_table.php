<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBranchesTable extends Migration
{
    
    public function up()
    {
        Schema::create('users_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('branch_id');
            $table->integer('creator');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users_branches');
    }
}

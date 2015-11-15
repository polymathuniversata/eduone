<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('email', 80)->nullable(); // Associate with Google Apps...
            $table->string('type', 30)->default('class');
            $table->integer('program_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('creator_id');
            $table->integer('users_count')->default(0);
            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();
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
        Schema::drop('groups');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTable extends Migration
{
    public function up()
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('object');
            $table->string('meta_key');
            $table->string('field_type')->default('text');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('default')->nullable();
            $table->text('conditional_logic')->nullable();
            $table->integer('creator_id');
            $table->string('status')->nullable(); // Passed or not
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('meta');
    }
}

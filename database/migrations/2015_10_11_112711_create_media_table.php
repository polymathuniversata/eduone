<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('name')->nullable();
            $table->string('caption')->nullable();
            $table->text('content')->nullable();
            $table->string('mime_type', 50)->nullable();
            $table->string('alt_text')->nullable();
            $table->integer('creator')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::drop('media');
    }
}

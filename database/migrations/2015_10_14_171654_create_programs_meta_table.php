<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsMetaTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('object_id');
            $table->string('meta_key', 50);
            $table->string('meta_value')->nullable();
            $table->timestamps();
            $table->unique(['object_id', 'meta_key']);
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
        Schema::drop('programs_meta');
    }
}

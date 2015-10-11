<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string('id_card', 60);
            $table->string('id_card_issued_date')->nullable();
            $table->string('id_card_expired_date')->nullable();
            $table->string('id_card_issued_by')->nullable();
            $table->string('gender', 20);
            $table->string('roll_no', 60)->unique();
            $table->string('photo')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->text('media')->nullable();
            $table->integer('department_id')->nullable(); // For Staff
            $table->string('categories')->nullable(); // Comma separated
            $table->date('expired_date')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::drop('users');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('id', 200);
            $table->string('username');
            $table->string('name');
            $table->string('password');
            $table->longText('description')->nullable();
            $table->date('dob')->nullable(); 
            $table->boolean('gender')->nullable(); 
            $table->string('avatar')->nullable(); 
            $table->string('location', 255)->nullable();
            $table->primary('id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar');
            $table->string('position');
            $table->date('birthday');
            $table->string('phone');
            $table->string('bio')->nullable();
            $table->string('slack')->nullable();
            $table->string('skype')->nullable();
            $table->string('github')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->string('password');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('office_id');
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

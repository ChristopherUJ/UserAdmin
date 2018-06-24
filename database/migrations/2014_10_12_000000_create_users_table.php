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
            $table->string('name_first')->nullable();
            $table->string('name_last')->nullable();
            $table->string('telNum')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->unique();
            $table->string('profile')->default('storage/img/profile/default.png');
            $table->string('password');
            $table->boolean('adminUser')->default(false);
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

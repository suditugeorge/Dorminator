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
            $table->integer('user_type_id');
            $table->string('username')->unique();
            $table->string('password')->password();
            $table->boolean('has_temp_password');
            $table->boolean('is_super_admin')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_normal_user')->default(true);
            $table->timestamps();
            $table->rememberToken();
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

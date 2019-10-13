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
            // user id length : 20
            $table->string('id', 20);
            $table->string('full_name');
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('profile_img', 300)->default('users/merl_sen_user_default_user_profile.png');

            $table->string('user_type_id',5);
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

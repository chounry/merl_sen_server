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
            // user id length : 50
            $table->string('id', 50);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('phone');
            $table->string('opt_phone')->nullable();
            $table->string('address');
            $table->string('profile_img', 300)->default('users/merl_sen_user_default_user_profile.png');

            $table->string('user_type_id',5)->nullable();
            $table->string('city_id', 5)->nullable();
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

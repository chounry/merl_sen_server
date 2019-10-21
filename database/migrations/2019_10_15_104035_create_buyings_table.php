<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyings', function (Blueprint $table) {
            $table->string('id', 30)->unique();
            $table->dateTime('created_date');
            $table->string('address');
            $table->string('phone');

            $table->string('cart_id', 20)->nullable();
            $table->string('user_id', 30);

            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);    
            $table->dropForeign(['cart_id']);    
        });
        Schema::dropIfExists('buyings');
    }
}

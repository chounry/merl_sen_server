<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->dateTime('created_date');
            $table->boolean('bought')->default(false);
            $table->float('unit_sale_price', 10, 2);
            $table->integer('amount');

            $table->string('p_id', 30);
            $table->string('user_id', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}

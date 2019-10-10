<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCityProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('city_product', function (Blueprint $table) {
            $table->foreign('p_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('city_product', function (Blueprint $table) {
            $table->dropForeign(['p_id']);
            $table->dropForeign(['city_id']);
        });
    }
}

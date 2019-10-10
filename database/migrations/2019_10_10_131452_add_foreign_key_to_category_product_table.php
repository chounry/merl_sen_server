<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_product', function (Blueprint $table) {
            $table->foreign('p_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_product', function (Blueprint $table) {
            $table->dropForeign(['p_id']);            
            $table->dropForeign(['cat_id']);            
        });
    }
}

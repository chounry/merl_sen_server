<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 30)->unique();;
            $table->string('sku');
            $table->float('sale_price', 10, 2);
            $table->float('regular_price', 10, 2)->nullable();
            $table->longText('description');
            $table->string('title');
            $table->integer('in_stock_amount');
            $table->string('phone')->nullable();
            $table->string('opt_phone')->nullable();
            $table->date('post_date');
            $table->string('address')->nullable();

            $table->string('user_id',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

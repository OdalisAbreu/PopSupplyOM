<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->increments('id');
            
            //FK header
           $table->integer('cart_id')->unsigned();
           $table->foreign('cart_id')->references('id')->on('carts');

           //FK product
           $table->integer('product_id')->unsigned();
           $table->foreign('product_id')->references('id')->on('products');

           //FK product
           $table->integer('products_attribute_id')->unsigned();
           $table->foreign('products_attribute_id')->references('id')->on('products_attributes');

            $table->integer('quantity');
            $table->float('discount')->default(0); // % de descuento


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
        Schema::dropIfExists('cart_details');
    }
}

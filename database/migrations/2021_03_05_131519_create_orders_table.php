<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            //FK user
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            //FK cart
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts');

            //FK directions
            $table->integer('direction_id')->unsigned()->nullable(); 
            $table->foreign('direction_id')->references('id')->on('directions');

            $table->string('status');

            $table->longText('image64')->nullable();
            
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
        Schema::dropIfExists('orders');
    }
}

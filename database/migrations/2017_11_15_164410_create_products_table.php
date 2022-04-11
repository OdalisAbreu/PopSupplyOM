<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->text('long_description')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();

            //one to one FK
             $table->integer('category_id')->unsigned()->nullable();                 
             $table->foreign('category_id')->references('id')->on('categories');

             $table->integer('attribute_id')->unsigned()->nullable();                 

           
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
        Schema::dropIfExists('products');
    }
}

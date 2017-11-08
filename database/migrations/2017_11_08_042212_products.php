<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
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
            $table->integer('suppliers_id')->unsigned()->nullable();     
            $table->string('name');
            $table->string('description');
            $table->integer('cost');
            $table->integer('quantity');
            $table->timestamps();
        });      


        Schema::table('products', function (Blueprint $table) {
           $table->foreign('suppliers_id')->references('id')->on('suppliers');
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

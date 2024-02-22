<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCategoriesCartsWishlistsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create products table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->longText('image')->nullable();
            $table->longText('description');
            $table->tinyInteger('available')->default(1);
            $table->integer('rate')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->unsignedBigInteger('sellerProduct');
            $table->longText('img2');
            $table->longText('img3');
            $table->longText('img4');
            $table->foreign('sellerProduct')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->timestamps();
        });

        // Create categories table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
       
            $table->timestamps();
        });

        // Create carts table
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
         
            $table->timestamps();
        });

        // Create wishlists table
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
         
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('wishlists');
    }
}

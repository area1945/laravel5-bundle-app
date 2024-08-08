<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExampleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // contact
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->index();
            $table->string('email', 191)->index();
            $table->string('phone', 191)->index();
            $table->string('website')->nullable()->index();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        // categories
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64)->index();
            $table->string('name', 191)->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // brand
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64)->index();
            $table->string('name', 191)->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // product
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('brand_id')->index();
            $table->string('image')->nullable()->index();
            $table->string('code', 64)->index();
            $table->Integer('stock')->default(0)->index();
            $table->decimal('price', 20,4)->default(0)->index();
            $table->string('name', 191)->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // products_categories
        Schema::create('products_categories', function (Blueprint $table) {
            $table->Integer('product_id')->index();
            $table->Integer('category_id')->index();
            $table->primary(["product_id", "category_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_categories');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('brand');
       
    }
}

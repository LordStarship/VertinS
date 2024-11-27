<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id');
            $table->integer('product_id')->nullable();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unique(['category_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}

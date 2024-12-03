<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', 11)->primary();
            $table->integer('admin_id');
            $table->string('title', 100);
            $table->text('description');
            $table->double('price');
            $table->enum('status', ['0', '1'])->default('1'); // 0: Sold, 1: In Stock
            $table->integer('count_view')->default(0);
            $table->integer('message_count')->default(0);

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

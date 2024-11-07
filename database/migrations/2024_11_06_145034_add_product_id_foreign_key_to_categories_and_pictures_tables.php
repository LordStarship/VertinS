<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Alter product_id in categories to be a plain integer with length 11
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('product_id')->length(11)->change(); // Ensure it's an int(11)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // Add product_id to pictures with length 11
        Schema::table('pictures', function (Blueprint $table) {
            $table->integer('product_id')->length(11); // Add as plain integer with length 11
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop foreign key and column from categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        // Drop foreign key and column from pictures table
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};

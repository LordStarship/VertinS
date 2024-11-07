<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('id')->change(); // Reverts the change if needed
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('id')->change(); // Revert if necessary
        });
    }
};

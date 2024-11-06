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
        Schema::table('medias', function (Blueprint $table) {
            // Change only the id column to int(11)
            $table->integer('id')->change(); // Change id from bigint to int
        });

        Schema::table('products', function (Blueprint $table) {
            // Change only the id column to int(11)
            $table->integer('id')->change(); // Change id from bigint to int
        });

        Schema::table('categories', function (Blueprint $table) {
            // Change only the id column to int(11)
            $table->integer('id')->change(); // Change id from bigint to int
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('int', function (Blueprint $table) {
            //
        });
    }
};

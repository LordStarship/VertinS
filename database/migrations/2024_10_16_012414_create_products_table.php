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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade'); // FK to admins table
            $table->string('title', 100); // Product title
            $table->text('description'); // Product description
            $table->double('price'); // Product price
            $table->integer('status')->default(1); // Product status
            $table->integer('count_view')->default(0); // View count
            $table->integer('message_count')->default(0); // Message count
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

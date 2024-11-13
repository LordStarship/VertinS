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
        Schema::table('categories', callback: function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
        Schema::table('pictures', function (Blueprint $table) {
            $table->renameColumn('isDefault', 'is_default');
        });
        Schema::table('medias', function (Blueprint $table) {
            $table->renameColumn('isDefault', 'is_default');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

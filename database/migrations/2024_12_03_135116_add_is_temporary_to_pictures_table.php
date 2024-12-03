<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->boolean('is_temporary')->default(false);
        });
    }

    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropColumn('is_temporary');
        });
    }
};

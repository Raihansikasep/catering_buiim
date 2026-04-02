<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->integer('min_order')->nullable(false)->change();
            $table->integer('max_order')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->integer('min_order')->default(1)->change();
            $table->integer('max_order')->default(10)->change();
        });
    }
};

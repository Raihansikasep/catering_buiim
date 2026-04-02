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
        Schema::create('menu_menu_addon', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel menus
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            // Menghubungkan ke tabel menu_addons
            $table->foreignId('menu_addon_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_menu_addon');
    }
};

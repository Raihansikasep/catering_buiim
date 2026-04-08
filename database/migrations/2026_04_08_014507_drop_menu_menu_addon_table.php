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
        Schema::dropIfExists('menu_menu_addon');
    }

    public function down(): void
    {
        Schema::create('menu_menu_addon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->foreignId('menu_addon_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
};

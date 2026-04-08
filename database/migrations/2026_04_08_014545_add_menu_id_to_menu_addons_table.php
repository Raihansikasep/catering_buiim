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
        Schema::table('menu_addons', function (Blueprint $table) {
            $table->foreignId('menu_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('menu_addons', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropColumn('menu_id');
        });
    }
};

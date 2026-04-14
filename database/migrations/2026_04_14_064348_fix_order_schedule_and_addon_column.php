<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('order_schedule', 'order_schedules');

        Schema::table('order_addons', function (Blueprint $table) {
            $table->renameColumn('menu_addon_id', 'addon_id');
        });
    }

    public function down(): void
    {
        Schema::rename('order_schedules', 'order_schedule');

        Schema::table('order_addons', function (Blueprint $table) {
            $table->renameColumn('addon_id', 'menu_addon_id');
        });
    }
};

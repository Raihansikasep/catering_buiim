<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ─── 1. Hapus kolom payment_proof dari tabel orders ───
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });

        // ─── 2. Buat tabel payments baru ─────────────────────
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('method', ['transfer_bank'])->default('transfer_bank');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_number');
            $table->decimal('amount', 12, 2);
            $table->string('proof_image');
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');

        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_proof')->nullable();
        });
    }
};

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
        Schema::create('histories', function (Blueprint $table) {
            $table->id('id_history');
            $table->foreignId('id_pembayaran')->constrained('payments', 'id_pembayaran')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->foreignId('id_product')->constrained('products', 'id_product')->onDelete('cascade');
            $table->integer('amount');
            $table->timestamps();
            $table->unique(['id_user', 'id_product', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};

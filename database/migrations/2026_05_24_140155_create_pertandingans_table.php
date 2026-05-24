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
        Schema::create('pertandingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lomba_id')->constrained('lombas')->cascadeOnDelete();
            $table->foreignId('peserta_1_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('peserta_2_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('pemenang_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->integer('babak')->default(1);
            $table->enum('status', ['belum_mulai', 'berlangsung', 'selesai'])->default('belum_mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertandingans');
    }
};

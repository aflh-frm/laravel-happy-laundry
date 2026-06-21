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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_nota')->unique();
            
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            
            $table->foreignId('layanan_id')->nullable()->constrained('layanans')->onDelete('cascade');
            
            $table->integer('berat')->nullable()->default(0); 
            
            $table->json('rincian_pakaian')->nullable(); 
            $table->integer('total_harga'); 
            $table->string('status')->default('Proses'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

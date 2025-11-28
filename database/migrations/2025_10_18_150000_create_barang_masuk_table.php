<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel barang_masuk
     */
    public function up(): void
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id('id_barang_masuk'); // Primary Key

            // Relasi ke tabel barang
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');

            $table->integer('jumlah');
            $table->date('tanggal_masuk');
            $table->string('lokasi')->nullable();

            // Relasi ke tabel pegawai
            $table->unsignedBigInteger('diterima_oleh');
            $table->foreign('diterima_oleh')->references('id_pegawai')->on('pegawai')->onDelete('cascade');

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Undo migrasi (hapus tabel)
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
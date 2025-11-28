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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->bigIncrements('id_barang_keluar');
            $table->unsignedBigInteger('id_barang')->index('barang_keluar_id_barang_foreign');
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang');
            $table->string('satuan')->nullable();
            $table->integer('jumlah');
            $table->string('tujuan')->nullable();
            $table->string('lokasi');
            $table->timestamp('tanggal_keluar')->useCurrentOnUpdate()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};

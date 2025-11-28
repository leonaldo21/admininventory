<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id('id_barang_keluar');
            $table->unsignedBigInteger('id_barang'); // tambahkan ini
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang');
            $table->string('satuan');
            $table->integer('jumlah');
            $table->string('tujuan');
            $table->string('penerima');
            $table->string('lokasi'); // Kolom baru
            $table->timestamp('tanggal_keluar');
            $table->timestamps();

            // Jika ingin bikin foreign key (opsional, tapi direkomendasikan)
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};

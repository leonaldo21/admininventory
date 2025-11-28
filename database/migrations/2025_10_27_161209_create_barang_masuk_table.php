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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->bigIncrements('id_barang_masuk');
            $table->unsignedBigInteger('id_barang')->index('barang_masuk_id_barang_foreign');
            $table->integer('jumlah');
            $table->date('tanggal_masuk');
            $table->string('lokasi')->nullable();
            $table->unsignedBigInteger('diterima_oleh')->index('barang_masuk_diterima_oleh_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};

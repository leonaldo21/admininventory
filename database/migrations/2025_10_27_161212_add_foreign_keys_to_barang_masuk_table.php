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
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->foreign(['diterima_oleh'])->references(['id_pegawai'])->on('pegawai')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['id_barang'])->references(['id_barang'])->on('barang')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropForeign('barang_masuk_diterima_oleh_foreign');
            $table->dropForeign('barang_masuk_id_barang_foreign');
        });
    }
};

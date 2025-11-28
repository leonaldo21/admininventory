<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama');
            $table->string('nik_ktp')->unique();
            $table->string('no_kk')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_jmo')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('badge_id')->unique();
            $table->enum('role', ['helper','supervisor','foreman','insulator','carpenter']);
            $table->string('dokumen')->nullable(); // PDF dokumen
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pegawai');
    }
};

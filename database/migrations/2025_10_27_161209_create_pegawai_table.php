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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai');
            $table->string('nama');
            $table->string('nik_ktp')->unique();
            $table->string('no_kk')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_jmo')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('badge_id')->unique();
            $table->string('username')->nullable();
            $table->enum('role', ['helper', 'supervisor', 'foreman', 'insulator', 'carpenter']);
            $table->string('dokumen')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};

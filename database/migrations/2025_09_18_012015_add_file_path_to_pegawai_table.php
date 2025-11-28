<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pegawai', function (Blueprint $table) {
            if (!Schema::hasColumn('pegawai', 'file_path')) {
                $table->string('file_path')->nullable()->after('dokumen'); 
                // lebih cocok ditempatkan setelah 'dokumen' karena data sama-sama file
            }
        });
    }

    public function down(): void {
        Schema::table('pegawai', function (Blueprint $table) {
            if (Schema::hasColumn('pegawai', 'file_path')) {
                $table->dropColumn('file_path');
            }
        });
    }
};

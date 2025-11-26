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
        Schema::table('pemeriksaan_umum', function (Blueprint $table) {
            $table->timestamp('waktu_konfirmasi')->nullable()->after('no_antrian');
            $table->timestamp('waktu_mulai_periksa')->nullable()->after('waktu_konfirmasi');
            $table->timestamp('waktu_selesai_periksa')->nullable()->after('waktu_mulai_periksa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaan_umum', function (Blueprint $table) {
            $table->dropColumn(['waktu_konfirmasi', 'waktu_mulai_periksa', 'waktu_selesai_periksa']);
        });
    }
};
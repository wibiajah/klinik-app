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
        // Add foto_bukti to pemeriksaan_umum table
        Schema::table('pemeriksaan_umum', function (Blueprint $table) {
            $table->string('foto_bukti')->nullable()->after('is_lpk_sentosa');
        });

        // Add foto_bukti to laboratorium table  
        Schema::table('laboratorium', function (Blueprint $table) {
            $table->string('foto_bukti')->nullable()->after('is_lpk_sentosa');
        });

        // Add foto_bukti to radiologi table
        Schema::table('radiologi', function (Blueprint $table) {
            $table->string('foto_bukti')->nullable()->after('is_lpk_sentosa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaan_umum', function (Blueprint $table) {
            $table->dropColumn('foto_bukti');
        });

        Schema::table('laboratorium', function (Blueprint $table) {
            $table->dropColumn('foto_bukti');
        });

        Schema::table('radiologi', function (Blueprint $table) {
            $table->dropColumn('foto_bukti');
        });
    }
};
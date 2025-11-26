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
        Schema::table('radiologi', function (Blueprint $table) {
            // Menambahkan kolom tracking petugas setelah kolom is_lpk_sentosa
            $table->unsignedBigInteger('transfer_by')->nullable()->after('is_lpk_sentosa')->comment('ID user yang melakukan transfer dari pendaftaran');
            $table->unsignedBigInteger('antrian_by')->nullable()->after('transfer_by')->comment('ID user yang set antrian');
            $table->unsignedBigInteger('mulai_periksa_by')->nullable()->after('antrian_by')->comment('ID user yang mulai pemeriksaan');
            $table->unsignedBigInteger('selesai_periksa_by')->nullable()->after('mulai_periksa_by')->comment('ID user yang selesaikan pemeriksaan');
            
            // Menambahkan timestamp untuk tracking waktu
            $table->timestamp('transfer_at')->nullable()->after('selesai_periksa_by')->comment('Waktu transfer dari pendaftaran');
            $table->timestamp('antrian_at')->nullable()->after('transfer_at')->comment('Waktu set antrian');
            $table->timestamp('mulai_periksa_at')->nullable()->after('antrian_at')->comment('Waktu mulai pemeriksaan');
            $table->timestamp('selesai_periksa_at')->nullable()->after('mulai_periksa_at')->comment('Waktu selesai pemeriksaan');
            
            // Foreign key constraints
            $table->foreign('transfer_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('antrian_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('mulai_periksa_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('selesai_periksa_by')->references('id')->on('users')->onDelete('set null');
            
            // Index untuk performa query
            $table->index('transfer_by');
            $table->index('antrian_by');
            $table->index('mulai_periksa_by');
            $table->index('selesai_periksa_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('radiologi', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['transfer_by']);
            $table->dropForeign(['antrian_by']);
            $table->dropForeign(['mulai_periksa_by']);
            $table->dropForeign(['selesai_periksa_by']);
            
            // Drop columns
            $table->dropColumn([
                'transfer_by',
                'antrian_by', 
                'mulai_periksa_by',
                'selesai_periksa_by',
                'transfer_at',
                'antrian_at',
                'mulai_periksa_at',
                'selesai_periksa_at'
            ]);
        });
    }
};
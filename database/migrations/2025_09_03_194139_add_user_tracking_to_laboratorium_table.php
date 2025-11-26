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
        Schema::table('laboratorium', function (Blueprint $table) {
            // Tambah kolom tracking user untuk setiap tahap workflow
            $table->unsignedBigInteger('set_antrian_by')->nullable()->after('is_lpk_sentosa');
            $table->timestamp('set_antrian_at')->nullable()->after('set_antrian_by');
            $table->unsignedBigInteger('mulai_periksa_by')->nullable()->after('set_antrian_at');
            $table->timestamp('mulai_periksa_at')->nullable()->after('mulai_periksa_by');
            $table->unsignedBigInteger('selesai_periksa_by')->nullable()->after('mulai_periksa_at');
            $table->timestamp('selesai_periksa_at')->nullable()->after('selesai_periksa_by');
            
            // Foreign key constraints
            $table->foreign('set_antrian_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('mulai_periksa_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('selesai_periksa_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laboratorium', function (Blueprint $table) {
            // Drop foreign key constraints dulu
            $table->dropForeign(['set_antrian_by']);
            $table->dropForeign(['mulai_periksa_by']);
            $table->dropForeign(['selesai_periksa_by']);
            
            // Drop kolom
            $table->dropColumn([
                'set_antrian_by',
                'set_antrian_at',
                'mulai_periksa_by',
                'mulai_periksa_at',
                'selesai_periksa_by',
                'selesai_periksa_at'
            ]);
        });
    }
};
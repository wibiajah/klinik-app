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
        Schema::create('radiologi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id');
            $table->string('nik', 16);
            $table->string('nama', 100);
            $table->string('no_rekam_medis', 20);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->string('no_hp', 15);
            $table->text('alamat_lengkap');
            $table->string('keluhan');
            $table->enum('status_pemeriksaan', ['menunggu', 'sedang_diperiksa', 'selesai'])->default('menunggu');
            $table->enum('jenis_radiologi', ['rontgen', 'ct_scan', 'mri', 'usg', 'mammografi'])->nullable();
            $table->text('hasil_radiologi')->nullable();
            $table->string('dokter_radiologi')->nullable();
            $table->string('teknisi_radiologi')->nullable();
            $table->date('tgl_pemeriksaan')->nullable();
            $table->text('catatan_radiologi')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran')->onDelete('cascade');
            
            // Index untuk performa
            $table->index(['pendaftaran_id', 'status_pemeriksaan']);
            $table->index('tgl_pemeriksaan');
            $table->index('jenis_radiologi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radiologi');
    }
};
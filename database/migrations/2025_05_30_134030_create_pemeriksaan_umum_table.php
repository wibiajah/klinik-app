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
        Schema::create('pemeriksaan_umum', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id');
            $table->string('no_rekam_medis');
            $table->string('nik', 16);
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->string('no_hp');
            $table->string('no_bpjs')->nullable();
            $table->text('alamat_lengkap');
            $table->string('kontak_darurat');
            $table->string('hubungan_kontak');
            $table->text('catatan')->nullable();
            $table->date('tgl_transfer');
            $table->enum('status_pemeriksaan', ['menunggu', 'sedang_diperiksa', 'selesai'])->default('menunggu');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran')->onDelete('cascade');
            
            // Indexes
            $table->index('no_rekam_medis');
            $table->index('nik');
            $table->index('tgl_transfer');
            $table->index('status_pemeriksaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_umum');
    }
};
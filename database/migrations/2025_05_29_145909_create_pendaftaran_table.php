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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->string('no_hp', 15);
            $table->string('no_bpjs', 20)->nullable();
            $table->text('alamat_lengkap');
            $table->string('kontak_darurat', 15);
            $table->enum('hubungan_kontak', ['ayah', 'ibu', 'saudara']);
            $table->enum('keluhan', ['pemeriksaan_umum', 'lab', 'radiologi']);
            $table->text('catatan')->nullable();
            $table->date('tgl_pendaftaran');
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'ditolak'])->default('menunggu');
            $table->string('no_rekam_medis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
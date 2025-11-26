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
        Schema::create('biaya_peralatan', function (Blueprint $table) {
            $table->id();
            
            // Kategori peralatan
            $table->enum('kategori', ['pemeriksaan-umum', 'laboratorium', 'radiologi']);
            
            // Informasi dasar alat
            $table->string('nama_alat');
            $table->string('merek');
            $table->string('model')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->year('tahun_pembelian')->nullable();
            
            // Informasi biaya
            $table->decimal('harga_beli', 15, 2)->default(0);
            $table->decimal('biaya_operasional', 15, 2)->default(0);
            $table->decimal('biaya_perawatan', 15, 2)->default(0);
            
            // Status dan lokasi
            $table->enum('status', ['aktif', 'tidak_aktif', 'rusak', 'maintenance'])->default('aktif');
            $table->string('lokasi');
            $table->string('penanggung_jawab');
            
            // Keterangan dan gambar
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            
            // Informasi maintenance
            $table->date('tanggal_maintenance_terakhir')->nullable();
            $table->date('tanggal_maintenance_selanjutnya')->nullable();
            
            // Informasi spesifikasi teknis
            $table->text('spesifikasi_teknis')->nullable();
            $table->string('daya_listrik')->nullable(); // dalam watt
            $table->string('dimensi')->nullable(); // pxlxt
            $table->string('berat')->nullable(); // dalam kg
            
            // Informasi vendor dan support
            $table->string('vendor')->nullable();
            $table->string('distributor')->nullable();
            $table->string('kontak_support')->nullable();
            $table->date('tanggal_garansi_habis')->nullable();
            
            // Informasi penggunaan
            $table->integer('frekuensi_penggunaan_per_hari')->default(0);
            $table->integer('kapasitas_maksimal_per_hari')->default(0);
            $table->decimal('biaya_per_penggunaan', 10, 2)->default(0);
            
            // Informasi kalibrasi (khusus untuk alat yang perlu kalibrasi)
            $table->date('tanggal_kalibrasi_terakhir')->nullable();
            $table->date('tanggal_kalibrasi_selanjutnya')->nullable();
            $table->string('nomor_sertifikat_kalibrasi')->nullable();
            
            // Informasi asuransi
            $table->string('nomor_polis_asuransi')->nullable();
            $table->date('tanggal_asuransi_habis')->nullable();
            $table->decimal('nilai_asuransi', 15, 2)->nullable();
            
            // Informasi pajak dan penyusutan
            $table->decimal('nilai_penyusutan_per_tahun', 15, 2)->default(0);
            $table->decimal('nilai_buku_saat_ini', 15, 2)->default(0);
            
            // Catatan tambahan
            $table->text('catatan_khusus')->nullable();
            $table->text('riwayat_kerusakan')->nullable();
            $table->text('riwayat_perbaikan')->nullable();
            
            // Audit trail
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['kategori', 'status']);
            $table->index('nama_alat');
            $table->index('status');
            $table->index('tanggal_maintenance_selanjutnya');
            $table->index('tanggal_kalibrasi_selanjutnya');
            
            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_peralatan');
    }
};
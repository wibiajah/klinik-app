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
        Schema::create('surat_keterangan', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['template', 'history'])->comment('Type: template atau history');
            $table->enum('jenis_surat', ['sehat', 'sakit'])->comment('Jenis: surat sehat atau sakit');
            $table->text('content')->nullable()->comment('Isi template surat');
            $table->timestamp('printed_at')->nullable()->comment('Waktu cetak surat');
            $table->unsignedBigInteger('printed_by')->nullable()->comment('User yang mencetak');
            $table->timestamps();

            // Index untuk performance
            $table->index(['type', 'jenis_surat']);
            $table->index('printed_at');
            
            // Foreign key ke users table
            $table->foreign('printed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan');
    }
};
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
        Schema::create('perawat', function (Blueprint $table) {
            $table->id('id_perawat');
            $table->string('nama_perawat');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('tingkat_pendidikan', ['D3 Keperawatan', 'S1 Keperawatan', 'Ners']);
            $table->string('no_str')->unique();
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_telepon', 20);
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->json('jadwal_kerja')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawat');
    }
};
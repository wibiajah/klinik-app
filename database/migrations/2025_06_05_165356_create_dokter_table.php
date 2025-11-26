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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id('id_dokter');
            $table->string('nama_dokter');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('spesialisasi');
            $table->string('no_str')->unique();
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->json('jadwal_praktik')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
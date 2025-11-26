<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTglPendaftaranToDatetime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Ubah kolom tgl_pendaftaran dari date ke datetime
            $table->dateTime('tgl_pendaftaran')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Kembalikan ke date jika rollback
            $table->date('tgl_pendaftaran')->change();
        });
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('pemeriksaan_umum', function (Blueprint $table) {
        $table->text('diagnosis_sementara')->nullable();
        $table->text('obat_diberikan')->nullable();
        $table->text('anjuran_instruksi')->nullable();
        $table->text('rujukan')->nullable();
    });
}

public function down()
{
    Schema::table('pemeriksaan_umum', function (Blueprint $table) {
        $table->dropColumn(['diagnosis_sementara', 'obat_diberikan', 'anjuran_instruksi', 'rujukan']);
    });
}
};

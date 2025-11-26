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
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Tambahkan kolom transferred_by setelah is_lpk_sentosa
            $table->unsignedBigInteger('transferred_by')->nullable()->after('is_lpk_sentosa');
            // Tambahkan kolom transferred_at setelah transferred_by
            $table->timestamp('transferred_at')->nullable()->after('transferred_by');
            
            // Tambahkan foreign key constraint
            $table->foreign('transferred_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null')
                  ->name('fk_pendaftaran_transferred_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Drop foreign key constraint terlebih dahulu
            $table->dropForeign('fk_pendaftaran_transferred_by');
            
            // Drop kolom-kolom yang ditambahkan
            $table->dropColumn(['transferred_by', 'transferred_at']);
        });
    }
};
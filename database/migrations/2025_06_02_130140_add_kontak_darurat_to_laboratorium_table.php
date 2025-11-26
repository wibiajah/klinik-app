<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratorium', function (Blueprint $table) {
            $table->string('kontak_darurat')->nullable()->after('keluhan');
            $table->string('hubungan_kontak')->nullable()->after('kontak_darurat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laboratorium', function (Blueprint $table) {
            $table->dropColumn(['kontak_darurat', 'hubungan_kontak']);
        });
    }
};
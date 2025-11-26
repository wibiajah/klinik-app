<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['superadmin', 'admin', 'karyawan', 'user'])->default('user')->after('email');
            $table->json('permissions')->nullable()->after('role'); // Untuk menyimpan custom permissions
            $table->boolean('is_active')->default(true)->after('permissions');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'permissions', 'is_active']);
        });
    }
};
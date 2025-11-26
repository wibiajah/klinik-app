<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@klinik.com',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
            'permissions' => array_keys(User::getAvailablePermissions()),
            'is_active' => true,
        ]);

        // Admin dengan semua permission
        User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'permissions' => ['pendaftaran', 'pemeriksaan_umum', 'laboratorium', 'radiologi', 'data_pasien'],
            'is_active' => true,
        ]);

        // Karyawan Pendaftaran
        User::create([
            'name' => 'Karyawan Pendaftaran',
            'email' => 'pendaftaran@klinik.com',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'permissions' => ['pendaftaran'],
            'is_active' => true,
        ]);

        // Karyawan Lab
        User::create([
            'name' => 'Karyawan Lab',
            'email' => 'lab@klinik.com',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'permissions' => ['laboratorium', 'data_pasien'],
            'is_active' => true,
        ]);

        // User biasa
        User::create([
            'name' => 'User Test',
            'email' => 'user@klinik.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'permissions' => [],
            'is_active' => true,
        ]);
    }
}
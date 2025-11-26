<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'permissions',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'permissions' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getAvailablePermissions()
    {
        return [
            'pendaftaran' => 'Kelola Pendaftaran',
            'pemeriksaan_umum' => 'Kelola Pemeriksaan Umum',
            'laboratorium' => 'Kelola Laboratorium',
            'radiologi' => 'Kelola Radiologi',
            'data_pasien' => 'Kelola Data Pasien',
            'user_management' => 'Kelola User',
            // Di getAvailablePermissions()
            'surat_keterangan' => 'Kelola Surat Keterangan',
            'laporan' => 'Kelola Laporan Klinik', 
            'data_dokter' => 'Kelola Data Dokter',
            'data_perawat' => 'Kelola Data Perawat',
        ];
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function hasPermission($permission)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return in_array($permission, $this->permissions ?? []);
    }

    public function canAccess($routeName)
{
    // Superadmin can access everything
    if ($this->isSuperAdmin()) {
        return true;
    }

    // Route yang bisa diakses semua admin tanpa permission khusus
    $publicAdminRoutes = [
        'admin.dashboard',
        'admin.profile.show',
        'admin.profile.edit',
        'admin.profile.update',
        'profile.password.edit',
        'profile.password.update',
        'admin.layanan',
        'logout'
    ];

    if (in_array($routeName, $publicAdminRoutes)) {
        return in_array($this->role, ['superadmin', 'admin', 'karyawan']);
    }

    // User Management Routes - berbeda akses untuk superadmin dan admin
    if (str_starts_with($routeName, 'admin.users.')) {
        if ($this->role === 'admin') {
            // Admin hanya bisa akses route tertentu untuk karyawan
            $allowedAdminUserRoutes = [
                'admin.users.index',
                'admin.users.create', 
                'admin.users.store',
                'admin.users.show',
                'admin.users.edit',
                'admin.users.update',
                'admin.users.update-password',
                'admin.users.destroy',
                'admin.users.toggle-status'
            ];
            return in_array($routeName, $allowedAdminUserRoutes);
        }
        
        // Superadmin bisa akses semua
        return $this->isSuperAdmin();
    }

    // MAPPING ROUTE KE PERMISSION - INI YANG PALING PENTING
    if (str_starts_with($routeName, 'admin.pendaftaran.')) {
        return $this->hasPermission('pendaftaran');
    }

    if (str_starts_with($routeName, 'admin.laboratorium.')) {
        return $this->hasPermission('laboratorium');
    }

    if (str_starts_with($routeName, 'admin.pemeriksaanumum.')) {
        return $this->hasPermission('pemeriksaan_umum');
    }

    if (str_starts_with($routeName, 'admin.radiologi.')) {
        return $this->hasPermission('radiologi');
    }

    if (str_starts_with($routeName, 'admin.data-pasien.')) {
        return $this->hasPermission('data_pasien');
    }
    
    if (str_starts_with($routeName, 'admin.suratketerangan.')) {
        return $this->hasPermission('surat_keterangan');
    }

    if (str_starts_with($routeName, 'admin.laporanklinik.')) {
        return $this->hasPermission('laporan');
    }

    if (str_starts_with($routeName, 'admin.data-dokter.')) {
        return $this->hasPermission('data_dokter');
    }

    if (str_starts_with($routeName, 'admin.data-perawat.')) {
        return $this->hasPermission('data_perawat');
    }

    // Jika route admin lainnya, cek role admin
    if (str_starts_with($routeName, 'admin.')) {
        return in_array($this->role, ['superadmin', 'admin', 'karyawan']);
    }

    // Route user
    if (str_starts_with($routeName, 'user.')) {
        return $this->role === 'user';
    }

    return true;
}
}
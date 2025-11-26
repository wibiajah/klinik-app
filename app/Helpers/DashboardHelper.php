<?php

namespace App\Helpers;

class DashboardHelper
{
    public static function getMenuItems()
    {
        $user = auth()->user();
        $menuItems = [];

        // Dashboard - always available for authenticated users
        $menuItems[] = [
            'name' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'dashboard',
            'permission' => null
        ];

        // Pendaftaran Menu
        if ($user->hasPermission('pendaftaran')) {
            $menuItems[] = [
                'name' => 'Pendaftaran',
                'route' => 'admin.pendaftaran.index',
                'icon' => 'user-plus',
                'permission' => 'pendaftaran',
                'submenu' => [
                    [
                        'name' => 'Daftar Pendaftaran',
                        'route' => 'admin.pendaftaran.index'
                    ],
                    [
                        'name' => 'Tambah Pendaftaran',
                        'route' => 'admin.pendaftaran.create'
                    ]
                ]
            ];
        }

        // Pemeriksaan Umum Menu
        if ($user->hasPermission('pemeriksaan_umum')) {
            $menuItems[] = [
                'name' => 'Pemeriksaan Umum',
                'route' => 'admin.pemeriksaanumum.index',
                'icon' => 'stethoscope',
                'permission' => 'pemeriksaan_umum'
            ];
        }

        // Laboratorium Menu
        if ($user->hasPermission('laboratorium')) {
            $menuItems[] = [
                'name' => 'Laboratorium',
                'route' => 'admin.laboratorium.index',
                'icon' => 'flask',
                'permission' => 'laboratorium'
            ];
        }

        // Radiologi Menu
        if ($user->hasPermission('radiologi')) {
            $menuItems[] = [
                'name' => 'Radiologi',
                'route' => 'admin.radiologi.index',
                'icon' => 'x-ray',
                'permission' => 'radiologi'
            ];
        }

        // Data Pasien Menu
        if ($user->hasPermission('data_pasien')) {
            $menuItems[] = [
                'name' => 'Data Pasien',
                'route' => 'admin.data-pasien.index',
                'icon' => 'users',
                'permission' => 'data_pasien',
                'submenu' => [
                    [
                        'name' => 'Daftar Pasien',
                        'route' => 'admin.data-pasien.index'
                    ],
                    [
                        'name' => 'Laporan',
                        'route' => 'admin.data-pasien.laporan'
                    ]
                ]
            ];
        }

        // User Management Menu - Only for Superadmin
        if ($user->isSuperAdmin()) {
            $menuItems[] = [
                'name' => 'Kelola User',
                'route' => 'admin.users.index',
                'icon' => 'users-cog',
                'permission' => 'user_management',
                'submenu' => [
                    [
                        'name' => 'Daftar User',
                        'route' => 'admin.users.index'
                    ],
                    [
                        'name' => 'Tambah User',
                        'route' => 'admin.users.create'
                    ]
                ]
            ];
        }

        return $menuItems;
    }

    public static function getPermissionBadgeColor($permission)
    {
        $colors = [
            'pendaftaran' => 'bg-blue-100 text-blue-800',
            'pemeriksaan_umum' => 'bg-green-100 text-green-800',
            'laboratorium' => 'bg-purple-100 text-purple-800',
            'radiologi' => 'bg-yellow-100 text-yellow-800',
            'data_pasien' => 'bg-indigo-100 text-indigo-800',
            'user_management' => 'bg-red-100 text-red-800',
        ];

        return $colors[$permission] ?? 'bg-gray-100 text-gray-800';
    }

    public static function getRoleBadgeColor($role)
    {
        $colors = [
            'superadmin' => 'bg-red-100 text-red-800',
            'admin' => 'bg-blue-100 text-blue-800',
            'karyawan' => 'bg-green-100 text-green-800',
            'user' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$role] ?? 'bg-gray-100 text-gray-800';
    }
}
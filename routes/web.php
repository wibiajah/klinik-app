<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PemeriksaanUmumController;
use App\Http\Controllers\Admin\RadiologiController;
use App\Http\Controllers\Admin\LaboratoriumController;
use App\Http\Controllers\Admin\DataPasienController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\BiayaPeralatanController;
use App\Http\Controllers\Admin\SuratKeteranganController;  // Update import path
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PerawatController;
use App\Http\Controllers\Admin\WhatsAppController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PendaftaranController as PublicPendaftaranController;

Route::get('/', HomeController::class)->name('home');

// Routes untuk pendaftaran publik (tanpa login)
Route::prefix('pendaftaran')->group(function () {
    Route::get('/', [PublicPendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/', [PublicPendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/success', [PublicPendaftaranController::class, 'success'])->name('pendaftaran.success');
    Route::get('/check-status', [PublicPendaftaranController::class, 'showCheckStatus'])->name('pendaftaran.check-status');
    Route::post('/check-status', [PublicPendaftaranController::class, 'checkStatus'])->name('pendaftaran.status');
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'register')->name('register');
    Route::post('/register', [AuthController::class, 'store']);
    Route::view('/login', 'login')->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth', 'role'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile routes
    Route::get('/profile', [ProfilController::class, 'show'])->name('admin.profile.show');
    Route::get('/profile/edit', [ProfilController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/update', [ProfilController::class, 'update'])->name('admin.profile.update');
    Route::get('/profile/password/edit', [ProfilController::class, 'editPassword'])->name('profile.password.edit');
    Route::put('/profile/password/update', [ProfilController::class, 'updatePassword'])->name('profile.password.update');

    // Admin routes - TANPA middleware tambahan
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // User Management - HANYA untuk superadmin
     Route::middleware(['role:superadmin,admin'])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserManagementController::class, 'index'])->name('index');
    Route::get('/create', [UserManagementController::class, 'create'])->name('create');
    Route::post('/', [UserManagementController::class, 'store'])->name('store');
    Route::get('/{user}', [UserManagementController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
    Route::put('/{user}/password', [UserManagementController::class, 'updatePassword'])->name('update-password');
    Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
    Route::patch('/{user}/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('toggle-status');
});
        // Pendaftaran Routes - dicek permission via middleware
        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [PendaftaranController::class, 'index'])->name('index');
            Route::get('/create', [PendaftaranController::class, 'create'])->name('create');
            Route::post('/', [PendaftaranController::class, 'store'])->name('store');
            Route::get('/{id}/detail', [PendaftaranController::class, 'detail'])->name('detail');
            Route::get('/{id}/edit', [PendaftaranController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PendaftaranController::class, 'update'])->name('update');
            Route::delete('/{id}', [PendaftaranController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/konfirmasi', [PendaftaranController::class, 'konfirmasi'])->name('konfirmasi');
            Route::post('/{id}/tolak', [PendaftaranController::class, 'tolak'])->name('tolak');
        });

        // Laboratorium Routes - dicek permission via middleware
        Route::prefix('laboratorium')->name('laboratorium.')->group(function () {
            Route::get('/', [LaboratoriumController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [LaboratoriumController::class, 'detail'])->name('detail');
            Route::post('/{id}/konfirmasi', [LaboratoriumController::class, 'konfirmasi'])->name('konfirmasi');
            Route::post('/{id}/update-status', [LaboratoriumController::class, 'updateStatus'])->name('update-status');
            Route::post('/{id}/set-antrian', [LaboratoriumController::class, 'setAntrian'])->name('set-antrian');
            Route::post('/transfer/{id}', [LaboratoriumController::class, 'transfer'])->name('transfer');
        });

        // Pemeriksaan Umum Routes - dicek permission via middleware
        Route::prefix('pemeriksaan-umum')->name('pemeriksaanumum.')->group(function () {
            Route::get('/', [PemeriksaanUmumController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [PemeriksaanUmumController::class, 'detail'])->name('detail');
            Route::post('/{id}/konfirmasi', [PemeriksaanUmumController::class, 'konfirmasi'])->name('konfirmasi');
            Route::post('/{id}/update-status', [PemeriksaanUmumController::class, 'updateStatus'])->name('update-status');
            Route::post('/transfer/{id}', [PemeriksaanUmumController::class, 'transfer'])->name('transfer');
        });

        // Radiologi Routes - dicek permission via middleware
        Route::prefix('radiologi')->name('radiologi.')->group(function () {
            Route::get('/', [RadiologiController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [RadiologiController::class, 'detail'])->name('detail');
            Route::post('/{id}/konfirmasi', [RadiologiController::class, 'konfirmasi'])->name('konfirmasi');
            Route::post('/{id}/update-status', [RadiologiController::class, 'updateStatus'])->name('update-status');
            Route::post('/{id}/set-antrian', [RadiologiController::class, 'setAntrian'])->name('set-antrian');
            Route::post('/transfer/{id}', [RadiologiController::class, 'transfer'])->name('transfer');
        });

        // Data Pasien Routes - dicek permission via middleware
        Route::prefix('data-pasien')->name('data-pasien.')->group(function () {
            Route::get('/', [DataPasienController::class, 'index'])->name('index');
            Route::get('/data-kunjungan', [DataPasienController::class, 'dataKunjungan'])->name('data-kunjungan');
            Route::get('/kunjungan-pasien', [DataPasienController::class, 'kunjunganPasien'])->name('kunjungan-pasien');
            Route::get('/laporan', [DataPasienController::class, 'laporan'])->name('laporan');
            Route::get('/export', [DataPasienController::class, 'export'])->name('export');
            Route::get('/detail-nik/{nik}', [DataPasienController::class, 'detailByNik'])->name('detail-by-nik');
            Route::get('/detail-kunjungan/{id}', [DataPasienController::class, 'detailKunjungan'])->name('detail-kunjungan');
            Route::get('/detail-kunjungan-lengkap/{id}', [DataPasienController::class, 'detailKunjunganLengkap'])->name('detail-kunjungan-lengkap');
            Route::get('/detail-satu-kunjungan/{id}', [DataPasienController::class, 'detailKunjungan'])->name('detail-satu-kunjungan');
        });

        Route::prefix('surat-keterangan')->name('suratketerangan.')->group(function () {
        
            // Halaman Index
            Route::get('/surat-sehat', [SuratKeteranganController::class, 'suratSehat'])->name('suratsehat');
            Route::get('/surat-sakit', [SuratKeteranganController::class, 'suratSakit'])->name('suratsakit');
            Route::get('/riwayat', [SuratKeteranganController::class, 'riwayat'])->name('riwayat');
            
            // Template Management (AJAX)
            Route::post('/update-template', [SuratKeteranganController::class, 'updateTemplate'])->name('update.template');
            Route::get('/get-template/{jenisSurat}', [SuratKeteranganController::class, 'getTemplate'])->name('get.template');
            
            // PDF Generation
            Route::get('/cetak/{jenisSurat}', [SuratKeteranganController::class, 'cetakSurat'])->name('cetak');
            
            // History Management
            Route::delete('/history/{id}', [SuratKeteranganController::class, 'deleteHistory'])->name('delete.history');
        });

            Route::prefix('laporanklinik')->name('laporanklinik.')->group(function () {
                Route::get('/pendaftaran', [LaporanController::class, 'laporanPendaftaran'])->name('pendaftaran');
                Route::get('/export-pendaftaran', [LaporanController::class, 'exportLaporanPendaftaran'])->name('export-pendaftaran');
                
                Route::get('/pemeriksaan-umum', [LaporanController::class, 'laporanPemeriksaanUmum'])->name('pemeriksaan-umum');
                Route::get('/export-pemeriksaan-umum', [LaporanController::class, 'exportLaporanPemeriksaanUmum'])->name('export-pemeriksaan-umum');
                
                Route::get('/laboratorium', [LaporanController::class, 'laporanLaboratorium'])->name('laboratorium');
                Route::get('/export-laboratorium', [LaporanController::class, 'exportLaporanLaboratorium'])->name('export-laboratorium');

                Route::get('/radiologi', [LaporanController::class, 'laporanRadiologi'])->name('radiologi');
                Route::get('/export-radiologi', [LaporanController::class, 'exportLaporanRadiologi'])->name('export-radiologi');

           Route::get('/surat-keterangan', [LaporanController::class, 'laporanSuratKeterangan'])->name('surat-keterangan');
Route::get('/export-surat-keterangan', [LaporanController::class, 'exportLaporanSuratKeterangan'])->name('export-surat-keterangan');
            });

        Route::prefix('data-dokter')->name('data-dokter.')->group(function () {
            Route::get('/', [DokterController::class, 'index'])->name('index');
            Route::get('/create', [DokterController::class, 'create'])->name('create');
            Route::post('/', [DokterController::class, 'store'])->name('store');
            Route::get('/{dokter}', [DokterController::class, 'show'])->name('show');
            Route::get('/{dokter}/edit', [DokterController::class, 'edit'])->name('edit');
            Route::put('/{dokter}', [DokterController::class, 'update'])->name('update');
            Route::delete('/{dokter}', [DokterController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('data-perawat')->name('data-perawat.')->group(function () {
            Route::get('/', [PerawatController::class, 'index'])->name('index');
            Route::get('/create', [PerawatController::class, 'create'])->name('create');
            Route::post('/', [PerawatController::class, 'store'])->name('store');
            Route::get('/{perawat}', [PerawatController::class, 'show'])->name('show');
            Route::get('/{perawat}/edit', [PerawatController::class, 'edit'])->name('edit');
            Route::put('/{perawat}', [PerawatController::class, 'update'])->name('update');
            Route::delete('/{perawat}', [PerawatController::class, 'destroy'])->name('destroy');
        });

       Route::prefix('komunikasi')->name('komunikasi.')->group(function () {
            Route::get('/whatsapp', [WhatsAppController::class, 'index'])->name('whatsapp.index');
            Route::get('/email', [WhatsAppController::class, 'email'])->name('email.index');
        });

Route::prefix('biaya-peralatan')->name('biaya-peralatan.')->group(function () {
    // Routes untuk setiap kategori
    Route::get('/{kategori}', [BiayaPeralatanController::class, 'index'])->name('index')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    Route::get('/{kategori}/create', [BiayaPeralatanController::class, 'create'])->name('create')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    Route::post('/{kategori}', [BiayaPeralatanController::class, 'store'])->name('store')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    Route::get('/{kategori}/{id}', [BiayaPeralatanController::class, 'show'])->name('show')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    Route::get('/{kategori}/{id}/edit', [BiayaPeralatanController::class, 'edit'])->name('edit')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    Route::put('/{kategori}/{id}', [BiayaPeralatanController::class, 'update'])->name('update')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    Route::delete('/{kategori}/{id}', [BiayaPeralatanController::class, 'destroy'])->name('destroy')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    // Route untuk update status
    Route::patch('/{kategori}/{id}/status', [BiayaPeralatanController::class, 'updateStatus'])->name('update-status')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    // Route untuk statistik
    Route::get('/{kategori}/statistik', [BiayaPeralatanController::class, 'getStatistik'])->name('statistik')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
    
    // Route untuk export
    Route::get('/{kategori}/export', [BiayaPeralatanController::class, 'export'])->name('export')
        ->where('kategori', 'pemeriksaan-umum|laboratorium|radiologi');
});

        // Layanan Routes
        Route::get('layanan/{jenis}', [AdminController::class, 'layanan'])->name('layanan');
    });

    // User Routes
    Route::prefix('user')->middleware(['role:user'])->group(function () {
        Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    });
});
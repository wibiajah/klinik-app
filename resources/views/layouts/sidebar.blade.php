{{-- resources/views/layouts/components/sidebar.blade.php --}}
<style>#accordionSidebar .nav-link,
#accordionSidebar .nav-link span,
#accordionSidebar .collapse-header,
#accordionSidebar .collapse-item {
    color: white !important;
}

/* Dropdown text color fix */
#accordionSidebar .collapse-inner {
    background-color: rgba(0,0,0,0.1) !important;
}

#accordionSidebar .collapse-inner .collapse-header {
    color: rgba(255,255,255,0.8) !important;
}

#accordionSidebar .collapse-inner .collapse-item {
    color: white !important;
}

/* Hover states */
#accordionSidebar .nav-link:hover,
#accordionSidebar .collapse-item:hover {
    color: white !important;
    background-color: rgba(255,255,255,0.1) !important;
}

/* Active states */
#accordionSidebar .nav-item.active .nav-link,
#accordionSidebar .collapse-item.active {
    color: white !important;
}</style>
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="{{ route('home') }}">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 60px;">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard - Available for all authenticated users -->
    @if (in_array(auth()->user()->role, ['superadmin', 'admin', 'karyawan']))
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
    @elseif (auth()->user()->role === 'user')
        <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- Superadmin - Full Access with Dropdown --}}
    @if (auth()->user()->isSuperAdmin())
    
    <!-- User Management (Standalone) -->
    <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-users-cog"></i>
            <span>Kelola User</span>
        </a>
    </li>

    <!-- Pendaftaran (Standalone) -->
    <li class="nav-item {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">
            <i class="fas fa-user-plus"></i>
            <span>Pendaftaran Hari Ini</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Layanan Medis Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.pemeriksaanumum.*') || request()->routeIs('admin.laboratorium.*') || request()->routeIs('admin.radiologi.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterLayanan" aria-expanded="true" aria-controls="collapseMasterLayanan">
            <i class="fas fa-fw fa-hospital"></i>
            <span>Layanan Medis</span>
        </a>
        <div id="collapseMasterLayanan" class="collapse {{ request()->routeIs('admin.pemeriksaanumum.*') || request()->routeIs('admin.laboratorium.*') || request()->routeIs('admin.radiologi.*') ? 'show' : '' }}" aria-labelledby="headingMasterLayanan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Layanan Medis:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.pemeriksaanumum.*') ? 'active' : '' }}" href="{{ route('admin.pemeriksaanumum.index') }}">
                    <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laboratorium.*') ? 'active' : '' }}" href="{{ route('admin.laboratorium.index') }}">
                    <i class="fas fa-flask"></i> Laboratorium
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.radiologi.*') ? 'active' : '' }}" href="{{ route('admin.radiologi.index') }}">
                    <i class="fas fa-x-ray"></i> Radiologi
                </a>
            </div>
        </div>
    </li>

    <!-- Tenaga Medis Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.data-dokter.*') || request()->routeIs('admin.data-perawat.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataStaff" aria-expanded="true" aria-controls="collapseDataStaff">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Tenaga Medis</span>
        </a>
        <div id="collapseDataStaff" class="collapse {{ request()->routeIs('admin.data-dokter.*') || request()->routeIs('admin.data-perawat.*') ? 'show' : '' }}" aria-labelledby="headingDataStaff" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Staff:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.data-dokter.*') ? 'active' : '' }}" href="{{ route('admin.data-dokter.index') }}">
                    <i class="fas fa-user-md"></i> Data Dokter
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.data-perawat.*') ? 'active' : '' }}" href="{{ route('admin.data-perawat.index') }}">
                    <i class="fas fa-user-nurse"></i> Data Perawat
                </a>
            </div>
        </div>
    </li>

    <!-- Data Operasional Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.data-pasien.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataOperasional" aria-expanded="true" aria-controls="collapseDataOperasional">
            <i class="fas fa-fw fa-database"></i>
            <span>Data Pasien</span>
        </a>
        <div id="collapseDataOperasional" class="collapse {{ request()->routeIs('admin.data-pasien.*') ? 'show' : '' }}" aria-labelledby="headingDataOperasional" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Pasien:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.data-pasien.index') ? 'active' : '' }}" href="{{ route('admin.data-pasien.index') }}">
                    <i class="fas fa-user-injured"></i> Data Pasien
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.data-pasien.kunjungan-pasien') ? 'active' : '' }}" href="{{ route('admin.data-pasien.kunjungan-pasien') }}">
                    <i class="fas fa-calendar-check"></i> Data Kunjungan
                </a>
            </div>
        </div>
    </li>

    <!-- Surat Keterangan Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.suratketerangan.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuratKeterangan" aria-expanded="true" aria-controls="collapseSuratKeterangan">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Surat Keterangan</span>
        </a>
        <div id="collapseSuratKeterangan" class="collapse {{ request()->routeIs('admin.suratketerangan.*') ? 'show' : '' }}" aria-labelledby="headingSuratKeterangan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Surat Medis:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsehat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsehat') }}">
                    <i class="fas fa-file-medical-alt"></i> Surat Sehat
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsakit') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsakit') }}">
                    <i class="fas fa-file-medical"></i> Surat Sakit
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.riwayat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.riwayat') }}">
                    <i class="fas fa-history"></i> Riwayat Surat
                </a>
            </div>
        </div>
    </li>

    <!-- Laporan Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.laporanklinik.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse {{ request()->routeIs('admin.laporanklinik.*') ? 'show' : '' }}" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan & Analisis:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.pendaftaran') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.pendaftaran') }}">
                    <i class="fas fa-user-plus"></i> Laporan Pendaftaran
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.pemeriksaan-umum') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.pemeriksaan-umum') }}">
                    <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.laboratorium') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.laboratorium') }}">
                    <i class="fas fa-flask"></i> Laboratorium
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.radiologi') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.radiologi') }}">
                    <i class="fas fa-x-ray"></i> Radiologi
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.surat-keterangan') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.surat-keterangan') }}">
                    <i class="fas fa-certificate"></i> Surat Keterangan
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.komunikasi.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKomunikasiAdmin" aria-expanded="true" aria-controls="collapseKomunikasiAdmin">
            <i class="fas fa-fw fa-comments"></i>
            <span>Komunikasi</span>
        </a>
        <div id="collapseKomunikasiAdmin" class="collapse {{ request()->routeIs('admin.komunikasi.*') ? 'show' : '' }}" aria-labelledby="headingKomunikasiAdmin" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Media Komunikasi:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.komunikasi.whatsapp.*') ? 'active' : '' }}" href="{{ route('admin.komunikasi.whatsapp.index') }}">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.komunikasi.email.*') ? 'active' : '' }}" href="{{ route('admin.komunikasi.email.index') }}">
                    <i class="fas fa-envelope"></i> Email
                </a>
            </div>
        </div>
    </li>
<!-- Biaya Peralatan Dropdown -->
<li class="nav-item {{ request()->routeIs('biaya-peralatan.*') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBiayaPeralatan" aria-expanded="true" aria-controls="collapseBiayaPeralatan">
                <i class="fas fa-fw fa-tools"></i>
        <span>Biaya Peralatan</span>
    </a>
    <div id="collapseBiayaPeralatan" class="collapse {{ request()->routeIs('biaya-peralatan.*') ? 'show' : '' }}" aria-labelledby="headingBiayaPeralatan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manajemen Biaya:</h6>
            <a class="collapse-item {{ request()->is('admin/biaya-peralatan/pemeriksaan-umum*') ? 'active' : '' }}" href="{{ url('admin/biaya-peralatan/pemeriksaan-umum') }}">
                <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
            </a>
            <a class="collapse-item {{ request()->is('admin/biaya-peralatan/laboratorium*') ? 'active' : '' }}" href="{{ url('admin/biaya-peralatan/laboratorium') }}">
                <i class="fas fa-flask"></i> Laboratorium
            </a>
            <a class="collapse-item {{ request()->is('admin/biaya-peralatan/radiologi*') ? 'active' : '' }}" href="{{ url('admin/biaya-peralatan/radiologi') }}">
                <i class="fas fa-x-ray"></i> Radiologi
            </a>
        </div>
    </div>
</li>
    @endif

{{-- Admin - User Management untuk Karyawan --}}
@if (auth()->user()->role === 'admin')
    
    <!-- User Management khusus Admin (hanya karyawan) -->
    <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-users-cog"></i>
            <span>Kelola Karyawan</span>
        </a>
    </li>

    <!-- Pendaftaran (Standalone) -->
    <li class="nav-item {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">
            <i class="fas fa-user-plus"></i>
            <span>Pendaftaran Hari Ini</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Layanan Medis Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.pemeriksaanumum.*') || request()->routeIs('admin.laboratorium.*') || request()->routeIs('admin.radiologi.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterLayananAdmin" aria-expanded="true" aria-controls="collapseMasterLayananAdmin">
            <i class="fas fa-fw fa-hospital"></i>
            <span>Layanan Medis</span>
        </a>
        <div id="collapseMasterLayananAdmin" class="collapse {{ request()->routeIs('admin.pemeriksaanumum.*') || request()->routeIs('admin.laboratorium.*') || request()->routeIs('admin.radiologi.*') ? 'show' : '' }}" aria-labelledby="headingMasterLayananAdmin" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Layanan Medis:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.pemeriksaanumum.*') ? 'active' : '' }}" href="{{ route('admin.pemeriksaanumum.index') }}">
                    <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laboratorium.*') ? 'active' : '' }}" href="{{ route('admin.laboratorium.index') }}">
                    <i class="fas fa-flask"></i> Laboratorium
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.radiologi.*') ? 'active' : '' }}" href="{{ route('admin.radiologi.index') }}">
                    <i class="fas fa-x-ray"></i> Radiologi
                </a>
            </div>
        </div>
    </li>

    <!-- Tenaga Medis Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.data-dokter.*') || request()->routeIs('admin.data-perawat.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataStaffAdmin" aria-expanded="true" aria-controls="collapseDataStaffAdmin">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Tenaga Medis</span>
        </a>
        <div id="collapseDataStaffAdmin" class="collapse {{ request()->routeIs('admin.data-dokter.*') || request()->routeIs('admin.data-perawat.*') ? 'show' : '' }}" aria-labelledby="headingDataStaffAdmin" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Staff:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.data-dokter.*') ? 'active' : '' }}" href="{{ route('admin.data-dokter.index') }}">
                    <i class="fas fa-user-md"></i> Data Dokter
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.data-perawat.*') ? 'active' : '' }}" href="{{ route('admin.data-perawat.index') }}">
                    <i class="fas fa-user-nurse"></i> Data Perawat
                </a>
            </div>
        </div>
    </li>

    <!-- Data Pasien Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.data-pasien.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataPasienAdmin" aria-expanded="true" aria-controls="collapseDataPasienAdmin">
            <i class="fas fa-fw fa-database"></i>
            <span>Data Pasien</span>
        </a>
        <div id="collapseDataPasienAdmin" class="collapse {{ request()->routeIs('admin.data-pasien.*') ? 'show' : '' }}" aria-labelledby="headingDataPasienAdmin" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Pasien:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.data-pasien.index') ? 'active' : '' }}" href="{{ route('admin.data-pasien.index') }}">
                    <i class="fas fa-user-injured"></i> Data Pasien
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.data-pasien.kunjungan-pasien') ? 'active' : '' }}" href="{{ route('admin.data-pasien.kunjungan-pasien') }}">
                    <i class="fas fa-calendar-check"></i> Data Kunjungan
                </a>
            </div>
        </div>
    </li>

    <!-- Surat Keterangan Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.suratketerangan.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuratKeteranganAdmin" aria-expanded="true" aria-controls="collapseSuratKeteranganAdmin">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Surat Keterangan</span>
        </a>
        <div id="collapseSuratKeteranganAdmin" class="collapse {{ request()->routeIs('admin.suratketerangan.*') ? 'show' : '' }}" aria-labelledby="headingSuratKeteranganAdmin" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Surat Medis:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsehat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsehat') }}">
                    <i class="fas fa-file-medical-alt"></i> Surat Sehat
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsakit') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsakit') }}">
                    <i class="fas fa-file-medical"></i> Surat Sakit
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.riwayat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.riwayat') }}">
                    <i class="fas fa-history"></i> Riwayat Surat
                </a>
            </div>
        </div>
    </li>

    <!-- Laporan Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.laporanklinik.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporanAdmin" aria-expanded="true" aria-controls="collapseLaporanAdmin">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporanAdmin" class="collapse {{ request()->routeIs('admin.laporanklinik.*') ? 'show' : '' }}" aria-labelledby="headingLaporanAdmin" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan & Analisis:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.pendaftaran') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.pendaftaran') }}">
                    <i class="fas fa-user-plus"></i> Laporan Pendaftaran
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.pemeriksaan-umum') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.pemeriksaan-umum') }}">
                    <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.laboratorium') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.laboratorium') }}">
                    <i class="fas fa-flask"></i> Laboratorium
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.radiologi') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.radiologi') }}">
                    <i class="fas fa-x-ray"></i> Radiologi
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.surat-keterangan') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.surat-keterangan') }}">
                    <i class="fas fa-certificate"></i> Surat Keterangan
                </a>
            </div>
        </div>
    </li>
    <!-- Komunikasi Dropdown -->
    <li class="nav-item {{ request()->routeIs('admin.komunikasi.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKomunikasi" aria-expanded="true" aria-controls="collapseKomunikasi">
            <i class="fas fa-fw fa-comments"></i>
            <span>Komunikasi</span>
        </a>
        <div id="collapseKomunikasi" class="collapse {{ request()->routeIs('admin.komunikasi.*') ? 'show' : '' }}" aria-labelledby="headingKomunikasi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Media Komunikasi:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.komunikasi.whatsapp.*') ? 'active' : '' }}" href="{{ route('admin.komunikasi.whatsapp.index') }}">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.komunikasi.email.*') ? 'active' : '' }}" href="{{ route('admin.komunikasi.email.index') }}">
                    <i class="fas fa-envelope"></i> Email
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->is('admin/biaya-peralatan*') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBiayaPeralatan" aria-expanded="true" aria-controls="collapseBiayaPeralatan">
                <i class="fas fa-fw fa-tools"></i>
        <span>Biaya Peralatan</span>
    </a>
    <div id="collapseBiayaPeralatan" class="collapse {{ request()->is('admin/biaya-peralatan*') ? 'show' : '' }}" aria-labelledby="headingBiayaPeralatan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manajemen Biaya:</h6>
          <a class="collapse-item {{ request()->is('admin/biaya-peralatan/pemeriksaan-umum*') ? 'active' : '' }}" href="{{ url('admin/biaya-peralatan/pemeriksaan-umum') }}">
    <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
</a>
<a class="collapse-item {{ request()->is('admin/biaya-peralatan/laboratorium*') ? 'active' : '' }}" href="{{ url('admin/biaya-peralatan/laboratorium') }}">
    <i class="fas fa-flask"></i> Laboratorium
</a>
<a class="collapse-item {{ request()->is('admin/biaya-peralatan/radiologi*') ? 'active' : '' }}" href="{{ url('admin/biaya-peralatan/radiologi') }}">
    <i class="fas fa-x-ray"></i> Radiologi
</a>
        </div>
    </div>
</li>
@endif

    {{-- Karyawan dengan Permission System --}}
    @if (auth()->user()->role === 'karyawan')
        
        {{-- Pendaftaran - Check permission --}}
        @if (auth()->user()->hasPermission('pendaftaran'))
            <li class="nav-item {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Pendaftaran Hari Ini</span>
                </a>
            </li>
        @endif

        <!-- Divider jika ada navigasi sebelumnya -->
        @if (auth()->user()->hasPermission('pendaftaran'))
            <hr class="sidebar-divider">
        @endif

        {{-- Layanan Medis Dropdown untuk Karyawan --}}
        @if (auth()->user()->hasPermission('pemeriksaan_umum') || auth()->user()->hasPermission('laboratorium') || auth()->user()->hasPermission('radiologi'))
            <li class="nav-item {{ (auth()->user()->hasPermission('pemeriksaan_umum') && request()->routeIs('admin.pemeriksaanumum.*')) || (auth()->user()->hasPermission('laboratorium') && request()->routeIs('admin.laboratorium.*')) || (auth()->user()->hasPermission('radiologi') && request()->routeIs('admin.radiologi.*')) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterLayananKaryawan" aria-expanded="true" aria-controls="collapseMasterLayananKaryawan">
                    <i class="fas fa-fw fa-hospital"></i>
                    <span>Layanan Medis</span>
                </a>
                <div id="collapseMasterLayananKaryawan" class="collapse {{ (auth()->user()->hasPermission('pemeriksaan_umum') && request()->routeIs('admin.pemeriksaanumum.*')) || (auth()->user()->hasPermission('laboratorium') && request()->routeIs('admin.laboratorium.*')) || (auth()->user()->hasPermission('radiologi') && request()->routeIs('admin.radiologi.*')) ? 'show' : '' }}" aria-labelledby="headingMasterLayananKaryawan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Layanan Medis:</h6>
                        @if (auth()->user()->hasPermission('pemeriksaan_umum'))
                            <a class="collapse-item {{ request()->routeIs('admin.pemeriksaanumum.*') ? 'active' : '' }}" href="{{ route('admin.pemeriksaanumum.index') }}">
                                <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('laboratorium'))
                            <a class="collapse-item {{ request()->routeIs('admin.laboratorium.*') ? 'active' : '' }}" href="{{ route('admin.laboratorium.index') }}">
                                <i class="fas fa-flask"></i> Laboratorium
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('radiologi'))
                            <a class="collapse-item {{ request()->routeIs('admin.radiologi.*') ? 'active' : '' }}" href="{{ route('admin.radiologi.index') }}">
                                <i class="fas fa-x-ray"></i> Radiologi
                            </a>
                        @endif
                    </div>
                </div>
            </li>
        @endif

        {{-- Data Pasien - Check permission --}}
        @if (auth()->user()->hasPermission('data_pasien'))
            <li class="nav-item {{ request()->routeIs('admin.data-pasien.*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataPasienKaryawan" aria-expanded="true" aria-controls="collapseDataPasienKaryawan">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Data Pasien</span>
                </a>
                <div id="collapseDataPasienKaryawan" class="collapse {{ request()->routeIs('admin.data-pasien.*') ? 'show' : '' }}" aria-labelledby="headingDataPasienKaryawan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manajemen Pasien:</h6>
                        <a class="collapse-item {{ request()->routeIs('admin.data-pasien.index') ? 'active' : '' }}" href="{{ route('admin.data-pasien.index') }}">
                            <i class="fas fa-user-injured"></i> Data Pasien
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.data-pasien.kunjungan-pasien') ? 'active' : '' }}" href="{{ route('admin.data-pasien.kunjungan-pasien') }}">
                            <i class="fas fa-calendar-check"></i> Data Kunjungan
                        </a>
                    </div>
                </div>
            </li>
        @endif

        {{-- Tenaga Medis Dropdown for Karyawan --}}
        @if (auth()->user()->hasPermission('data_dokter') || auth()->user()->hasPermission('data_perawat'))
            <li class="nav-item {{ (auth()->user()->hasPermission('data_dokter') && request()->routeIs('admin.data-dokter.*')) || (auth()->user()->hasPermission('data_perawat') && request()->routeIs('admin.data-perawat.*')) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataStaffKaryawan" aria-expanded="true" aria-controls="collapseDataStaffKaryawan">
                    <i class="fas fa-fw fa-user-md"></i>
                    <span>Tenaga Medis</span>
                </a>
                <div id="collapseDataStaffKaryawan" class="collapse {{ (auth()->user()->hasPermission('data_dokter') && request()->routeIs('admin.data-dokter.*')) || (auth()->user()->hasPermission('data_perawat') && request()->routeIs('admin.data-perawat.*')) ? 'show' : '' }}" aria-labelledby="headingDataStaffKaryawan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manajemen Staff:</h6>
                        @if (auth()->user()->hasPermission('data_dokter'))
                            <a class="collapse-item {{ request()->routeIs('admin.data-dokter.*') ? 'active' : '' }}" href="{{ route('admin.data-dokter.index') }}">
                                <i class="fas fa-user-md"></i> Data Dokter
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('data_perawat'))
                            <a class="collapse-item {{ request()->routeIs('admin.data-perawat.*') ? 'active' : '' }}" href="{{ route('admin.data-perawat.index') }}">
                                <i class="fas fa-user-nurse"></i> Data Perawat
                            </a>
                        @endif
                    </div>
                </div>
            </li>
        @endif

        {{-- Surat Keterangan - Check permission --}}
        @if (auth()->user()->hasPermission('surat_keterangan'))
            <li class="nav-item {{ request()->routeIs('admin.suratketerangan.*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuratKeteranganKaryawan" aria-expanded="true" aria-controls="collapseSuratKeteranganKaryawan">
                    <i class="fas fa-fw fa-file-medical"></i>
                    <span>Surat Keterangan</span>
                </a>
                <div id="collapseSuratKeteranganKaryawan" class="collapse {{ request()->routeIs('admin.suratketerangan.*') ? 'show' : '' }}" aria-labelledby="headingSuratKeteranganKaryawan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Surat Medis:</h6>
                        <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsehat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsehat') }}">
                            <i class="fas fa-file-medical-alt"></i> Surat Sehat
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsakit') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsakit') }}">
                            <i class="fas fa-file-medical"></i> Surat Sakit
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.riwayat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.riwayat') }}">
                            <i class="fas fa-history"></i> Riwayat Surat
                        </a>
                    </div>
                </div>
            </li>
        @endif

        {{-- Laporan - Check permission --}}
        @if (auth()->user()->hasPermission('laporan'))
            <li class="nav-item {{ request()->routeIs('admin.laporanklinik.*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporanKaryawan" aria-expanded="true" aria-controls="collapseLaporanKaryawan">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseLaporanKaryawan" class="collapse {{ request()->routeIs('admin.laporanklinik.*') ? 'show' : '' }}" aria-labelledby="headingLaporanKaryawan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan & Analisis:</h6>
                        <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.pendaftaran') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.pendaftaran') }}">
                            <i class="fas fa-user-plus"></i> Laporan Pendaftaran
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.pemeriksaan-umum') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.pemeriksaan-umum') }}">
                            <i class="fas fa-stethoscope"></i> Pemeriksaan Umum
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.laboratorium') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.laboratorium') }}">
                            <i class="fas fa-flask"></i> Laboratorium
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.radiologi') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.radiologi') }}">
                            <i class="fas fa-x-ray"></i> Radiologi
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.laporanklinik.surat-keterangan') ? 'active' : '' }}" href="{{ route('admin.laporanklinik.surat-keterangan') }}">
                            <i class="fas fa-certificate"></i> Surat Keterangan
                        </a>
                    </div>
                </div>
            </li>
        @endif

    @endif

    {{-- Admin and Karyawan with Permissions - INI BAGIAN YANG LAMA, HARUS DIHAPUS --}}
    {{-- BAGIAN INI SUDAH DIPINDAHKAN KE ATAS UNTUK KARYAWAN --}}

    {{-- Regular User - Limited Access --}}
    @if (auth()->user()->role === 'user')
        {{-- Profile for regular users --}}
        <li class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.profile.show') }}">
                <i class="fas fa-user"></i>
                <span>Profil Saya</span>
            </a>
        </li>

        {{-- Surat Keterangan for regular users --}}
        <li class="nav-item {{ request()->routeIs('admin.suratketerangan.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuratKeteranganUser" aria-expanded="true" aria-controls="collapseSuratKeteranganUser">
                <i class="fas fa-fw fa-file-medical"></i>
                <span>Surat Keterangan</span>
            </a>
            <div id="collapseSuratKeteranganUser" class="collapse {{ request()->routeIs('admin.suratketerangan.*') ? 'show' : '' }}" aria-labelledby="headingSuratKeteranganUser" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Surat Medis:</h6>
                    <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsehat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsehat') }}">
                        <i class="fas fa-file-medical-alt"></i> Surat Sehat
                    </a>
                    <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.suratsakit') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.suratsakit') }}">
                        <i class="fas fa-file-medical"></i> Surat Sakit
                    </a>
                    <a class="collapse-item {{ request()->routeIs('admin.suratketerangan.riwayat') ? 'active' : '' }}" href="{{ route('admin.suratketerangan.riwayat') }}">
                        <i class="fas fa-history"></i> Riwayat Surat
                    </a>
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
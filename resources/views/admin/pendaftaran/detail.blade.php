<x-admin-layout title="Detail Pendaftaran">
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-dark fw-bold">Detail Pendaftaran</h1>
            <div>
                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                @if($pendaftaran->status == 'dikonfirmasi')
                <button class="btn btn-dark ms-2" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak Data
                </button>
                @endif
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-light rounded px-3 py-2">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pendaftaran.index') }}" class="text-dark">Pendaftaran</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Detail</li>
            </ol>
        </nav>

        <!-- Alert Success/Error -->
        @if(session('success'))
            <div class="alert alert-light border border-success text-dark" role="alert">
                <i class="fas fa-check-circle" style="color: #02b723;"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-light border border-danger text-dark" role="alert">
                <i class="fas fa-exclamation-triangle text-danger"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Informasi Pasien -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-user me-2" style="color: #02b723;"></i> Informasi Pasien
                        </h6>
                        <div class="d-flex align-items-center">
                            @if($pendaftaran->is_lpk_sentosa)
                                <span class="badge me-2" style="background-color: #28a745; color: white; font-size: 11px;">
                                    <i class="fas fa-check-circle me-1"></i>LPK Sentosa
                                </span>
                            @endif
                            @if($pendaftaran->no_rekam_medis)
                                <span class="badge fs-6 text-white" style="background-color: #02b723;">No. RM: {{ $pendaftaran->no_rekam_medis }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-dark fw-medium">No. Rekam Medis</td>
                                        <td class="text-dark">: 
                                            @if($pendaftaran->no_rekam_medis)
                                                <code class="bg-light p-1 rounded text-dark">{{ $pendaftaran->no_rekam_medis }}</code>
                                            @else
                                                <span class="text-muted">Belum dikonfirmasi</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">NIK</td>
                                        <td class="text-dark">: {{ $pendaftaran->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Nama Lengkap</td>
                                        <td class="text-dark">: <span class="fw-bold" style="color: #02b723;">{{ $pendaftaran->nama }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Jenis Kelamin</td>
                                        <td class="text-dark">: 
                                            @if($pendaftaran->jenis_kelamin == 'L')
                                                <i class="fas fa-mars" style="color: #02b723;"></i> {{ $pendaftaran->jenis_kelamin_label }}
                                            @else
                                                <i class="fas fa-venus text-muted"></i> {{ $pendaftaran->jenis_kelamin_label }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Tanggal Lahir</td>
                                        <td class="text-dark">: {{ $pendaftaran->tgl_lahir->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Umur</td>
                                        <td class="text-dark">: <span class="badge bg-light text-dark border">{{ $pendaftaran->tgl_lahir->age }} tahun</span></td>
                                    </tr>
                                    @if($pendaftaran->is_lpk_sentosa && $pendaftaran->foto_bukti)
<tr>
    <td class="text-dark fw-medium">Foto Bukti</td>
    <td class="text-dark">
        <div class="mt-2">
        <img src="{{ asset('storage/public/foto_bukti/' . basename($pendaftaran->foto_bukti)) }}"
                 alt="Foto Bukti LPK Sentosa" 
                 width="150" 
                 height="150" 
                 style="object-fit: cover; border: 1px solid #dee2e6; border-radius: 8px;">
            <div class="mt-1">
                <small class="text-muted">Foto bukti anak LPK Sentosa</small>
            </div>
        </div>
    </td>
</tr>
@endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-dark fw-medium">No. HP</td>
                                        <td class="text-dark">: {{ $pendaftaran->no_hp }} 
                                            <a href="https://wa.me/62{{ ltrim($pendaftaran->no_hp, '0') }}" 
                                               target="_blank" class="btn btn-sm ms-2 text-white" style="background-color: #02b723;" title="Chat WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @if($pendaftaran->email)
                                    <tr>
                                        <td class="text-dark fw-medium">Email</td>
                                        <td class="text-dark">: {{ $pendaftaran->email }}
                                            <a href="mailto:{{ $pendaftaran->email }}" 
                                               class="btn btn-sm ms-2 text-white" style="background-color: #dc3545;" title="Kirim Email">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-dark fw-medium">No. BPJS</td>
                                        <td class="text-dark">: 
                                            @if($pendaftaran->no_bpjs)
                                                <span class="badge text-white" style="background-color: #02b723;">{{ $pendaftaran->no_bpjs }}</span>
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Alamat</td>
                                        <td class="text-dark">: {{ $pendaftaran->alamat_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Kontak Darurat</td>
                                        <td class="text-dark">: {{ $pendaftaran->kontak_darurat }}
                                            <a href="https://wa.me/62{{ ltrim($pendaftaran->kontak_darurat, '0') }}" 
                                               target="_blank" class="btn btn-sm ms-2 text-white" style="background-color: #02b723;" title="Chat WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Hubungan</td>
                                        <td class="text-dark">: <span class="badge bg-light text-dark border">{{ $pendaftaran->hubungan_kontak_label }}</span></td>
                                    </tr>
                                    @if($pendaftaran->is_lpk_sentosa)
                                    <tr>
                                        <td class="text-dark fw-medium">Status</td>
                                        <td class="text-dark">: 
                                            <span class="badge" style="background-color: #28a745; color: white; font-size: 11px;">
                                                <i class="fas fa-check-circle me-1"></i>Anak LPK Sentosa
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        @if($pendaftaran->catatan)
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                    <h6 class="text-dark fw-bold"><i class="fas fa-sticky-note me-2" style="color: #02b723;"></i> Catatan Pasien:</h6>
                                    <p class="mb-0 text-dark">{{ $pendaftaran->catatan }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Keluhan -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-stethoscope me-2 text-danger"></i> Informasi Keluhan
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="alert alert-light border-start border-3 border-danger">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if($pendaftaran->keluhan == 'pemeriksaan_umum')
                                        <i class="fas fa-user-md fa-2x text-danger"></i>
                                    @elseif($pendaftaran->keluhan == 'lab')
                                        <i class="fas fa-vial fa-2x text-danger"></i>
                                    @elseif($pendaftaran->keluhan == 'radiologi')
                                        <i class="fas fa-x-ray fa-2x text-danger"></i>
                                    @else
                                        <i class="fas fa-clipboard-list fa-2x text-danger"></i>
                                    @endif
                                </div>
                                <div>
                                    <h5 class="text-dark mb-1">{{ $pendaftaran->keluhan_label }}</h5>
                                    <p class="text-muted mb-0">Jenis layanan yang diperlukan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Pendaftaran -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-history me-2" style="color: #02b723;"></i> Timeline Pendaftaran
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="timeline">
                            <!-- Timeline Item: Submit Pendaftaran -->
                            <div class="timeline-item">
                                <div class="timeline-marker" style="background-color: #02b723;"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Submit Pendaftaran</h6>
                                    <p class="timeline-text text-muted">
                                        @if($pendaftaran->waktu_submit)
                                            {{ $pendaftaran->waktu_submit->format('d F Y') }} - 
                                            {{ $pendaftaran->waktu_submit->format('H:i:s') }}
                                        @else
                                            {{ $pendaftaran->created_at->format('d F Y') }} - 
                                            {{ $pendaftaran->created_at->format('H:i:s') }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Timeline Item: Jadwal Pemeriksaan -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Jadwal Kehadiran</h6>
                                    <p class="timeline-text text-muted">
                                        {{ $pendaftaran->tgl_pendaftaran->format('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Timeline Item: Status Konfirmasi -->
                            @if($pendaftaran->status != 'menunggu')
                            <div class="timeline-item">
                                <div class="timeline-marker @if($pendaftaran->status == 'dikonfirmasi') bg-success @else bg-danger @endif"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">
                                        @if($pendaftaran->status == 'dikonfirmasi')
                                            Pendaftaran Dikonfirmasi
                                        @else
                                            Pendaftaran Ditolak
                                        @endif
                                    </h6>
                                    <p class="timeline-text text-muted">
                                        @if($pendaftaran->no_rekam_medis)
                                            No. Rekam Medis: {{ $pendaftaran->no_rekam_medis }}<br>
                                        @endif
                                        <small class="text-muted">
                                            {{ $pendaftaran->updated_at->format('d F Y - H:i:s') }}
                                        </small>
                                    </p>
                                </div>
                            </div>
                            @endif

                            <!-- Timeline Item: Transfer ke Layanan -->
                            @if($pendaftaran->status == 'dikonfirmasi')
                                @if($pendaftaran->isTransferredToPemeriksaanUmum())
                                <div class="timeline-item">
                                    <div class="timeline-marker" style="background-color: #02b723;"></div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title text-dark">Transfer ke Pemeriksaan Umum</h6>
                                        <p class="timeline-text text-muted">
                                            {{ $pendaftaran->pemeriksaanUmum->created_at->format('d F Y - H:i:s') }}
                                        </p>
                                    </div>
                                </div>
                                @endif

                                @if($pendaftaran->isTransferredToLaboratorium())
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-info"></div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title text-dark">Transfer ke Laboratorium</h6>
                                        <p class="timeline-text text-muted">
                                            {{ $pendaftaran->laboratorium->created_at->format('d F Y - H:i:s') }}
                                        </p>
                                    </div>
                                </div>
                                @endif

                                @if($pendaftaran->isTransferredToRadiologi())
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-warning"></div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title text-dark">Transfer ke Radiologi</h6>
                                        <p class="timeline-text text-muted">
                                            {{ $pendaftaran->radiologi->created_at->format('d F Y - H:i:s') }}
                                        </p>
                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Status & Aksi -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-tasks me-2" style="color: #02b723;"></i> Status Pendaftaran
                        </h6>
                    </div>
                    <div class="card-body bg-white text-center">
                        @if($pendaftaran->status == 'menunggu')
                            <div class="mb-3">
                                <i class="fas fa-clock fa-3x text-muted mb-2"></i>
                                <br>
                                <span class="badge bg-light text-dark border fs-6">{{ $pendaftaran->status_label }}</span>
                            </div>
                        @elseif($pendaftaran->status == 'dikonfirmasi')
                            <div class="mb-3">
                                <i class="fas fa-check-circle fa-3x mb-2" style="color: #02b723;"></i>
                                <br>
                                <span class="badge text-white fs-6" style="background-color: #02b723;">{{ $pendaftaran->status_label }}</span>
                            </div>
                            @if($pendaftaran->no_rekam_medis)
                            <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                <h6 class="text-dark"><i class="fas fa-file-medical me-2"></i> No. RM: {{ $pendaftaran->no_rekam_medis }}</h6>
                            </div>
                            @endif
                        @else
                            <div class="mb-3">
                                <i class="fas fa-times-circle fa-3x text-danger mb-2"></i>
                                <br>
                                <span class="badge bg-danger fs-6">{{ $pendaftaran->status_label }}</span>
                            </div>
                        @endif

                        <div class="mt-3 text-start">
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-calendar me-2"></i> Tanggal Daftar:</span><br>
                            <span class="text-muted ms-4">{{ $pendaftaran->tgl_pendaftaran->format('d F Y') }}</span></p>
                            
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-clock me-2"></i> Waktu Submit:</span><br>
                            <span class="text-muted ms-4">
                                @if($pendaftaran->waktu_submit)
                                    {{ $pendaftaran->waktu_submit->format('H:i:s') }}
                                @else
                                    {{ $pendaftaran->created_at->format('H:i:s') }}
                                @endif
                            </span></p>

                            @if($pendaftaran->status != 'menunggu')
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-check me-2"></i> Waktu {{ $pendaftaran->status == 'dikonfirmasi' ? 'Konfirmasi' : 'Update' }}:</span><br>
                            <span class="text-muted ms-4">{{ $pendaftaran->updated_at->format('d F Y - H:i:s') }}</span></p>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-4">
                            @if($pendaftaran->status == 'menunggu')
                                <div class="d-grid gap-2">
                                    <form method="POST" action="{{ route('admin.pendaftaran.konfirmasi', $pendaftaran->id) }}" 
                                          onsubmit="return confirm('Konfirmasi pendaftaran ini?')">
                                        @csrf
                                        <button type="submit" class="btn text-white w-100" style="background-color: #02b723;">
                                            <i class="fas fa-check me-2"></i> Konfirmasi Pendaftaran
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.pendaftaran.tolak', $pendaftaran->id) }}" 
                                          onsubmit="return confirm('Tolak pendaftaran ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="fas fa-times me-2"></i> Tolak Pendaftaran
                                        </button>
                                    </form>
                                </div>
                            @elseif($pendaftaran->status == 'dikonfirmasi')
                                <!-- Tombol Transfer ke Layanan -->
                                @if($pendaftaran->keluhan == 'pemeriksaan_umum' && !$pendaftaran->isTransferredToPemeriksaanUmum())
                                <form method="POST" action="{{ route('admin.pendaftaran.transfer-pemeriksaan-umum', $pendaftaran->id) }}" 
                                      onsubmit="return confirm('Transfer ke Pemeriksaan Umum?')">
                                    @csrf
                                    <button type="submit" class="btn btn-dark w-100">
                                        <i class="fas fa-arrow-right me-2"></i> Transfer ke Pemeriksaan Umum
                                    </button>
                                </form>
                                @endif

                                @if($pendaftaran->keluhan == 'lab' && !$pendaftaran->isTransferredToLaboratorium())
                                <form method="POST" action="{{ route('admin.pendaftaran.transfer-laboratorium', $pendaftaran->id) }}" 
                                      onsubmit="return confirm('Transfer ke Laboratorium?')">
                                    @csrf
                                    <button type="submit" class="btn btn-info w-100">
                                        <i class="fas fa-arrow-right me-2"></i> Transfer ke Laboratorium
                                    </button>
                                </form>
                                @endif

                                @if($pendaftaran->keluhan == 'radiologi' && !$pendaftaran->isTransferredToRadiologi())
                                <form method="POST" action="{{ route('admin.pendaftaran.transfer-radiologi', $pendaftaran->id) }}" 
                                      onsubmit="return confirm('Transfer ke Radiologi?')">
                                    @csrf
                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="fas fa-arrow-right me-2"></i> Transfer ke Radiologi
                                    </button>
                                </form>
                                @endif

                                @if(($pendaftaran->keluhan == 'pemeriksaan_umum' && $pendaftaran->isTransferredToPemeriksaanUmum()) ||
                                    ($pendaftaran->keluhan == 'lab' && $pendaftaran->isTransferredToLaboratorium()) ||
                                    ($pendaftaran->keluhan == 'radiologi' && $pendaftaran->isTransferredToRadiologi()))
                                <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                    <i class="fas fa-check-circle me-2" style="color: #02b723;"></i> Sudah ditransfer ke {{ $pendaftaran->keluhan_label }}
                                </div>
                                @endif
                            @else
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle me-2"></i> Pendaftaran ditolak
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                @if($pendaftaran->status == 'dikonfirmasi')
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-link me-2 text-secondary"></i> Quick Links
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        @if($pendaftaran->isTransferredToPemeriksaanUmum())
                        <a href="{{ route('admin.pemeriksaanumum.detail', $pendaftaran->pemeriksaanUmum->id) }}" 
                           class="btn btn-outline-dark w-100 mb-2">
                            <i class="fas fa-user-md me-2"></i> Lihat Pemeriksaan Umum
                        </a>
                        @endif

                        @if($pendaftaran->isTransferredToLaboratorium())
                        <a href="{{ route('admin.laboratorium.detail', $pendaftaran->laboratorium->id) }}" 
                           class="btn btn-outline-info w-100 mb-2">
                            <i class="fas fa-vial me-2"></i> Lihat Laboratorium
                        </a>
                        @endif

                        @if($pendaftaran->isTransferredToRadiologi())
                        <a href="{{ route('admin.radiologi.detail', $pendaftaran->radiologi->id) }}" 
                           class="btn btn-outline-warning w-100 mb-2">
                            <i class="fas fa-x-ray me-2"></i> Lihat Radiologi
                        </a>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Quick Stats -->
                <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="m-0 fw-bold text-dark">
            <i class="fas fa-chart-pie me-2 text-muted"></i> Statistik Cepat
        </h6>
    </div>
    <div class="card-body bg-white">
        <div class="row text-center">
            <div class="col-4">
                <div class="mb-2">
                    <i class="fas fa-user fa-2x" style="color: #02b723;"></i>
                </div>
                <h6 style="color: #02b723;">Pasien</h6>
                <p class="text-muted small">{{ $pendaftaran->jenis_kelamin_label }}, {{ $pendaftaran->tgl_lahir->age }} thn</p>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    <i class="fas fa-calendar-check fa-2x text-dark"></i>
                </div>
                <h6 class="text-dark">Hari Ini</h6>
                <p class="text-muted small">{{ now()->format('d M Y') }}</p>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    <i class="fas fa-user-tie fa-2x text-primary"></i>
                </div>
                <h6 class="text-primary">Petugas Transfer</h6>
                @if($pendaftaran->transferred_by)
                    <p class="text-muted small">{{ $pendaftaran->transferredBy->name }}</p>
                    <p class="text-muted small">{{ $pendaftaran->transferred_at->format('d/m H:i') }}</p>
                @else
                    <p class="text-muted small">Belum ditransfer</p>
                @endif
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Timeline Styles */
     .timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-content {
    padding-left: 20px;
}

.timeline-title {
    margin-bottom: 5px;
    font-size: 0.95rem;
}

.timeline-text {
    margin-bottom: 0;
    font-size: 0.85rem;
}

/* Body Background - Ubah ke warna yang lebih terang */
body {
    background-color: #f5f7fa !important;
}

/* Card Styling - Ubah background dan shadow */
.card {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 12px !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12) !important;
}

/* Card Header - Ubah background */
.card-header {
    background-color: #ffffff !important;
    border-bottom: 1px solid #e8eef5 !important;
    border-radius: 12px 12px 0 0 !important;
}

/* Card Body */
.card-body {
    background-color: #ffffff !important;
    color: #2d3748 !important;
}

/* Text Colors - Ubah ke warna yang lebih soft */
.text-dark {
    color: #2d3748 !important;
}

.text-muted {
    color: #718096 !important;
}

/* Alert Styling - Warna lebih terang */
.alert {
    border-radius: 8px;
    border: none;
}

.alert-light {
    background-color: #f7fafc !important;
    border: 1px solid #e2e8f0 !important;
    color: #2d3748 !important;
}

/* Breadcrumb - Background lebih terang */
.breadcrumb {
    background-color: #f7fafc !important;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.breadcrumb-item a {
    color: #4a5568 !important;
}

.breadcrumb-item.active {
    color: #718096 !important;
}

/* Badge Styling */
.badge {
    font-weight: 500;
    border-radius: 6px;
    padding: 0.5rem 0.75rem;
}

.bg-light {
    background-color: #f7fafc !important;
    color: #2d3748 !important;
}

/* Button Styling */
.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-outline-dark {
    border-color: #4a5568;
    color: #4a5568;
}

.btn-outline-dark:hover {
    background-color: #4a5568;
    border-color: #4a5568;
}

/* Primary Color Buttons */
.btn[style*="background-color: #02b723"] {
    background-color: #38a169 !important;
    border-color: #38a169 !important;
}

.btn[style*="background-color: #02b723"]:hover {
    background-color: #2f855a !important;
    border-color: #2f855a !important;
}

/* Badge dengan warna primary */
.badge[style*="background-color: #02b723"] {
    background-color: #38a169 !important;
}

/* Status Icons */
.fas[style*="color: #02b723"] {
    color: #38a169 !important;
}

/* Timeline marker dengan warna primary */
.timeline-marker[style*="background-color: #02b723"] {
    background-color: #38a169 !important;
}

/* Border dengan warna primary */
[style*="border-color: #02b723 !important"] {
    border-color: #38a169 !important;
}

/* Form Controls */
.form-control {
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background-color: #ffffff;
    transition: all 0.2s ease-in-out;
}

.form-control:focus {
    border-color: #38a169;
    box-shadow: 0 0 0 0.2rem rgba(56, 161, 105, 0.25);
}

/* Table Styling */
.table-borderless td {
    vertical-align: middle;
    padding: 0.75rem 0.5rem;
    color: #2d3748;
}

/* Container Background */
.container-fluid {
    background-color: #f5f7fa;
    min-height: 100vh;
    padding-top: 1rem;
    padding-bottom: 2rem;
}

/* WhatsApp Button Styling */
.btn[style*="background-color: #02b723;"][title="Chat WhatsApp"] {
    background-color: #25d366 !important;
    border-color: #25d366 !important;
}

.btn[style*="background-color: #02b723;"][title="Chat WhatsApp"]:hover {
    background-color: #128c7e !important;
    border-color: #128c7e !important;
}

/* Enhanced Card Shadows */
.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
}

/* Code Styling */
code {
    background-color: #edf2f7 !important;
    color: #2d3748 !important;
    border: 1px solid #e2e8f0;
}

/* Alert Border Styling */
.alert.border-start.border-3 {
    border-left: 4px solid #38a169 !important;
    background-color: #f0fff4 !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .timeline {
        padding-left: 20px;
    }
    
    .timeline-marker {
        left: -18px;
    }
    
    .timeline-content {
        padding-left: 15px;
    }
    
    .card-body table td {
        padding: 0.5rem 0.25rem;
    }
    
    .btn {
        font-size: 0.9rem;
    }
}

/* Print Styles */
@media print {
    .btn, .modal, .breadcrumb {
        display: none !important;
    }
    
    .card {
        border: 1px solid #000 !important;
        box-shadow: none !important;
    }
    
    .card-header {
        background-color: #f8f9fa !important;
        -webkit-print-color-adjust: exact;
    }
}

/* Custom Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.5s ease-out;
}

/* Enhanced Input Focus */
.form-control:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(56, 161, 105, 0.15);
}

/* Smooth Transitions */
* {
    transition: all 0.2s ease-in-out;
}

/* Icon Hover Effects */
.fas, .fab {
    transition: all 0.3s ease;
}

.fas:hover, .fab:hover {
    transform: scale(1.1);
}

/* Timeline Enhancements */
.timeline-item:hover .timeline-marker {
    transform: scale(1.2);
    box-shadow: 0 0 0 4px rgba(56, 161, 105, 0.2);
}

/* Mobile Optimizations */
@media (max-width: 576px) {
    .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table-borderless td {
        padding: 0.5rem 0.25rem;
        font-size: 0.9rem;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }
    
    .badge {
        font-size: 0.7rem;
    }
    
    .timeline-content {
        padding-left: 10px;
    }
}
    </style>

    <!-- JavaScript -->
    <script>
        // Document Ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeComponents();
            setupEventListeners();
            setupAnimations();
        });

        // Initialize all components
        function initializeComponents() {
            // Initialize tooltips if Bootstrap is available
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // Initialize popovers
            if (typeof bootstrap !== 'undefined' && bootstrap.Popover) {
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
            }
        }

        // Setup event listeners
        function setupEventListeners() {
            // Print functionality
            const printButton = document.querySelector('button[onclick="window.print()"]');
            if (printButton) {
                printButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    printPage();
                });
            }

            // WhatsApp link handlers
            document.querySelectorAll('a[href*="wa.me"]').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.href;
                    window.open(url, '_blank', 'width=600,height=400,scrollbars=yes,resizable=yes');
                });
            });

            // Form submission handlers
            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        handleFormSubmit(submitButton);
                    }
                });
            });

            // Confirmation dialogs
            document.querySelectorAll('form[onsubmit*="confirm"]').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const message = form.getAttribute('onsubmit').match(/confirm\('(.+)'\)/)[1];
                    
                    showConfirmDialog(message).then((confirmed) => {
                        if (confirmed) {
                            form.removeAttribute('onsubmit');
                            form.submit();
                        }
                    });
                });
            });

            // Auto-hide alerts
            setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(alert) {
                    if (alert.querySelector('.btn-close')) {
                        fadeOutAlert(alert);
                    }
                });
            }, 5000);
        }

        // Setup animations
        function setupAnimations() {
            // Smooth scroll for timeline
            const timelineItems = document.querySelectorAll('.timeline-item');
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            timelineItems.forEach(function(item) {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                item.style.transition = 'all 0.5s ease-in-out';
                observer.observe(item);
            });

            // Animate cards on scroll
            const cards = document.querySelectorAll('.card');
            const cardObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(function(card, index) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = `all 0.5s ease-in-out ${index * 0.1}s`;
                cardObserver.observe(card);
            });
        }

        // Enhanced print functionality
        function printPage() {
            // Hide non-printable elements
            const elementsToHide = document.querySelectorAll('.btn, .breadcrumb, .alert .btn-close');
            elementsToHide.forEach(el => el.style.display = 'none');

            // Add print styles
            const printStyle = document.createElement('style');
            printStyle.textContent = `
                @media print {
                    body { font-size: 12pt; }
                    .card { page-break-inside: avoid; }
                    .timeline-item { page-break-inside: avoid; }
                    .no-print { display: none !important; }
                }
            `;
            document.head.appendChild(printStyle);

            // Print
            window.print();

            // Restore elements
            setTimeout(() => {
                elementsToHide.forEach(el => el.style.display = '');
                document.head.removeChild(printStyle);
            }, 1000);
        }

        // Enhanced form submission handler
        function handleFormSubmit(button) {
            const originalText = button.innerHTML;
            const originalDisabled = button.disabled;

            // Show loading state
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
            button.disabled = true;
            button.classList.add('btn-loading');

            // Restore after timeout (fallback)
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = originalDisabled;
                button.classList.remove('btn-loading');
            }, 10000);
        }

        // Enhanced confirmation dialog
        function showConfirmDialog(message) {
            return new Promise((resolve) => {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    // Create custom modal for confirmation
                    const modalHtml = `
                        <div class="modal fade" id="confirmModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">Konfirmasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <i class="fas fa-question-circle fa-3x text-warning mb-3"></i>
                                            <p>${message}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary" id="confirmButton">Ya, Lanjutkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    document.body.insertAdjacentHTML('beforeend', modalHtml);
                    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                    
                    document.getElementById('confirmButton').addEventListener('click', function() {
                        modal.hide();
                        document.getElementById('confirmModal').remove();
                        resolve(true);
                    });
                    
                    document.getElementById('confirmModal').addEventListener('hidden.bs.modal', function() {
                        document.getElementById('confirmModal').remove();
                        resolve(false);
                    });
                    
                    modal.show();
                } else {
                    // Fallback to native confirm
                    resolve(confirm(message));
                }
            });
        }

        // Fade out alert
        function fadeOutAlert(alert) {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }

        // Utility function to format numbers
        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        // Utility function to format dates
        function formatDate(date) {
            return new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }).format(new Date(date));
        }

        // Real-time clock for current time display
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID');
            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            
            const clockElement = document.getElementById('realTimeClock');
            if (clockElement) {
                clockElement.innerHTML = `${dateString}<br><small>${timeString}</small>`;
            }
        }

        // Update clock every second
        setInterval(updateClock, 1000);
        updateClock(); // Initial call

        // Smooth scroll to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show scroll to top button
        window.addEventListener('scroll', function() {
            const scrollButton = document.getElementById('scrollToTop');
            if (scrollButton) {
                if (window.pageYOffset > 300) {
                    scrollButton.style.display = 'block';
                } else {
                    scrollButton.style.display = 'none';
                }
            }
        });

        // Add scroll to top button
        document.body.insertAdjacentHTML('beforeend', `
            <button id="scrollToTop" class="btn btn-primary position-fixed bottom-0 end-0 m-3" 
                    style="display: none; z-index: 1000; border-radius: 50%; width: 50px; height: 50px;"
                    onclick="scrollToTop()" title="Kembali ke atas">
                <i class="fas fa-chevron-up"></i>
            </button>
        `);

        // Error handling for images
        document.querySelectorAll('img').forEach(function(img) {
            img.addEventListener('error', function() {
                this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjUwIiB5PSI1MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjNmM3NTdkIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+Tm8gSW1hZ2U8L3RleHQ+PC9zdmc+';
                this.style.opacity = '0.5';
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + P for print
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                printPage();
            }
            
            // Escape to close modals
            if (e.key === 'Escape') {
                const modals = document.querySelectorAll('.modal.show');
                modals.forEach(modal => {
                    bootstrap.Modal.getInstance(modal).hide();
                });
            }
        });

        // Performance monitoring
        window.addEventListener('load', function() {
            console.log('Page loaded in:', performance.now(), 'ms');
        });

        // Service worker registration (optional)
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js').catch(function(error) {
                console.log('Service worker registration failed:', error);
            });
        }
    </script>

    <!-- Scroll to Top Button -->
    <div id="scrollToTop" class="position-fixed bottom-0 end-0 m-3" style="display: none; z-index: 1000;">
        <button class="btn btn-primary rounded-circle" onclick="scrollToTop()" title="Kembali ke atas">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>

    <!-- Real-time Clock (optional) -->
    <div class="position-fixed top-0 end-0 m-3 d-none d-lg-block" style="z-index: 999;">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-2 text-center">
                <div id="realTimeClock" style="font-size: 0.8rem; color: #6c757d;"></div>
            </div>
        </div>
    </div>
</x-admin-layout>
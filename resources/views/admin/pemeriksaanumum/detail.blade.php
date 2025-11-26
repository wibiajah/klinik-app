<x-admin-layout title="Detail Pemeriksaan Umum">
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-dark fw-bold">Detail Pemeriksaan Umum</h1>
            <div>
                <a href="{{ route('admin.pemeriksaanumum.index') }}" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                @if($pemeriksaan->status_pemeriksaan == 'selesai')
                <button class="btn btn-dark ms-2" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak Hasil
                </button>
                @endif
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-light rounded px-3 py-2">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pemeriksaanumum.index') }}" class="text-dark">Pemeriksaan Umum</a></li>
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
                            <i class="fas fa-user-injured me-2" style="color: #02b723;"></i> Informasi Pasien
                        </h6>
                        @if($pemeriksaan->no_antrian)
                        <span class="badge fs-6 text-white" style="background-color: #02b723;">No. Antrian: {{ $pemeriksaan->no_antrian }}</span>
                        @endif
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-dark fw-medium">No. Rekam Medis</td>
                                        <td class="text-dark">: <code class="bg-light p-1 rounded text-dark">{{ $pemeriksaan->no_rekam_medis }}</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">NIK</td>
                                        <td class="text-dark">: {{ $pemeriksaan->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Nama Lengkap</td>
                                        <td class="text-dark">: <span class="fw-bold" style="color: #02b723;">{{ $pemeriksaan->nama }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Jenis Kelamin</td>
                                        <td class="text-dark">: 
                                            @if($pemeriksaan->jenis_kelamin == 'L')
                                                <i class="fas fa-mars" style="color: #02b723;"></i> {{ $pemeriksaan->jenis_kelamin_label }}
                                            @else
                                                <i class="fas fa-venus text-muted"></i> {{ $pemeriksaan->jenis_kelamin_label }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Tanggal Lahir</td>
                                        <td class="text-dark">: {{ $pemeriksaan->tgl_lahir->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Umur</td>
                                        <td class="text-dark">: <span class="badge bg-light text-dark border">{{ $pemeriksaan->tgl_lahir->age }} tahun</span></td>
                                    </tr>
                                      @if($pemeriksaan->is_lpk_sentosa && $pemeriksaan->foto_bukti)
<tr>
    <td class="text-dark fw-medium">Foto Bukti</td>
    <td class="text-dark">
        <div class="mt-2">
        <img src="{{ asset('storage/public/foto_bukti/' . basename($pemeriksaan->foto_bukti)) }}"
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
                                        <td class="text-dark">: {{ $pemeriksaan->no_hp }} 
                                            <a href="https://wa.me/62{{ ltrim($pemeriksaan->no_hp, '0') }}" 
                                               target="_blank" class="btn btn-sm ms-2 text-white" style="background-color: #02b723;" title="Chat WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">No. BPJS</td>
                                        <td class="text-dark">: 
                                            @if($pemeriksaan->no_bpjs)
                                                <span class="badge text-white" style="background-color: #02b723;">{{ $pemeriksaan->no_bpjs }}</span>
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Alamat</td>
                                        <td class="text-dark">: {{ $pemeriksaan->alamat_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Kontak Darurat</td>
                                        <td class="text-dark">: {{ $pemeriksaan->kontak_darurat }}
                                            <a href="https://wa.me/62{{ ltrim($pemeriksaan->kontak_darurat, '0') }}" 
                                               target="_blank" class="btn btn-sm ms-2 text-white" style="background-color: #02b723;" title="Chat WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Hubungan</td>
                                        <td class="text-dark">: <span class="badge bg-light text-dark border">{{ ucfirst($pemeriksaan->hubungan_kontak) }}</span></td>
                                    </tr>
                              
                                </table>
                            </div>
                        </div>

                        @if($pemeriksaan->catatan)
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                    <h6 class="text-dark fw-bold"><i class="fas fa-sticky-note me-2" style="color: #02b723;"></i> Catatan Pasien:</h6>
                                    <p class="mb-0 text-dark">{{ $pemeriksaan->catatan }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline Pemeriksaan -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-history me-2" style="color: #02b723;"></i> Timeline Pemeriksaan
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="timeline">
                            <!-- Timeline Item: Pendaftaran -->
                            <div class="timeline-item">
                                <div class="timeline-marker" style="background-color: #02b723;"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Pendaftaran</h6>
                                    <p class="timeline-text text-muted">
                                        {{ $pemeriksaan->pendaftaran->tgl_pendaftaran->format('d F Y') }} - 
                                        {{ $pemeriksaan->pendaftaran->created_at->format('H:i:s') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Timeline Item: Transfer ke Pemeriksaan Umum -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Transfer ke Pemeriksaan Umum</h6>
                                    <p class="timeline-text text-muted">
                                        {{ $pemeriksaan->tgl_transfer->format('d F Y') }} - 
                                        {{ $pemeriksaan->created_at->format('H:i:s') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Timeline Item: Dikonfirmasi & Diberi No. Antrian -->
                            @if($pemeriksaan->status_pemeriksaan != 'menunggu')
                            <div class="timeline-item">
                                <div class="timeline-marker bg-dark"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Dikonfirmasi & Diberi No. Antrian</h6>
                                    <p class="timeline-text text-muted">
                                        No. Antrian: {{ $pemeriksaan->no_antrian }}<br>
                                        @if($pemeriksaan->waktu_konfirmasi)
                                            <p class="timeline-text text-muted">
                                                {{ $pemeriksaan->waktu_konfirmasi->format('d F Y - H:i:s') }}
                                            </p>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif

                            <!-- Timeline Item: Mulai Pemeriksaan -->
                            @if(in_array($pemeriksaan->status_pemeriksaan, ['sedang_diperiksa', 'selesai']))
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Mulai Pemeriksaan</h6>
                                    <p class="timeline-text text-muted">
                                        @if($pemeriksaan->waktu_mulai_periksa)
                                            {{ $pemeriksaan->waktu_mulai_periksa->format('d F Y - H:i:s') }}
                                        @else
                                            <span class="text-muted">Pemeriksaan dimulai</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif

                            <!-- Timeline Item: Pemeriksaan Selesai -->
                            @if($pemeriksaan->status_pemeriksaan == 'selesai')
                            <div class="timeline-item">
                                <div class="timeline-marker" style="background-color: #02b723;"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Pemeriksaan Selesai</h6>
                                    <p class="timeline-text text-muted">
                                        @if($pemeriksaan->waktu_selesai_periksa)
                                            {{ $pemeriksaan->waktu_selesai_periksa->format('d F Y - H:i:s') }}
                                        @else
                                            {{ $pemeriksaan->updated_at->format('d F Y - H:i:s') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
<!-- Tracking Petugas -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="m-0 fw-bold text-dark">
            <i class="fas fa-user-check me-2" style="color: #02b723;"></i> Tracking Petugas
        </h6>
    </div>
    <div class="card-body bg-white">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td width="45%" class="text-dark fw-medium">
                            <i class="fas fa-download text-primary me-2"></i>Transfer Dari Pendaftaran
                        </td>
                        <td class="text-dark">: 
                            @if($pemeriksaan->pendaftaran && $pemeriksaan->pendaftaran->transferredBy)
                                <span class="fw-semibold">{{ $pemeriksaan->pendaftaran->transferredBy->name }}</span>
                                @if($pemeriksaan->pendaftaran->transferred_at)
                                    <br><small class="text-muted">{{ $pemeriksaan->pendaftaran->transferred_at->format('d/m/Y H:i:s') }}</small>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-dark fw-medium">
                            <i class="fas fa-clipboard-check text-warning me-2"></i>Konfirmasi & Set Antrian
                        </td>
                        <td class="text-dark">: 
                            @if($pemeriksaan->konfirmasiBy)
                                <span class="fw-semibold">{{ $pemeriksaan->konfirmasiBy->name }}</span>
                                @if($pemeriksaan->waktu_konfirmasi)
                                    <br><small class="text-muted">{{ $pemeriksaan->waktu_konfirmasi->format('d/m/Y H:i:s') }}</small>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td width="45%" class="text-dark fw-medium">
                            <i class="fas fa-play text-success me-2"></i>Mulai Pemeriksaan
                        </td>
                        <td class="text-dark">: 
                            @if($pemeriksaan->mulaiPeriksaBy)
                                <span class="fw-semibold">{{ $pemeriksaan->mulaiPeriksaBy->name }}</span>
                                @if($pemeriksaan->waktu_mulai_periksa)
                                    <br><small class="text-muted">{{ $pemeriksaan->waktu_mulai_periksa->format('d/m/Y H:i:s') }}</small>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-dark fw-medium">
                            <i class="fas fa-check text-info me-2"></i>Selesai Pemeriksaan
                        </td>
                        <td class="text-dark">: 
                            @if($pemeriksaan->selesaiPeriksaBy)
                                <span class="fw-semibold">{{ $pemeriksaan->selesaiPeriksaBy->name }}</span>
                                @if($pemeriksaan->waktu_selesai_periksa)
                                    <br><small class="text-muted">{{ $pemeriksaan->waktu_selesai_periksa->format('d/m/Y H:i:s') }}</small>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
                <!-- Hasil Pemeriksaan -->
                @if($pemeriksaan->status_pemeriksaan == 'selesai' && $pemeriksaan->diagnosis_sementara)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-file-medical me-2" style="color: #02b723;"></i> Hasil Pemeriksaan
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-diagnoses me-2 text-danger"></i> Diagnosis Sementara:</h6>
                                    <div class="alert alert-light border-start border-3 border-danger">
                                        <p class="mb-0 text-dark">{{ $pemeriksaan->diagnosis_sementara }}</p>
                                    </div>
                                </div>

                                @if($pemeriksaan->obat_diberikan)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-pills me-2" style="color: #02b723;"></i> Obat yang Diberikan:</h6>
                                    <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                        <p class="mb-0 text-dark">{!! nl2br(e($pemeriksaan->obat_diberikan)) !!}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($pemeriksaan->anjuran_instruksi)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-clipboard-list me-2 text-dark"></i> Anjuran / Instruksi:</h6>
                                    <div class="alert alert-light border-start border-3 border-dark">
                                        <p class="mb-0 text-dark">{!! nl2br(e($pemeriksaan->anjuran_instruksi)) !!}</p>
                                    </div>
                                </div>
                                @endif

                                @if($pemeriksaan->rujukan)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-hospital me-2 text-secondary"></i> Rujukan:</h6>
                                    <div class="alert alert-light border-start border-3 border-secondary">
                                        <p class="mb-0 text-dark">{{ $pemeriksaan->rujukan }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Status & Aksi -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-tasks me-2" style="color: #02b723;"></i> Status Pemeriksaan
                        </h6>
                    </div>
                    <div class="card-body bg-white text-center">
                        @if($pemeriksaan->status_pemeriksaan == 'menunggu')
                            <div class="mb-3">
                                <i class="fas fa-clock fa-3x text-muted mb-2"></i>
                                <br>
                                <span class="badge bg-light text-dark border fs-6">{{ $pemeriksaan->status_pemeriksaan_label }}</span>
                            </div>
                        @elseif($pemeriksaan->status_pemeriksaan == 'dikonfirmasi')
                            <div class="mb-3">
                                <i class="fas fa-list-ol fa-3x text-dark mb-2"></i>
                                <br>
                                <span class="badge bg-dark fs-6">{{ $pemeriksaan->status_pemeriksaan_label }}</span>
                            </div>
                            <div class="alert alert-light border">
                                <h5 class="text-dark"><i class="fas fa-list-ol me-2"></i> No. Antrian: {{ $pemeriksaan->no_antrian }}</h5>
                            </div>
                        @elseif($pemeriksaan->status_pemeriksaan == 'sedang_diperiksa')
                            <div class="mb-3">
                                <i class="fas fa-user-md fa-3x text-secondary mb-2"></i>
                                <br>
                                <span class="badge bg-secondary fs-6">{{ $pemeriksaan->status_pemeriksaan_label }}</span>
                            </div>
                            <div class="alert alert-light border">
                                <h6 class="text-dark"><i class="fas fa-list-ol me-2"></i> No. Antrian: {{ $pemeriksaan->no_antrian }}</h6>
                            </div>
                        @else
                            <div class="mb-3">
                                <i class="fas fa-check-circle fa-3x mb-2" style="color: #02b723;"></i>
                                <br>
                                <span class="badge text-white fs-6" style="background-color: #02b723;">{{ $pemeriksaan->status_pemeriksaan_label }}</span>
                            </div>
                            @if($pemeriksaan->no_antrian)
                            <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                <h6 class="text-dark"><i class="fas fa-list-ol me-2"></i> No. Antrian: {{ $pemeriksaan->no_antrian }}</h6>
                            </div>
                            @endif
                        @endif

                        <div class="mt-3 text-start">
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-calendar me-2"></i> Tanggal Transfer:</span><br>
                            <span class="text-muted ms-4">{{ $pemeriksaan->tgl_transfer->format('d F Y') }}</span></p>
                            
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-clock me-2"></i> Jam Transfer:</span><br>
                            <span class="text-muted ms-4">{{ $pemeriksaan->created_at->format('H:i:s') }}</span></p>

                            @if($pemeriksaan->status_pemeriksaan == 'selesai')
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-check me-2"></i> Waktu Selesai:</span><br>
                            <span class="text-muted ms-4">{{ $pemeriksaan->updated_at->format('d F Y - H:i:s') }}</span></p>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-4">
                            @if($pemeriksaan->status_pemeriksaan == 'menunggu')
                                <form method="POST" action="{{ route('admin.pemeriksaanumum.konfirmasi', $pemeriksaan->id) }}" 
                                      onsubmit="return confirm('Konfirmasi dan beri nomor antrian?')">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-dark w-100">
                                        <i class="fas fa-check me-2"></i> Konfirmasi & Beri No. Antrian
                                    </button>
                                </form>
                            @elseif($pemeriksaan->status_pemeriksaan == 'dikonfirmasi')
                                <form method="POST" action="{{ route('admin.pemeriksaanumum.update-status', $pemeriksaan->id) }}" 
                                      onsubmit="return confirm('Mulai pemeriksaan?')">
                                    @csrf
                                    <input type="hidden" name="status_pemeriksaan" value="sedang_diperiksa">
                                    <button type="submit" class="btn btn-dark w-100">
                                        <i class="fas fa-play me-2"></i> Mulai Pemeriksaan
                                    </button>
                                </form>
                            @elseif($pemeriksaan->status_pemeriksaan == 'sedang_diperiksa')
                                <button type="button" class="btn text-white w-100" style="background-color: #02b723;"
                                        onclick="openHasilModal({{ $pemeriksaan->id }})">
                                    <i class="fas fa-check me-2"></i> Selesaikan Pemeriksaan
                                </button>
                            @else
                                <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                    <i class="fas fa-check-circle me-2" style="color: #02b723;"></i> Pemeriksaan telah selesai
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informasi Pendaftaran Asal -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-file-alt me-2 text-secondary"></i> Informasi Pendaftaran
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="text-center mb-3">
                            <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                        </div>
                        
                        <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-calendar me-2"></i> Tanggal Daftar:</span><br>
                        <span class="text-muted">{{ $pemeriksaan->pendaftaran->tgl_pendaftaran->format('d F Y') }}</span></p>
                        
                        <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-clock me-2"></i> Jam Daftar:</span><br>
                        <span class="text-muted">{{ $pemeriksaan->pendaftaran->created_at->format('H:i:s') }}</span></p>

                        <p class="mb-3"><span class="fw-bold text-dark"><i class="fas fa-user-check me-2"></i> Status Pendaftaran:</span><br>
                        <span class="badge text-white" style="background-color: #02b723;">{{ ucfirst($pemeriksaan->pendaftaran->status) }}</span></p>

                        <a href="{{ route('admin.pendaftaran.detail', $pemeriksaan->pendaftaran_id) }}" 
                           class="btn btn-outline-secondary w-100">
                            <i class="fas fa-eye me-2"></i> Lihat Detail Pendaftaran
                        </a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-chart-pie me-2 text-muted"></i> Statistik Cepat
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mb-2">
                                    <i class="fas fa-user-injured fa-2x" style="color: #02b723;"></i>
                                </div>
                                <h6 style="color: #02b723;">Pasien</h6>
                                <p class="text-muted small">{{ $pemeriksaan->jenis_kelamin_label }}, {{ $pemeriksaan->tgl_lahir->age }} thn</p>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <i class="fas fa-calendar-check fa-2x text-dark"></i>
                                </div>
                                <h6 class="text-dark">Hari Ini</h6>
                                <p class="text-muted small">{{ now()->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hasil Pemeriksaan -->
    <div class="modal fade" id="hasilModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header text-white" style="background-color: #02b723;">
                    <h5 class="modal-title">
                        <i class="fas fa-file-medical me-2"></i> Input Hasil Pemeriksaan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="hasilForm" method="POST">
                    @csrf
                    <input type="hidden" name="status_pemeriksaan" value="selesai">
                    <div class="modal-body bg-white">
                        <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                            <i class="fas fa-info-circle me-2" style="color: #02b723;"></i> 
                            Lengkapi hasil pemeriksaan untuk pasien <strong class="text-dark">{{ $pemeriksaan->nama }}</strong>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-diagnoses text-danger me-2"></i> Diagnosis Sementara *
                            </label>
                            <textarea name="diagnosis_sementara" class="form-control border" rows="3" required 
                                    placeholder="Contoh: Flu, Infeksi Saluran Pernapasan, Hipertensi, Gastritis, dll"></textarea>
                            <small class="text-muted">Tulis diagnosis berdasarkan gejala dan pemeriksaan</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-pills me-2" style="color: #02b723;"></i> Obat yang Diberikan
                            </label>
                            <textarea name="obat_diberikan" class="form-control border" rows="4" 
                                    placeholder="Contoh:&#10;- Paracetamol 500 mg, 3x sehari&#10;- Amoxicillin 500 mg, 3x sehari&#10;- ORS, sesuai kebutuhan"></textarea>
                            <small class="text-muted">Tulis nama obat, dosis, dan aturan pakai</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-clipboard-list text-dark me-2"></i> Anjuran / Instruksi
                            </label>
                            <textarea name="anjuran_instruksi" class="form-control border" rows="4" 
                                    placeholder="Contoh:&#10;- Istirahat cukup 7-8 jam sehari&#10;- Minum air putih minimal 8 gelas per hari&#10;- Hindari makanan pedas dan berlemak&#10;- Kontrol ulang jika keluhan bertambah"></textarea>
                            <small class="text-muted">Berikan saran perawatan dan pantangan</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-hospital text-secondary me-2"></i> Rujukan
                                </label>
                            <textarea name="rujukan" class="form-control border" rows="3" 
                                    placeholder="Contoh: RS Umum Daerah untuk pemeriksaan EKG, Puskesmas untuk kontrol rutin, Spesialis Penyakit Dalam"></textarea>
                            <small class="text-muted">Tulis rujukan jika diperlukan pemeriksaan lanjutan</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Batal
                        </button>
                        <button type="submit" class="btn text-white" style="background-color: #02b723;">
                            <i class="fas fa-check me-2"></i> Selesaikan Pemeriksaan
                        </button>
                    </div>
                </form>
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

        /* Card Hover Effects */
        .card {
            transition: all 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        /* Badge Custom Styles */
        .badge {
            font-weight: 500;
        }

        /* Button Hover Effects */
        .btn {
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Modal Enhancements */
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            border-radius: 10px 10px 0 0;
        }

        /* Form Controls */
        .form-control {
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            border-color: #02b723;
            box-shadow: 0 0 0 0.2rem rgba(2, 183, 35, 0.25);
        }

        /* Alert Enhancements */
        .alert {
            border-radius: 8px;
        }

        /* Breadcrumb Styling */
        .breadcrumb {
            border-radius: 8px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: #6c757d;
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

        /* Status Icons Animation */
        .fa-spin-custom {
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* WhatsApp Button Styling */
        .btn-whatsapp {
            background-color: #25d366;
            border-color: #25d366;
            transition: all 0.2s ease-in-out;
        }

        .btn-whatsapp:hover {
            background-color: #128c7e;
            border-color: #128c7e;
            transform: scale(1.05);
        }

        /* Table Enhancements */
        .table-borderless td {
            vertical-align: middle;
            padding: 0.75rem 0.5rem;
        }

        /* Status Badge Animation */
        .badge {
            position: relative;
            overflow: hidden;
        }

        .badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .badge:hover::before {
            left: 100%;
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Function to open hasil modal
        function openHasilModal(pemeriksaanId) {
            const modal = new bootstrap.Modal(document.getElementById('hasilModal'));
            const form = document.getElementById('hasilForm');
            form.action = `/admin/pemeriksaan-umum/${pemeriksaanId}/update-status`;
            modal.show();
        }

        // Auto-resize textareas
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(function(textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });
        });

        // Confirmation dialogs with custom styling
        document.querySelectorAll('form[onsubmit*="confirm"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = form.getAttribute('onsubmit').match(/confirm\('(.+)'\)/)[1];
                
                if (confirm(message)) {
                    form.removeAttribute('onsubmit');
                    form.submit();
                }
            });
        });

        // Loading state for buttons
        document.querySelectorAll('button[type="submit"]').forEach(function(button) {
            button.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 3000);
            });
        });

        // Print functionality enhancement
        function printPage() {
            window.print();
        }

        // Smooth scroll for timeline
        document.addEventListener('DOMContentLoaded', function() {
            const timelineItems = document.querySelectorAll('.timeline-item');
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }
                });
            });

            timelineItems.forEach(function(item) {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                item.style.transition = 'all 0.5s ease-in-out';
                observer.observe(item);
            });
        });

        // WhatsApp link handler
        document.querySelectorAll('a[href*="wa.me"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                window.open(url, '_blank', 'width=600,height=400');
            });
        });

        // Form validation enhancement
        document.getElementById('hasilForm').addEventListener('submit', function(e) {
            const diagnosis = document.querySelector('textarea[name="diagnosis_sementara"]');
            
            if (!diagnosis.value.trim()) {
                e.preventDefault();
                diagnosis.focus();
                diagnosis.style.borderColor = '#dc3545';
                
                // Show error message
                let errorMsg = diagnosis.parentNode.querySelector('.error-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('small');
                    errorMsg.className = 'error-message text-danger';
                    errorMsg.textContent = 'Diagnosis sementara wajib diisi';
                    diagnosis.parentNode.appendChild(errorMsg);
                }
                
                setTimeout(() => {
                    diagnosis.style.borderColor = '';
                    if (errorMsg) errorMsg.remove();
                }, 3000);
            }
        });

        // Auto-save draft functionality (optional)
        let autoSaveTimer;
        document.querySelectorAll('#hasilModal textarea').forEach(function(textarea) {
            textarea.addEventListener('input', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(() => {
                    // Save to sessionStorage as draft
                    const formData = {};
                    document.querySelectorAll('#hasilModal textarea').forEach(function(field) {
                        formData[field.name] = field.value;
                    });
                    sessionStorage.setItem('hasilDraft', JSON.stringify(formData));
                }, 1000);
            });
        });

        // Load draft on modal open
        document.getElementById('hasilModal').addEventListener('shown.bs.modal', function() {
            const draft = sessionStorage.getItem('hasilDraft');
            if (draft) {
                const formData = JSON.parse(draft);
                Object.keys(formData).forEach(function(key) {
                    const field = document.querySelector(`textarea[name="${key}"]`);
                    if (field && !field.value) {
                        field.value = formData[key];
                    }
                });
            }
        });

        // Clear draft on successful submit
        document.getElementById('hasilForm').addEventListener('submit', function() {
            sessionStorage.removeItem('hasilDraft');
        });

        // Enhanced tooltip functionality for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips if Bootstrap tooltip is available
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        });
    </script>
</x-admin-layout>
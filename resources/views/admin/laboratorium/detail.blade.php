<x-admin-layout title="Detail Laboratorium">
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-dark fw-bold">Detail Laboratorium</h1>
            <div>
                <a href="{{ route('admin.laboratorium.index') }}" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                @if($laboratorium->status_pemeriksaan == 'selesai')
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
                <li class="breadcrumb-item"><a href="{{ route('admin.laboratorium.index') }}" class="text-dark">Data Laboratorium</a></li>
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
                        @if($laboratorium->no_antrian)
                        <span class="badge fs-6 text-white" style="background-color: #02b723;">No. Antrian: {{ $laboratorium->no_antrian }}</span>
                        @endif
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-dark fw-medium">No. Rekam Medis</td>
                                        <td class="text-dark">: <code class="bg-light p-1 rounded text-dark">{{ $laboratorium->no_rekam_medis }}</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">NIK</td>
                                        <td class="text-dark">: {{ $laboratorium->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Nama Lengkap</td>
                                        <td class="text-dark">: <span class="fw-bold" style="color: #02b723;">{{ $laboratorium->nama }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Jenis Kelamin</td>
                                        <td class="text-dark">: 
                                            @if($laboratorium->jenis_kelamin == 'L')
                                                <i class="fas fa-mars" style="color: #02b723;"></i> {{ $laboratorium->jenis_kelamin_label }}
                                            @else
                                                <i class="fas fa-venus text-muted"></i> {{ $laboratorium->jenis_kelamin_label }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Tanggal Lahir</td>
                                        <td class="text-dark">: {{ $laboratorium->tgl_lahir->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Umur</td>
                                        <td class="text-dark">: <span class="badge bg-light text-dark border">{{ $laboratorium->tgl_lahir->age }} tahun</span></td>
                                    </tr>
                                       @if($laboratorium->is_lpk_sentosa && $laboratorium->foto_bukti)
<tr>
    <td class="text-dark fw-medium">Foto Bukti</td>
    <td class="text-dark">
        <div class="mt-2">
        <img src="{{ asset('storage/public/foto_bukti/' . basename($laboratorium->foto_bukti)) }}"
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
                                        <td class="text-dark">: {{ $laboratorium->no_hp }} 
                                            <a href="https://wa.me/62{{ ltrim($laboratorium->no_hp, '0') }}" 
                                               target="_blank" class="btn btn-sm ms-2 text-white" style="background-color: #02b723;" title="Chat WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">No. BPJS</td>
                                        <td class="text-dark">: 
                                            @if($laboratorium->no_bpjs)
                                                <span class="badge text-white" style="background-color: #02b723;">{{ $laboratorium->no_bpjs }}</span>
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Alamat</td>
                                        <td class="text-dark">: {{ $laboratorium->alamat_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Kontak Darurat</td>
                                        <td class="text-dark">: {{ $laboratorium->kontak_darurat }}
                                            <a href="https://wa.me/62{{ ltrim($laboratorium->kontak_darurat, '0') }}" 
                                               target="_blank" class="btn btn-sm ms-2 text-white" style="background-color: #02b723;" title="Chat WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-medium">Hubungan</td>
                                        <td class="text-dark">: <span class="badge bg-light text-dark border">{{ ucfirst($laboratorium->hubungan_kontak) }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        @if($laboratorium->catatan)
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                    <h6 class="text-dark fw-bold"><i class="fas fa-sticky-note me-2" style="color: #02b723;"></i> Catatan Pasien:</h6>
                                    <p class="mb-0 text-dark">{{ $laboratorium->catatan }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline Laboratorium -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-history me-2" style="color: #02b723;"></i> Timeline Laboratorium
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
                                        {{ $laboratorium->pendaftaran->tgl_pendaftaran->format('d F Y') }} - 
                                        {{ $laboratorium->pendaftaran->created_at->format('H:i:s') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Timeline Item: Transfer ke Laboratorium -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Transfer ke Laboratorium</h6>
                                    <p class="timeline-text text-muted">
                                        {{ $laboratorium->tgl_pemeriksaan->format('d F Y') }} - 
                                        {{ $laboratorium->created_at->format('H:i:s') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Timeline Item: Dikonfirmasi & Diberi No. Antrian -->
                            @if($laboratorium->no_antrian)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-dark"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Dikonfirmasi & Diberi No. Antrian</h6>
                                    <p class="timeline-text text-muted">
                                        No. Antrian: {{ $laboratorium->no_antrian }}<br>
                                        @if($laboratorium->set_antrian_at)
                                            <p class="timeline-text text-muted">
                                                {{ $laboratorium->set_antrian_at->format('d F Y - H:i:s') }}
                                            </p>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif

                            <!-- Timeline Item: Mulai Pemeriksaan -->
                            @if(in_array($laboratorium->status_pemeriksaan, ['sedang_diperiksa', 'selesai']))
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Mulai Pemeriksaan</h6>
                                    <p class="timeline-text text-muted">
                                        @if($laboratorium->mulai_periksa_at)
                                            {{ $laboratorium->mulai_periksa_at->format('d F Y - H:i:s') }}
                                        @else
                                            <span class="text-muted">Pemeriksaan dimulai</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif

                            <!-- Timeline Item: Pemeriksaan Selesai -->
                            @if($laboratorium->status_pemeriksaan == 'selesai')
                            <div class="timeline-item">
                                <div class="timeline-marker" style="background-color: #02b723;"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title text-dark">Pemeriksaan Selesai</h6>
                                    <p class="timeline-text text-muted">
                                        @if($laboratorium->selesai_periksa_at)
                                            {{ $laboratorium->selesai_periksa_at->format('d F Y - H:i:s') }}
                                        @else
                                            {{ $laboratorium->updated_at->format('d F Y - H:i:s') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
<!-- Tracking Petugas Laboratorium -->
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
                            @if($laboratorium->pendaftaran && $laboratorium->pendaftaran->transferredBy)
                                <span class="fw-semibold">{{ $laboratorium->pendaftaran->transferredBy->name }}</span>
                                @if($laboratorium->pendaftaran->transferred_at)
                                    <br><small class="text-muted">{{ $laboratorium->pendaftaran->transferred_at->format('d/m/Y H:i:s') }}</small>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-dark fw-medium">
                            <i class="fas fa-clipboard-check text-warning me-2"></i>Set Antrian
                        </td>
                        <td class="text-dark">: 
                            @if($laboratorium->userSetAntrian)
                                <span class="fw-semibold">{{ $laboratorium->userSetAntrian->name }}</span>
                                @if($laboratorium->set_antrian_at)
                                    <br><small class="text-muted">{{ $laboratorium->set_antrian_at->format('d/m/Y H:i:s') }}</small>
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
                            @if($laboratorium->userMulaiPeriksa)
                                <span class="fw-semibold">{{ $laboratorium->userMulaiPeriksa->name }}</span>
                                @if($laboratorium->mulai_periksa_at)
                                    <br><small class="text-muted">{{ $laboratorium->mulai_periksa_at->format('d/m/Y H:i:s') }}</small>
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
                            @if($laboratorium->userSelesaiPeriksa)
                                <span class="fw-semibold">{{ $laboratorium->userSelesaiPeriksa->name }}</span>
                                @if($laboratorium->selesai_periksa_at)
                                    <br><small class="text-muted">{{ $laboratorium->selesai_periksa_at->format('d/m/Y H:i:s') }}</small>
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
                <!-- Hasil Laboratorium -->
                @if($laboratorium->status_pemeriksaan == 'selesai' && $laboratorium->hasil_lab)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-flask me-2" style="color: #02b723;"></i> Hasil Laboratorium
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-vial me-2" style="color: #02b723;"></i> Hasil Pemeriksaan:</h6>
                                    <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                        <p class="mb-0 text-dark">{!! nl2br(e($laboratorium->hasil_lab)) !!}</p>
                                    </div>
                                </div>

                                @if($laboratorium->dokter_pemeriksa)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-user-md me-2 text-secondary"></i> Dokter Pemeriksa:</h6>
                                    <div class="alert alert-light border-start border-3 border-secondary">
                                        <p class="mb-0 text-dark">{{ $laboratorium->dokter_pemeriksa }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($laboratorium->catatan_lab)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-clipboard-list me-2 text-dark"></i> Catatan Tambahan:</h6>
                                    <div class="alert alert-light border-start border-3 border-dark">
                                        <p class="mb-0 text-dark">{!! nl2br(e($laboratorium->catatan_lab)) !!}</p>
                                    </div>
                                </div>
                                @endif

                                <div class="mb-4">
                                    <h6 class="fw-bold text-dark"><i class="fas fa-clock me-2 text-muted"></i> Informasi Waktu:</h6>
                                    <div class="alert alert-light border-start border-3 border-secondary">
                                        <p class="mb-1 text-dark"><strong>Waktu Pemeriksaan:</strong></p>
                                        <p class="mb-1 text-muted">{{ $laboratorium->waktu_selesai_periksa ? $laboratorium->waktu_selesai_periksa->format('d F Y - H:i:s') : $laboratorium->updated_at->format('d F Y - H:i:s') }}</p>
                                        
                                        @if($laboratorium->waktu_mulai_periksa && $laboratorium->waktu_selesai_periksa)
                                        <p class="mb-0 text-dark"><strong>Durasi:</strong></p>
                                        <p class="mb-0 text-muted">{{ $laboratorium->waktu_mulai_periksa->diffForHumans($laboratorium->waktu_selesai_periksa, true) }}</p>
                                        @endif
                                    </div>
                                </div>
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
                            <i class="fas fa-tasks me-2" style="color: #02b723;"></i> Status Laboratorium
                        </h6>
                    </div>
                    <div class="card-body bg-white text-center">
                        @if($laboratorium->status_pemeriksaan == 'menunggu' && !$laboratorium->no_antrian)
                            <div class="mb-3">
                                <i class="fas fa-clock fa-3x text-muted mb-2"></i>
                                <br>
                                <span class="badge bg-light text-dark border fs-6">Menunggu Antrian</span>
                            </div>
                        @elseif($laboratorium->status_pemeriksaan == 'menunggu' && $laboratorium->no_antrian)
                            <div class="mb-3">
                                <i class="fas fa-list-ol fa-3x text-dark mb-2"></i>
                                <br>
                                <span class="badge bg-dark fs-6">Siap Diperiksa</span>
                            </div>
                            <div class="alert alert-light border">
                                <h5 class="text-dark"><i class="fas fa-list-ol me-2"></i> No. Antrian: {{ $laboratorium->no_antrian }}</h5>
                            </div>
                        @elseif($laboratorium->status_pemeriksaan == 'sedang_diperiksa')
                            <div class="mb-3">
                                <i class="fas fa-flask fa-3x text-secondary mb-2"></i>
                                <br>
                                <span class="badge bg-secondary fs-6">{{ $laboratorium->status_label }}</span>
                            </div>
                            <div class="alert alert-light border">
                                <h6 class="text-dark"><i class="fas fa-list-ol me-2"></i> No. Antrian: {{ $laboratorium->no_antrian }}</h6>
                            </div>
                        @else
                            <div class="mb-3">
                                <i class="fas fa-check-circle fa-3x mb-2" style="color: #02b723;"></i>
                                <br>
                                <span class="badge text-white fs-6" style="background-color: #02b723;">{{ $laboratorium->status_label }}</span>
                            </div>
                            @if($laboratorium->no_antrian)
                            <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                <h6 class="text-dark"><i class="fas fa-list-ol me-2"></i> No. Antrian: {{ $laboratorium->no_antrian }}</h6>
                            </div>
                            @endif
                        @endif

                        <div class="mt-3 text-start">
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-calendar me-2"></i> Tanggal Transfer:</span><br>
                            <span class="text-muted ms-4">{{ $laboratorium->created_at ? $laboratorium->created_at->format('d F Y') : '-' }}</span></p>
                            
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-clock me-2"></i> Jam Transfer:</span><br>
                            <span class="text-muted ms-4">{{ $laboratorium->created_at->format('H:i:s') }}</span></p>

                            @if($laboratorium->status_pemeriksaan == 'selesai')
                            <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-check me-2"></i> Waktu Selesai:</span><br>
                            <span class="text-muted ms-4">{{ $laboratorium->updated_at->format('d F Y - H:i:s') }}</span></p>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-4">
                            @if($laboratorium->status_pemeriksaan == 'menunggu' && !$laboratorium->no_antrian)
                                <form method="POST" action="{{ route('admin.laboratorium.set-antrian', $laboratorium->id) }}" 
                                      onsubmit="return confirm('Set nomor antrian?')">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-dark w-100">
                                        <i class="fas fa-list-ol me-2"></i> Set No. Antrian
                                    </button>
                                </form>
                            @elseif($laboratorium->status_pemeriksaan == 'menunggu' && $laboratorium->no_antrian)
                                <form method="POST" action="{{ route('admin.laboratorium.update-status', $laboratorium->id) }}" 
                                      onsubmit="return confirm('Mulai pemeriksaan laboratorium?')">
                                    @csrf
                                    <input type="hidden" name="status" value="sedang_diperiksa">
                                    <button type="submit" class="btn btn-dark w-100">
                                        <i class="fas fa-play me-2"></i> Mulai Pemeriksaan
                                    </button>
                                </form>
                            @elseif($laboratorium->status_pemeriksaan == 'sedang_diperiksa')
                                <button type="button" class="btn text-white w-100" style="background-color: #02b723;"
                                        onclick="openHasilModal({{ $laboratorium->id }})">
                                    <i class="fas fa-check me-2"></i> Selesaikan Pemeriksaan
                                </button>
                            @else
                                <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                                    <i class="fas fa-check-circle me-2" style="color: #02b723;"></i> Pemeriksaan laboratorium telah selesai
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informasi Asal Transfer -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">
                            <i class="fas fa-exchange-alt me-2 text-secondary"></i> Informasi Transfer
                        </h6>
                    </div>
                    <div class="card-body bg-white">
                        <div class="text-center mb-3">
                            <i class="fas fa-stethoscope fa-2x text-secondary"></i>
                        </div>
                        
                        <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-hospital me-2"></i> Asal Transfer:</span><br>
                        <span class="text-muted">{{ $laboratorium->asal_transfer ?? 'Pendaftaran' }}</span></p>
                        
                        <p class="mb-2"><span class="fw-bold text-dark"><i class="fas fa-calendar me-2"></i> Tanggal Transfer:</span><br>
                        <span class="text-muted">{{ $laboratorium->created_at ? $laboratorium->created_at->format('d F Y') : '-' }}</span></p>

                        <p class="mb-3"><span class="fw-bold text-dark"><i class="fas fa-clock me-2"></i> Jam Transfer:</span><br>
                        <span class="text-muted">{{ $laboratorium->created_at->format('H:i:s') }}</span></p>

                        @if($laboratorium->pemeriksaan_umum_id)
                        <a href="{{ route('admin.pemeriksaanumum.detail', $laboratorium->pemeriksaan_umum_id) }}" 
                           class="btn btn-outline-secondary w-100">
                            <i class="fas fa-eye me-2"></i> Lihat Pemeriksaan Asal
                        </a>
                        @endif
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
                                <p class="text-muted small">{{ $laboratorium->jenis_kelamin_label }}, {{ $laboratorium->tgl_lahir->age }} thn</p>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <i class="fas fa-flask fa-2x text-dark"></i>
                                </div>
                                <h6 class="text-dark">Lab</h6>
                                <p class="text-muted small">{{ now()->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hasil Laboratorium -->
    <div class="modal fade" id="hasilModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header text-white" style="background-color: #02b723;">
                    <h5 class="modal-title">
                        <i class="fas fa-flask me-2"></i> Input Hasil Laboratorium
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="hasilForm" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="selesai">
                    <div class="modal-body bg-white">
                        <div class="alert alert-light border-start border-3" style="border-color: #02b723 !important;">
                            <i class="fas fa-info-circle me-2" style="color: #02b723;"></i> 
                            Lengkapi hasil laboratorium untuk pasien <strong class="text-dark">{{ $laboratorium->nama }}</strong>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-vial me-2" style="color: #02b723;"></i> Hasil Laboratorium *
                            </label>
                            <textarea name="hasil_lab" class="form-control border" rows="5" required 
                                    placeholder="Contoh:&#10;- Hemoglobin: 12.5 g/dL (Normal: 12-16 g/dL)&#10;- Leukosit: 8.500/μL (Normal: 4.000-11.000/μL)&#10;- Trombosit: 350.000/μL (Normal: 150.000-450.000/μL)&#10;- Glukosa sewaktu: 110 mg/dL (Normal: <140 mg/dL)"></textarea>
                            <small class="text-muted">Tulis hasil pemeriksaan laboratorium lengkap dengan nilai normal</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-user-md text-secondary me-2"></i> Dokter Pemeriksa *
                            </label>
                            <input type="text" name="dokter_pemeriksa" class="form-control border" required
                                   placeholder="Contoh: Dr. Ahmad Fauzi, Sp.PK">
                            <small class="text-muted">Nama dokter yang melakukan pemeriksaan laboratorium</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-clipboard-list text-dark me-2"></i> Catatan Tambahan
                            </label>
                            <textarea name="catatan_lab" class="form-control border" rows="3" 
                                    placeholder="Contoh:&#10;- Sampel darah diambil dalam kondisi puasa&#10;- Hasil perlu dikonsultasikan dengan dokter&#10;- Disarankan pemeriksaan ulang dalam 1 bulan"></textarea>
                            <small class="text-muted">Catatan atau interpretasi tambahan (opsional)</small>
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
        function openHasilModal(laboratoriumId) {
            const modal = new bootstrap.Modal(document.getElementById('hasilModal'));
            const form = document.getElementById('hasilForm');
            form.action = `/admin/laboratorium/${laboratoriumId}/update-status`;
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

        // Form validation enhancement untuk hasil laboratorium
        document.getElementById('hasilForm').addEventListener('submit', function(e) {
            const hasilLab = document.querySelector('textarea[name="hasil_lab"]');
            const dokterPemeriksa = document.querySelector('input[name="dokter_pemeriksa"]');
            
            // Validasi hasil laboratorium
            if (!hasilLab.value.trim()) {
                e.preventDefault();
                hasilLab.focus();
                hasilLab.style.borderColor = '#dc3545';
                
                // Show error message
                let errorMsg = hasilLab.parentNode.querySelector('.error-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('small');
                    errorMsg.className = 'error-message text-danger';
                    errorMsg.textContent = 'Hasil laboratorium wajib diisi';
                    hasilLab.parentNode.appendChild(errorMsg);
                }
                
                setTimeout(() => {
                    hasilLab.style.borderColor = '';
                    if (errorMsg) errorMsg.remove();
                }, 3000);
                return;
            }

            // Validasi dokter pemeriksa
            if (!dokterPemeriksa.value.trim()) {
                e.preventDefault();
                dokterPemeriksa.focus();
                dokterPemeriksa.style.borderColor = '#dc3545';
                
                // Show error message
                let errorMsg = dokterPemeriksa.parentNode.querySelector('.error-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('small');
                    errorMsg.className = 'error-message text-danger';
                    errorMsg.textContent = 'Dokter pemeriksa wajib diisi';
                    dokterPemeriksa.parentNode.appendChild(errorMsg);
                }
                
                setTimeout(() => {
                    dokterPemeriksa.style.borderColor = '';
                    if (errorMsg) errorMsg.remove();
                }, 3000);
                return;
            }
        });

        // Auto-save draft functionality untuk hasil laboratorium
        let autoSaveTimer;
        document.querySelectorAll('#hasilModal textarea, #hasilModal input').forEach(function(field) {
            field.addEventListener('input', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(() => {
                    // Save to sessionStorage as draft
                    const formData = {};
                    document.querySelectorAll('#hasilModal textarea, #hasilModal input[type="text"]').forEach(function(field) {
                        formData[field.name] = field.value;
                    });
                    sessionStorage.setItem('hasilLabDraft', JSON.stringify(formData));
                }, 1000);
            });
        });

        // Load draft on modal open
        document.getElementById('hasilModal').addEventListener('shown.bs.modal', function() {
            const draft = sessionStorage.getItem('hasilLabDraft');
            if (draft) {
                const formData = JSON.parse(draft);
                Object.keys(formData).forEach(function(key) {
                    const field = document.querySelector(`textarea[name="${key}"], input[name="${key}"]`);
                    if (field && !field.value) {
                        field.value = formData[key];
                    }
                });
            }
        });

        // Clear draft on successful submit
        document.getElementById('hasilForm').addEventListener('submit', function() {
            sessionStorage.removeItem('hasilLabDraft');
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

        // Real-time character counter for textarea
        document.querySelectorAll('textarea').forEach(function(textarea) {
            const maxLength = textarea.getAttribute('maxlength');
            if (maxLength) {
                const counter = document.createElement('small');
                counter.className = 'text-muted d-block mt-1';
                counter.style.textAlign = 'right';
                textarea.parentNode.appendChild(counter);

                function updateCounter() {
                    const remaining = maxLength - textarea.value.length;
                    counter.textContent = `${textarea.value.length}/${maxLength} karakter`;
                    counter.style.color = remaining < 50 ? '#dc3545' : '#6c757d';
                }

                textarea.addEventListener('input', updateCounter);
                updateCounter();
            }
        });

        // Status update dengan konfirmasi khusus
        function confirmStatusUpdate(action, status) {
            let message = '';
            switch(status) {
                case 'sedang_diperiksa':
                    message = 'Apakah Anda yakin ingin memulai pemeriksaan laboratorium?';
                    break;
                case 'selesai':
                    message = 'Apakah Anda yakin hasil laboratorium sudah lengkap dan benar?';
                    break;
                default:
                    message = 'Apakah Anda yakin ingin melakukan tindakan ini?';
            }
            
            return confirm(message);
        }

        // Format nomor telefon otomatis
        document.querySelectorAll('input[type="tel"]').forEach(function(input) {
            input.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.startsWith('62')) {
                    value = '0' + value.substring(2);
                }
                this.value = value;
            });
        });

        // Highlight search terms (jika ada parameter search)
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const searchTerm = urlParams.get('search');
            
            if (searchTerm) {
                const elements = document.querySelectorAll('td, p, span');
                elements.forEach(function(element) {
                    if (element.textContent.toLowerCase().includes(searchTerm.toLowerCase())) {
                        element.innerHTML = element.innerHTML.replace(
                            new RegExp(searchTerm, 'gi'),
                            '<mark>$&</mark>'
                        );
                    }
                });
            }
        });

        // Progress bar untuk proses yang membutuhkan waktu
        function showProgressBar() {
            const progressContainer = document.createElement('div');
            progressContainer.className = 'progress mt-3';
            progressContainer.style.height = '4px';
            
            const progressBar = document.createElement('div');
            progressBar.className = 'progress-bar';
            progressBar.style.width = '0%';
            progressBar.style.backgroundColor = '#02b723';
            
            progressContainer.appendChild(progressBar);
            
            // Simulasi progress
            let width = 0;
            const interval = setInterval(function() {
                width += Math.random() * 10;
                if (width >= 100) {
                    width = 100;
                    clearInterval(interval);
                    setTimeout(() => {
                        progressContainer.remove();
                    }, 500);
                }
                progressBar.style.width = width + '%';
            }, 100);
            
            return progressContainer;
        }

        // Auto-refresh status (opsional, untuk real-time updates)
        function enableAutoRefresh(intervalMinutes = 5) {
            setInterval(function() {
                // Hanya refresh jika halaman masih aktif/visible
                if (!document.hidden) {
                    const currentUrl = window.location.href;
                    fetch(currentUrl, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        // Update hanya bagian status jika berbeda
                        const parser = new DOMParser();
                        const newDoc = parser.parseFromString(html, 'text/html');
                        const newStatus = newDoc.querySelector('.badge').textContent;
                        const currentStatus = document.querySelector('.badge').textContent;
                        
                        if (newStatus !== currentStatus) {
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.log('Auto-refresh error:', error);
                    });
                }
            }, intervalMinutes * 60 * 1000);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + P untuk print
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
            
            // Escape untuk close modal
            if (e.key === 'Escape') {
                const openModal = document.querySelector('.modal.show');
                if (openModal) {
                    bootstrap.Modal.getInstance(openModal).hide();
                }
            }
        });
    </script>
</x-admin-layout>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran - Klinik</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0, 188, 132, 0.1);
            border: none;
            border-radius: 15px;
            background: white;
        }
        .card-header {
            background: #00bc84;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 2rem;
            text-align: center;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
        }
        .btn-outline-light {
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border-color: #00bc84;
            color: #00bc84;
            transition: all 0.3s ease;
        }
        .btn-outline-light:hover {
            background: #00bc84;
            border-color: #00bc84;
            color: white;
            transform: translateY(-1px);
        }
        .btn-primary {
            background: #00bc84;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #00a374;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(0, 188, 132, 0.3);
        }
        .status-badge {
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
        }
        .status-menunggu {
            background: #ffecd2;
            color: #8b4513;
            border: 2px solid #fcb69f;
        }
        .status-dikonfirmasi {
            background: #d4edda;
            color: #155724;
            border: 2px solid #00bc84;
        }
        .status-ditolak {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #dc3545;
        }
        .info-row {
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        .info-value {
            color: #212529;
        }
        .text-primary {
            color: #00bc84 !important;
        }
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1rem;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0.5rem;
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #00bc84;
        }
        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 0.75rem;
            top: 1rem;
            width: 2px;
            height: calc(100% + 1rem);
            background-color: #e9ecef;
        }
        .alert-info {
            background-color: #e8f4f8;
            border-color: #00bc84;
            color: #0c5460;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #00bc84;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('logo.png') }}" alt="Logo Klinik" class="logo">
                        <h3 class="mb-0">
                            <i class="fas fa-clipboard-check me-2"></i>
                            Status Pendaftaran
                        </h3>
                        <p class="mb-0 mt-2">Detail informasi pendaftaran Anda</p>
                    </div>
                    <div class="card-body p-4">
                        <!-- Status Badge -->
                        <div class="text-center mb-4">
                            @if($pendaftaran->status === 'menunggu')
                            <span class="status-badge status-menunggu">
                                <i class="fas fa-clock me-2"></i>
                                Menunggu Konfirmasi
                            </span>
                            @elseif($pendaftaran->status === 'dikonfirmasi')
                            <span class="status-badge status-dikonfirmasi">
                                <i class="fas fa-check-circle me-2"></i>
                                Dikonfirmasi
                            </span>
                            @elseif($pendaftaran->status === 'ditolak')
                            <span class="status-badge status-ditolak">
                                <i class="fas fa-times-circle me-2"></i>
                                Ditolak
                            </span>
                            @endif
                        </div>

                        <!-- Data Pendaftaran -->
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-user me-2"></i>
                                    Data Pribadi
                                </h5>
                                
                                <div class="info-row">
                                    <div class="info-label">NIK KTP</div>
                                    <div class="info-value">{{ $pendaftaran->nik }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">Nama Lengkap</div>
                                    <div class="info-value">{{ $pendaftaran->nama }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">Jenis Kelamin</div>
                                    <div class="info-value">{{ $pendaftaran->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">Tanggal Lahir</div>
                                    <div class="info-value">{{ \Carbon\Carbon::parse($pendaftaran->tgl_lahir)->format('d F Y') }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">No. HP</div>
                                    <div class="info-value">{{ $pendaftaran->no_hp }}</div>
                                </div>

                                @if($pendaftaran->no_bpjs)
                                <div class="info-row">
                                    <div class="info-label">No. BPJS</div>
                                    <div class="info-value">{{ $pendaftaran->no_bpjs }}</div>
                                </div>
                                @endif

                                @if($pendaftaran->no_rekam_medis)
                                <div class="info-row">
                                    <div class="info-label">No. Rekam Medis</div>
                                    <div class="info-value"><strong>{{ $pendaftaran->no_rekam_medis }}</strong></div>
                                </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-stethoscope me-2"></i>
                                    Detail Layanan
                                </h5>
                                
                                <div class="info-row">
                                    <div class="info-label">Jenis Layanan</div>
                                    <div class="info-value">
                                        @if($pendaftaran->keluhan === 'pemeriksaan_umum')
                                            Pemeriksaan Umum
                                        @elseif($pendaftaran->keluhan === 'lab')
                                            Laboratorium
                                        @elseif($pendaftaran->keluhan === 'radiologi')
                                            Radiologi
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">Tanggal Kunjungan</div>
                                    <div class="info-value">{{ \Carbon\Carbon::parse($pendaftaran->tgl_pendaftaran)->format('d F Y') }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">Waktu Pendaftaran</div>
                                    <div class="info-value">{{ $pendaftaran->waktu_submit_indonesia }}</div>
                                </div>

                                @if($pendaftaran->catatan)
                                <div class="info-row">
                                    <div class="info-label">Catatan</div>
                                    <div class="info-value">{{ $pendaftaran->catatan }}</div>
                                </div>
                                @endif

                                <h5 class="text-primary mb-3 mt-4">
                                    <i class="fas fa-phone-alt me-2"></i>
                                    Kontak Darurat
                                </h5>
                                
                                <div class="info-row">
                                    <div class="info-label">No. HP</div>
                                    <div class="info-value">{{ $pendaftaran->kontak_darurat }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">Hubungan</div>
                                    <div class="info-value">{{ ucfirst($pendaftaran->hubungan_kontak) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Status -->
                        <div class="mt-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-history me-2"></i>
                                Riwayat Status
                            </h5>
                            
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Pendaftaran Diterima</strong>
                                        <div class="text-muted small">{{ $pendaftaran->waktu_submit_indonesia }}</div>
                                    </div>
                                    <i class="fas fa-check text-success"></i>
                                </div>
                            </div>
                            
                            @if($pendaftaran->status === 'dikonfirmasi')
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Pendaftaran Dikonfirmasi</strong>
                                        <div class="text-muted small">{{ $pendaftaran->updated_at->format('d F Y H:i') }} WIB</div>
                                    </div>
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            </div>
                            @elseif($pendaftaran->status === 'ditolak')
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Pendaftaran Ditolak</strong>
                                        <div class="text-muted small">{{ $pendaftaran->updated_at->format('d F Y H:i') }} WIB</div>
                                    </div>
                                    <i class="fas fa-times-circle text-danger"></i>
                                </div>
                            </div>
                            @else
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Menunggu Konfirmasi Admin</strong>
                                        <div class="text-muted small">Dalam proses review</div>
                                    </div>
                                    <i class="fas fa-clock text-warning"></i>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Informasi Tambahan -->
                        @if($pendaftaran->status === 'menunggu')
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Informasi:</strong> Pendaftaran Anda sedang dalam proses review oleh admin. Anda akan dihubungi melalui nomor HP yang terdaftar untuk konfirmasi lebih lanjut.
                        </div>
                        @elseif($pendaftaran->status === 'dikonfirmasi')
                        <div class="alert alert-success mt-4">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Selamat!</strong> Pendaftaran Anda telah dikonfirmasi. Silakan datang ke klinik pada tanggal yang telah ditentukan dengan membawa KTP dan kartu BPJS (jika ada).
                        </div>
                        @elseif($pendaftaran->status === 'ditolak')
                        <div class="alert alert-danger mt-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Maaf,</strong> Pendaftaran Anda tidak dapat diproses. Silakan hubungi admin klinik untuk informasi lebih lanjut atau daftar ulang dengan data yang benar.
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <a href="{{ route('pendaftaran.check-status') }}" class="btn btn-primary me-3">
                        <i class="fas fa-search me-2"></i>
                        Cek Status Lagi
                    </a>
                    <a href="{{ route('pendaftaran.create') }}" class="btn btn-outline-light me-3">
                        <i class="fas fa-plus me-2"></i>
                        Daftar Baru
                    </a>
                    <a href="/" class="btn btn-outline-light">
                        <i class="fas fa-home me-2"></i>
                        Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto refresh untuk status menunggu
        @if($pendaftaran->status === 'menunggu')
        setTimeout(function() {
            if (confirm('Status pendaftaran masih menunggu. Apakah Anda ingin refresh halaman untuk melihat update terbaru?')) {
                window.location.reload();
            }
        }, 60000); // 1 menit
        @endif
    </script>
</body>
</html>
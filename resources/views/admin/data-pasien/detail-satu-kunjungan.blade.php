<x-admin-layout title="Riwayat Kunjungan Pasien">
    <x-slot name="header">
 
    </x-slot>

    <div class="py-12">
               <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kunjungan - {{ $kunjungan->nama }}
        </h2>
         <div>
                <a href="{{ route('admin.data-pasien.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-primary btn-sm">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Header Kunjungan -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Kunjungan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Tanggal Kunjungan:</strong></td>
                                            <td>{{ $kunjungan->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Waktu Submit:</strong></td>
                                            <td>{{ $kunjungan->waktu_submit_formatted }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Keluhan:</strong></td>
                                      
                                            <td>
                                                <span class="badge badge-info">{{ $kunjungan->keluhan_label }}</span>
                                            </td>
                                  
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Status:</strong></td>
                                            <td>
                                                @if($kunjungan->status_lengkap['status'] == 'selesai')
                                                    <span class="badge badge-success">{{ $kunjungan->status_lengkap['keterangan'] }}</span>
                                                @elseif($kunjungan->status_lengkap['status'] == 'sedang_diperiksa')
                                                    <span class="badge badge-warning">{{ $kunjungan->status_lengkap['keterangan'] }}</span>
                                                @elseif($kunjungan->status_lengkap['status'] == 'menunggu')
                                                    <span class="badge badge-secondary">{{ $kunjungan->status_lengkap['keterangan'] }}</span>
                                                @else
                                                    <span class="badge badge-primary">{{ $kunjungan->status_lengkap['keterangan'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Rekam Medis:</strong></td>
                                            <td>{{ $kunjungan->no_rekam_medis ?? 'Belum dikonfirmasi' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Catatan:</strong></td>
                                            <td>{{ $kunjungan->catatan ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Identitas Pasien -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Identitas Pasien</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                         <tr>
    <strong>Jenis Pasien: 
        @if($kunjungan->is_lpk_sentosa)
            <span class="badge bg-info text-white" style="font-size: 0.75rem;">
                <i class="fas fa-graduation-cap me-1"></i>LPK Sentosa
            </span>
        @else
            <span class="badge bg-secondary text-white" style="font-size: 0.75rem;">
                <i class="fas fa-user me-1"></i>Umum
            </span>
        @endif
    </strong>
</tr>
                                        <tr>
                                            <td width="30%"><strong>Nama:</strong></td>
                                            <td>{{ $kunjungan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIK:</strong></td>
                                            <td>{{ $kunjungan->nik }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin:</strong></td>
                                            <td>{{ $kunjungan->jenis_kelamin_label }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Lahir:</strong></td>
                                            <td>{{ $kunjungan->tgl_lahir->format('d/m/Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="30%"><strong>No. HP:</strong></td>
                                            <td>{{ $kunjungan->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. BPJS:</strong></td>
                                            <td>{{ $kunjungan->no_bpjs ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat:</strong></td>
                                            <td>{{ $kunjungan->alamat_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kontak Darurat:</strong></td>
                                            <td>{{ $kunjungan->kontak_darurat }} ({{ $kunjungan->hubungan_kontak_label }})</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Proses -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Timeline Proses</h5>
                        </div>
                        <div class="card-body">
                            @if(count($kunjungan->timeline) > 0)
                                <div class="timeline">
                                    @foreach($kunjungan->timeline as $index => $item)
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-primary"></div>
                                            <div class="timeline-content">
                                                <h6 class="timeline-title">{{ $item['step'] }}</h6>
                                                <p class="timeline-description">{{ $item['keterangan'] }}</p>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($item['waktu'])->format('d/m/Y H:i:s') }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Belum ada timeline proses.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Hasil Pemeriksaan -->
                    @if(count($kunjungan->hasil_pemeriksaan) > 0)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Hasil Pemeriksaan</h5>
                            </div>
                            <div class="card-body">
                                @if($kunjungan->keluhan == 'pemeriksaan_umum')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
                                                @if(!empty($kunjungan->hasil_pemeriksaan['diagnosis']))
                                                    <tr>
                                                        <td width="20%"><strong>Diagnosis:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['diagnosis'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['obat']))
                                                    <tr>
                                                        <td><strong>Obat Diberikan:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['obat'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['anjuran']))
                                                    <tr>
                                                        <td><strong>Anjuran/Instruksi:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['anjuran'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['rujukan']))
                                                    <tr>
                                                        <td><strong>Rujukan:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['rujukan'] }}</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                @elseif($kunjungan->keluhan == 'lab')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
                                                @if(!empty($kunjungan->hasil_pemeriksaan['hasil_lab']))
                                                    <tr>
                                                        <td width="20%"><strong>Hasil Lab:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['hasil_lab'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['dokter_pemeriksa']))
                                                    <tr>
                                                        <td><strong>Dokter Pemeriksa:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['dokter_pemeriksa'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['catatan']))
                                                    <tr>
                                                        <td><strong>Catatan:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['catatan'] }}</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                @elseif($kunjungan->keluhan == 'radiologi')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
                                                @if(!empty($kunjungan->hasil_pemeriksaan['jenis_radiologi']))
                                                    <tr>
                                                        <td width="20%"><strong>Jenis Radiologi:</strong></td>
                                                        <td>{{ ucfirst($kunjungan->hasil_pemeriksaan['jenis_radiologi']) }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['hasil_radiologi']))
                                                    <tr>
                                                        <td><strong>Hasil Radiologi:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['hasil_radiologi'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['dokter_radiologi']))
                                                    <tr>
                                                        <td><strong>Dokter Radiologi:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['dokter_radiologi'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['teknisi_radiologi']))
                                                    <tr>
                                                        <td><strong>Teknisi Radiologi:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['teknisi_radiologi'] }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty($kunjungan->hasil_pemeriksaan['catatan']))
                                                    <tr>
                                                        <td><strong>Catatan:</strong></td>
                                                        <td>{{ $kunjungan->hasil_pemeriksaan['catatan'] }}</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Aksi -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Aksi</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.data-pasien.detail-by-nik', $kunjungan->nik) }}" class="btn btn-primary btn-sm btn-block mb-2">
                                <i class="fas fa-user"></i> Lihat Semua Riwayat
                            </a>
                            <a href="{{ route('admin.data-pasien.index') }}" class="btn btn-secondary btn-sm btn-block">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                    <!-- Riwayat Kunjungan Lain -->
                    @if($riwayatLain->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Riwayat Kunjungan Lain</h6>
                            </div>
                            <div class="card-body">
                                @foreach($riwayatLain as $riwayat)
                                    <div class="border-bottom pb-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-muted">{{ $riwayat->tgl_pendaftaran->format('d/m/Y') }}</small>
                                                <br>
                                                <span class="badge badge-info badge-sm">{{ $riwayat->keluhan_label }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ route('admin.data-pasien.detail-kunjungan', $riwayat->id) }}" 
                                                   class="btn btn-outline-primary btn-xs">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Timeline -->
    <style>
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
            background: #dee2e6;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        
        .timeline-marker {
            position: absolute;
            left: -23px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #dee2e6;
        }
        
        .timeline-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 3px solid #007bff;
        }
        
        .timeline-title {
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
        }
        
        .timeline-description {
            margin-bottom: 5px;
            color: #6c757d;
        }
        
        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
    </style>
</x-admin-layout>
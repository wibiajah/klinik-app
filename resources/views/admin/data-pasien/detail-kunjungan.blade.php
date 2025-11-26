<x-admin-layout title="Detail Pasien">

        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-weight-semibold text-xl text-gray-800 leading-tight">
                Detail Lengkap Pasien - {{ $identitasPasien->nama }}
            </h2>
            <div>
                <a href="{{ route('admin.data-pasien.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-primary btn-sm">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        </div>
  
    <div class="container-fluid">
        <!-- Identitas Pasien -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Identitas Pasien</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                 
                                    <tr>
                                        <td width="150"><strong>Nama Lengkap</strong></td>
                                        <td>: {{ $identitasPasien->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIK</strong></td>
                                        <td>: {{ $identitasPasien->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. Rekam Medis</strong></td>
                                        <td>: {{ $identitasPasien->no_rekam_medis }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin</strong></td>
                                        <td>: {{ $identitasPasien->jenis_kelamin ?? 'Tidak tercatat' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Lahir</strong></td>
                                        <td>: {{ $identitasPasien->tgl_lahir ? \Carbon\Carbon::parse($identitasPasien->tgl_lahir)->format('d/m/Y') : 'Tidak tercatat' }}</td>
                                    </tr>
                                        <tr>
    <strong>Jenis Pasien: 
        @if($identitasPasien->is_lpk_sentosa)
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
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><strong>No. Telepon</strong></td>
                                        <td>: {{ $identitasPasien->no_hp ?? 'Tidak tercatat' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>: {{ $identitasPasien->email ?? 'Tidak tercatat' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat</strong></td>
                                        <td>: {{ $identitasPasien->alamat_lengkap ?? 'Tidak tercatat' }}</td>
                                    </tr>
                                  @if($identitasPasien->is_lpk_sentosa && $identitasPasien->foto_bukti)
<tr>
    <td class="text-dark fw-medium"><strong>Foto Bukti</strong></td>
    <td class="text-dark">
        <div class="mt-2">
            <img src="{{ asset('storage/public/foto_bukti/' . basename ($identitasPasien->foto_bukti)) }}" 
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Kunjungan -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik Kunjungan Pasien</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-2">
                                <div class="card border border-primary">
                                    <div class="card-body">
                                        <h3 class="text-primary">{{ $statistikPasien['total_kunjungan'] }}</h3>
                                        <small>Total Kunjungan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card border border-success">
                                    <div class="card-body">
                                        <h3 class="text-success">{{ $statistikPasien['pemeriksaan_umum'] }}</h3>
                                        <small>Pemeriksaan Umum</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card border border-warning">
                                    <div class="card-body">
                                        <h3 class="text-warning">{{ $statistikPasien['laboratorium'] }}</h3>
                                        <small>Laboratorium</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card border border-danger">
                                    <div class="card-body">
                                        <h3 class="text-danger">{{ $statistikPasien['radiologi'] }}</h3>
                                        <small>Radiologi</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card border border-secondary">
                                    <div class="card-body">
                                        <small class="text-muted">Kunjungan Pertama</small>
                                        <p class="mb-0">{{ $statistikPasien['kunjungan_pertama'] ? \Carbon\Carbon::parse($statistikPasien['kunjungan_pertama'])->format('d/m/Y') : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card border border-dark">
                                    <div class="card-body">
                                        <small class="text-muted">Kunjungan Terakhir</small>
                                        <p class="mb-0">{{ $statistikPasien['kunjungan_terakhir'] ? \Carbon\Carbon::parse($statistikPasien['kunjungan_terakhir'])->format('d/m/Y') : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Kunjungan Lengkap -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-history"></i> Riwayat Kunjungan Lengkap</h5>
                    </div>
                    <div class="card-body">
                        @foreach($riwayatKunjungan as $index => $kunjungan)
                        <div class="card border {{ $loop->first ? 'border-primary' : 'border-light' }} mb-4">
                            <div class="card-header {{ $loop->first ? 'bg-primary text-white' : 'bg-light' }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <i class="fas fa-calendar-alt"></i> 
                                        Kunjungan #{{ $riwayatKunjungan->count() - $index }} - 
                                        {{ \Carbon\Carbon::parse($kunjungan->tgl_pendaftaran)->format('d F Y') }}
                                        @if($loop->first)
                                        <span class="badge badge-warning ml-2">Kunjungan Terbaru</span>
                                        @endif
                                    </h6>
                                    <div>
                                        <span class="badge badge-{{ 
                                            $kunjungan->status == 'dikonfirmasi' ? 'success' : 
                                            ($kunjungan->status == 'menunggu' ? 'warning' : 'danger') 
                                        }}">
                                            {{ ucfirst($kunjungan->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Informasi Dasar Kunjungan -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h6 class="text-primary">Informasi Pendaftaran</h6>
                                        <table class="table table-sm table-borderless">
                                           <tr>
    <td width="120"><strong>Tanggal Daftar</strong></td>
    <td>: 
        @if(isset($kunjungan->timeline) && count($kunjungan->timeline) > 0)
            @php
                $pendaftaranTimeline = collect($kunjungan->timeline)->firstWhere('step', 'Pendaftaran');
            @endphp
            @if($pendaftaranTimeline)
                {{ \Carbon\Carbon::parse($pendaftaranTimeline['waktu'])->format('d/m/Y H:i:s') }}
            @else
                {{ \Carbon\Carbon::parse($kunjungan->tgl_pendaftaran)->format('d/m/Y H:i:s') }}
            @endif
        @else
            {{ \Carbon\Carbon::parse($kunjungan->tgl_pendaftaran)->format('d/m/Y H:i:s') }}
        @endif
    </td>
</tr>
                                            <tr>
                                                <td><strong>Keluhan Utama</strong></td>
                                                <td>: 
                                                    <span class="badge badge-{{ 
                                                        $kunjungan->keluhan == 'pemeriksaan_umum' ? 'success' : 
                                                        ($kunjungan->keluhan == 'lab' ? 'warning' : 'danger') 
                                                    }}">
                                                        {{ ucfirst(str_replace('_', ' ', $kunjungan->keluhan)) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status Kunjungan</strong></td>
                                                <td>: {{ $kunjungan->status_lengkap['keterangan'] ?? 'Tidak ada keterangan' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Waktu Submit</strong></td>
                                                <td>: {{ $kunjungan->created_at->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                            @if($kunjungan->status == 'dikonfirmasi')
                                            <tr>
                                                <td><strong>Waktu Konfirmasi</strong></td>
                                                <td>: {{ $kunjungan->updated_at->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-info">Status Transfer & Antrian</h6>
                                        <div class="alert alert-light">
                                            <div class="row">
                                                <div class="col-4">
                                                    <span class="badge badge-{{ $kunjungan->is_transferred_pemeriksaan_umum ? 'success' : 'secondary' }}">
                                                        {{ $kunjungan->is_transferred_pemeriksaan_umum ? 'Sudah Transfer' : 'Belum Transfer' }}
                                                    </span>
                                                    <br><small>Pemeriksaan Umum</small>
                                                </div>
                                                <div class="col-4">
                                                    <span class="badge badge-{{ $kunjungan->is_transferred_laboratorium ? 'success' : 'secondary' }}">
                                                        {{ $kunjungan->is_transferred_laboratorium ? 'Sudah Transfer' : 'Belum Transfer' }}
                                                    </span>
                                                    <br><small>Laboratorium</small>
                                                </div>
                                                <div class="col-4">
                                                    <span class="badge badge-{{ $kunjungan->is_transferred_radiologi ? 'success' : 'secondary' }}">
                                                        {{ $kunjungan->is_transferred_radiologi ? 'Sudah Transfer' : 'Belum Transfer' }}
                                                    </span>
                                                    <br><small>Radiologi</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Proses -->
                                @if(isset($kunjungan->timeline) && count($kunjungan->timeline) > 0)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h6 class="text-success"><i class="fas fa-timeline"></i> Timeline Proses Lengkap</h6>
                                        <div class="timeline">
                                            @foreach($kunjungan->timeline as $timelineItem)
                                            <div class="timeline-item">
                                                <div class="timeline-marker bg-{{ 
                                                    $timelineItem['status'] == 'selesai' ? 'success' : 
                                                    ($timelineItem['status'] == 'proses' ? 'warning' : 'secondary') 
                                                }}"></div>
                                                <div class="timeline-content">
                                                    <h6 class="timeline-title">{{ $timelineItem['step'] }}</h6>
                                                    <p class="timeline-description">
                                                        <small class="text-muted">
                                                            {{ \Carbon\Carbon::parse($timelineItem['waktu'])->format('d/m/Y H:i:s') }}
                                                        </small><br>
                                                        {{ $timelineItem['keterangan'] }}
                                                    </p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Detail Pemeriksaan Berdasarkan Keluhan -->
                                @if($kunjungan->keluhan == 'pemeriksaan_umum' && $kunjungan->pemeriksaanUmum)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h6 class="text-success"><i class="fas fa-stethoscope"></i> Detail Pemeriksaan Umum</h6>
                                        <div class="card border-success">
                                            <div class="card-body">
                                           <div class="row">
    <div class="col-md-6">
        <table class="table table-sm">
            <tr>
                <td width="150"><strong>No. Antrian</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->no_antrian ?? 'Belum ditetapkan' }}</td>
            </tr>
            <tr>
                <td><strong>Status Pemeriksaan</strong></td>
                <td>: 
                    <span class="badge badge-{{ 
                        $kunjungan->pemeriksaanUmum->status_pemeriksaan == 'selesai' ? 'success' : 
                        ($kunjungan->pemeriksaanUmum->status_pemeriksaan == 'sedang_diperiksa' ? 'warning' : 'info') 
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $kunjungan->pemeriksaanUmum->status_pemeriksaan)) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>Tgl Transfer</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->tgl_transfer ? \Carbon\Carbon::parse($kunjungan->pemeriksaanUmum->tgl_transfer)->format('d/m/Y') : 'Belum ditransfer' }}</td>
            </tr>
            <tr>
                <td><strong>Waktu Konfirmasi</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->waktu_konfirmasi ? \Carbon\Carbon::parse($kunjungan->pemeriksaanUmum->waktu_konfirmasi)->format('d/m/Y H:i:s') : 'Belum dikonfirmasi' }}</td>
            </tr>
            <tr>
                <td><strong>Mulai Periksa</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->waktu_mulai_periksa ? \Carbon\Carbon::parse($kunjungan->pemeriksaanUmum->waktu_mulai_periksa)->format('d/m/Y H:i:s') : 'Belum dimulai' }}</td>
            </tr>
            <tr>
                <td><strong>Selesai Periksa</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->waktu_selesai_periksa ? \Carbon\Carbon::parse($kunjungan->pemeriksaanUmum->waktu_selesai_periksa)->format('d/m/Y H:i:s') : 'Belum selesai' }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <h6 class="text-primary">Detail Tracking Petugas</h6>
        <table class="table table-sm">
          

            <tr>
                <td width="150"><strong>Petugas Konfirmasi</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->konfirmasi_by ? (\App\Models\User::find($kunjungan->pemeriksaanUmum->konfirmasi_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>
            <tr>
                <td><strong>Petugas Mulai Periksa</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->mulai_periksa_by ? (\App\Models\User::find($kunjungan->pemeriksaanUmum->mulai_periksa_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>
            <tr>
                <td><strong>Petugas Selesai Periksa</strong></td>
                <td>: {{ $kunjungan->pemeriksaanUmum->selesai_periksa_by ? (\App\Models\User::find($kunjungan->pemeriksaanUmum->selesai_periksa_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h6 class="text-primary">Hasil Pemeriksaan</h6>
        @if($kunjungan->pemeriksaanUmum->status_pemeriksaan == 'selesai')
        <div class="card border-light">
            <div class="card-body">
                <p><strong>Diagnosis Sementara:</strong><br>
                {{ $kunjungan->pemeriksaanUmum->diagnosis_sementara ?? 'Tidak ada diagnosis' }}</p>
                
                <p><strong>Obat yang Diberikan:</strong><br>
                {{ $kunjungan->pemeriksaanUmum->obat_diberikan ?? 'Tidak ada obat' }}</p>
                
                <p><strong>Anjuran/Instruksi:</strong><br>
                {{ $kunjungan->pemeriksaanUmum->anjuran_instruksi ?? 'Tidak ada anjuran' }}</p>
                
                @if($kunjungan->pemeriksaanUmum->rujukan)
                <p><strong>Rujukan:</strong><br>
                <span class="badge badge-warning">{{ $kunjungan->pemeriksaanUmum->rujukan }}</span></p>
                @endif
            </div>
        </div>
        @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Pemeriksaan belum selesai
        </div>
        @endif
    </div>
</div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($kunjungan->keluhan == 'lab' && $kunjungan->laboratorium)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h6 class="text-warning"><i class="fas fa-flask"></i> Detail Pemeriksaan Laboratorium</h6>
                                        <div class="card border-warning">
                                            <div class="card-body">
                                                <div class="row">
    <div class="col-md-6">
        <table class="table table-sm">
            <tr>
                <td width="150"><strong>No. Antrian</strong></td>
                <td>: {{ $kunjungan->laboratorium->no_antrian ?? 'Belum ditetapkan' }}</td>
            </tr>
            <tr>
                <td><strong>Status Pemeriksaan</strong></td>
                <td>: 
                    <span class="badge badge-{{ 
                        $kunjungan->laboratorium->status_pemeriksaan == 'selesai' ? 'success' : 
                        ($kunjungan->laboratorium->status_pemeriksaan == 'sedang_diperiksa' ? 'warning' : 'info') 
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $kunjungan->laboratorium->status_pemeriksaan)) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>Tgl Pemeriksaan</strong></td>
                <td>: {{ $kunjungan->laboratorium->tgl_pemeriksaan ? \Carbon\Carbon::parse($kunjungan->laboratorium->tgl_pemeriksaan)->format('d/m/Y') : 'Belum diperiksa' }}</td>
            </tr>
            <tr>
                <td><strong>Dokter Pemeriksa</strong></td>
                <td>: {{ $kunjungan->laboratorium->dokter_pemeriksa ?? 'Belum ditentukan' }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <h6 class="text-primary">Detail Tracking Petugas</h6>
        <table class="table table-sm">
            <tr>
                <td width="150"><strong>Petugas Set Antrian</strong></td>
                <td>: {{ $kunjungan->laboratorium->set_antrian_by ? (\App\Models\User::find($kunjungan->laboratorium->set_antrian_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>
            
            <tr>
                <td><strong>Petugas Mulai Periksa</strong></td>
                <td>: {{ $kunjungan->laboratorium->mulai_periksa_by ? (\App\Models\User::find($kunjungan->laboratorium->mulai_periksa_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>
           
            <tr>
                <td><strong>Petugas Selesai Periksa</strong></td>
                <td>: {{ $kunjungan->laboratorium->selesai_periksa_by ? (\App\Models\User::find($kunjungan->laboratorium->selesai_periksa_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>
           
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h6 class="text-primary">Hasil Laboratorium</h6>
        @if($kunjungan->laboratorium->status_pemeriksaan == 'selesai')
        <div class="card border-light">
            <div class="card-body">
                <p><strong>Hasil Lab:</strong><br>
                {{ $kunjungan->laboratorium->hasil_lab ?? 'Tidak ada hasil' }}</p>
                
                <p><strong>Catatan Lab:</strong><br>
                {{ $kunjungan->laboratorium->catatan_lab ?? 'Tidak ada catatan' }}</p>
            </div>
        </div>
        @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Pemeriksaan laboratorium belum selesai
        </div>
        @endif
    </div>
</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($kunjungan->keluhan == 'radiologi' && $kunjungan->radiologi)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h6 class="text-danger"><i class="fas fa-x-ray"></i> Detail Pemeriksaan Radiologi</h6>
                                        <div class="card border-danger">
                                            <div class="card-body">
                                                <div class="row">
    <div class="col-md-6">
        <table class="table table-sm">
            <tr>
                <td width="150"><strong>No. Antrian</strong></td>
                <td>: {{ $kunjungan->radiologi->no_antrian ?? 'Belum ditetapkan' }}</td>
            </tr>
            <tr>
                <td><strong>Status Pemeriksaan</strong></td>
                <td>: 
                    <span class="badge badge-{{ 
                        $kunjungan->radiologi->status_pemeriksaan == 'selesai' ? 'success' : 
                        ($kunjungan->radiologi->status_pemeriksaan == 'sedang_diperiksa' ? 'warning' : 'info') 
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $kunjungan->radiologi->status_pemeriksaan)) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>Jenis Radiologi</strong></td>
                <td>: {{ ucfirst($kunjungan->radiologi->jenis_radiologi ?? 'Belum ditentukan') }}</td>
            </tr>
            <tr>
                <td><strong>Tgl Pemeriksaan</strong></td>
                <td>: {{ $kunjungan->radiologi->tgl_pemeriksaan ? \Carbon\Carbon::parse($kunjungan->radiologi->tgl_pemeriksaan)->format('d/m/Y') : 'Belum diperiksa' }}</td>
            </tr>
            <tr>
                <td><strong>Dokter Radiologi</strong></td>
                <td>: {{ $kunjungan->radiologi->dokter_radiologi ?? 'Belum ditentukan' }}</td>
            </tr>
            <tr>
                <td><strong>Teknisi Radiologi</strong></td>
                <td>: {{ $kunjungan->radiologi->teknisi_radiologi ?? 'Belum ditentukan' }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <h6 class="text-primary">Detail Tracking Petugas</h6>
        <table class="table table-sm">
          
            <tr>
                <td width="150"><strong>Petugas Set Antrian</strong></td>
                <td>: {{ $kunjungan->radiologi->antrian_by ? (\App\Models\User::find($kunjungan->radiologi->antrian_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>

            <tr>
                <td><strong>Petugas Mulai Periksa</strong></td>
                <td>: {{ $kunjungan->radiologi->mulai_periksa_by ? (\App\Models\User::find($kunjungan->radiologi->mulai_periksa_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>

            <tr>
                <td><strong>Petugas Selesai Periksa</strong></td>
                <td>: {{ $kunjungan->radiologi->selesai_periksa_by ? (\App\Models\User::find($kunjungan->radiologi->selesai_periksa_by)->name ?? 'User tidak ditemukan') : '-' }}</td>
            </tr>

        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h6 class="text-primary">Hasil Radiologi</h6>
        @if($kunjungan->radiologi->status_pemeriksaan == 'selesai')
        <div class="card border-light">
            <div class="card-body">
                <p><strong>Hasil Radiologi:</strong><br>
                {{ $kunjungan->radiologi->hasil_radiologi ?? 'Tidak ada hasil' }}</p>
                
                <p><strong>Catatan Radiologi:</strong><br>
                {{ $kunjungan->radiologi->catatan_radiologi ?? 'Tidak ada catatan' }}</p>
                
                @if($kunjungan->radiologi->file_gambar)
                <p><strong>File Gambar:</strong><br>
                <a href="{{ asset('storage/' . $kunjungan->radiologi->file_gambar) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-eye"></i> Lihat Gambar
                </a></p>
                @endif
            </div>
        </div>
        @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Pemeriksaan radiologi belum selesai
        </div>
        @endif
    </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Catatan Tambahan Kunjungan -->
                @if($kunjungan->catatan_tambahan)
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-secondary"><i class="fas fa-sticky-note"></i> Catatan Tambahan</h6>
                        <div class="alert alert-light">
                            {{ $kunjungan->catatan_tambahan }}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Status dan Progress Kunjungan -->
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-dark"><i class="fas fa-tasks"></i> Progress & Status Kunjungan</h6>
                        <div class="card border-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6 class="text-primary">Status Umum</h6>
                                        <div class="progress mb-2" style="height: 25px;">
                                            @php
                                                $progress = 0;
                                                if($kunjungan->status == 'menunggu') $progress = 25;
                                                elseif($kunjungan->status == 'dikonfirmasi') $progress = 50;
                                                elseif($kunjungan->status_lengkap['status'] == 'sedang_diperiksa') $progress = 75;
                                                elseif($kunjungan->status_lengkap['status'] == 'selesai') $progress = 100;
                                            @endphp
                                            <div class="progress-bar bg-{{ $progress == 100 ? 'success' : ($progress >= 50 ? 'info' : 'warning') }}" 
                                                 style="width: {{ $progress }}%">
                                                {{ $progress }}% Complete
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $kunjungan->status_lengkap['keterangan'] }}</small>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="text-success">Durasi Proses</h6>
                                        @php
                                            $waktu_mulai = $kunjungan->created_at;
                                            $waktu_selesai = null;
                                            
                                            if($kunjungan->keluhan == 'pemeriksaan_umum' && $kunjungan->pemeriksaanUmum && $kunjungan->pemeriksaanUmum->waktu_selesai_periksa) {
                                                $waktu_selesai = \Carbon\Carbon::parse($kunjungan->pemeriksaanUmum->waktu_selesai_periksa);
                                            } elseif($kunjungan->keluhan == 'lab' && $kunjungan->laboratorium && $kunjungan->laboratorium->status_pemeriksaan == 'selesai') {
                                                $waktu_selesai = $kunjungan->laboratorium->updated_at;
                                            } elseif($kunjungan->keluhan == 'radiologi' && $kunjungan->radiologi && $kunjungan->radiologi->status_pemeriksaan == 'selesai') {
                                                $waktu_selesai = $kunjungan->radiologi->updated_at;
                                            }
                                            
                                            $durasi = $waktu_selesai ? $waktu_mulai->diffInHours($waktu_selesai) : $waktu_mulai->diffInHours(now());
                                        @endphp
                                        <p class="mb-0">
                                            <strong>{{ $durasi }} jam</strong><br>
                                            <small class="text-muted">
                                                Dari: {{ $waktu_mulai->format('d/m/Y H:i') }}<br>
                                                {{ $waktu_selesai ? 'Sampai: ' . $waktu_selesai->format('d/m/Y H:i') : 'Masih berlangsung' }}
                                            </small>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="text-info">Info Tambahan</h6>
                                        <p class="mb-1"><strong>ID Kunjungan:</strong> #{{ $kunjungan->id }}</p>
                                        <p class="mb-1"><strong>Prioritas:</strong> 
                                            <span class="badge badge-{{ $loop->first ? 'danger' : 'secondary' }}">
                                                {{ $loop->first ? 'Tinggi (Terbaru)' : 'Normal' }}
                                            </span>
                                        </p>
                <p class="mb-0"><strong>Jam Daftar:</strong> {{ $kunjungan->jam_submit }}</p>
                  @if($kunjungan->transferred_by)
        <p class="mb-1"><strong>Petugas Transfer:</strong> {{ $kunjungan->transferredBy->name }}</p>
        <p class="mb-0"><strong>Waktu Transfer:</strong> {{ $kunjungan->transferred_at->format('d/m/Y H:i') }}</p>
    @else
        <p class="mb-0"><strong>Status:</strong> <span class="text-muted">Belum ditransfer</span></p>
    @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Perubahan Status -->
                @if(isset($kunjungan->status_history) && count($kunjungan->status_history) > 0)
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-warning"><i class="fas fa-history"></i> Riwayat Perubahan Status</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Waktu</th>
                                        <th>Status Lama</th>
                                        <th>Status Baru</th>
                                        <th>User</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kunjungan->status_history as $history)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($history['waktu'])->format('d/m/Y H:i:s') }}</td>
                                        <td><span class="badge badge-secondary">{{ $history['status_lama'] }}</span></td>
                                        <td><span class="badge badge-primary">{{ $history['status_baru'] }}</span></td>
                                        <td>{{ $history['user'] ?? 'System' }}</td>
                                        <td>{{ $history['keterangan'] ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Informasi Biaya (jika ada) -->
                @if(isset($kunjungan->biaya_info))
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-success"><i class="fas fa-money-bill-wave"></i> Informasi Biaya</h6>
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td><strong>Biaya Pendaftaran:</strong></td>
                                                <td>Rp {{ number_format($kunjungan->biaya_info['pendaftaran'] ?? 0, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Biaya Pemeriksaan:</strong></td>
                                                <td>Rp {{ number_format($kunjungan->biaya_info['pemeriksaan'] ?? 0, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Biaya Obat:</strong></td>
                                                <td>Rp {{ number_format($kunjungan->biaya_info['obat'] ?? 0, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="border-top">
                                                <td><strong>Total Biaya:</strong></td>
                                                <td><strong>Rp {{ number_format($kunjungan->biaya_info['total'] ?? 0, 0, ',', '.') }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-info">Status Pembayaran</h6>
                                        <span class="badge badge-{{ ($kunjungan->biaya_info['status_bayar'] ?? 'belum') == 'lunas' ? 'success' : 'warning' }} badge-lg">
                                            {{ ucfirst($kunjungan->biaya_info['status_bayar'] ?? 'Belum Bayar') }}
                                        </span>
                                        @if(isset($kunjungan->biaya_info['tgl_bayar']))
                                        <p class="mt-2 mb-0">
                                            <small class="text-muted">
                                                Dibayar: {{ \Carbon\Carbon::parse($kunjungan->biaya_info['tgl_bayar'])->format('d/m/Y H:i:s') }}
                                            </small>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
        @endforeach

        <!-- Summary Semua Kunjungan -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-chart-line"></i> Ringkasan Semua Kunjungan Pasien</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary">Grafik Jenis Keluhan</h6>
                        <canvas id="keluhanChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-success">Timeline Kunjungan</h6>
                        <div class="timeline-container" style="max-height: 300px; overflow-y: auto;">
                            @foreach($riwayatKunjungan->sortBy('tgl_pendaftaran') as $item)
                            <div class="d-flex align-items-center mb-2">
                                <div class="timeline-date" style="width: 100px; font-size: 12px;">
                                    {{ \Carbon\Carbon::parse($item->tgl_pendaftaran)->format('d/m/Y') }}
                                </div>
                                <div class="timeline-connector mx-2">
                                    <i class="fas fa-circle text-{{ 
                                        $item->keluhan == 'pemeriksaan_umum' ? 'success' : 
                                        ($item->keluhan == 'lab' ? 'warning' : 'danger') 
                                    }}"></i>
                                </div>
                                <div class="timeline-content flex-grow-1">
                                    <span class="badge badge-{{ 
                                        $item->keluhan == 'pemeriksaan_umum' ? 'success' : 
                                        ($item->keluhan == 'lab' ? 'warning' : 'danger') 
                                    }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->keluhan)) }}
                                    </span>
                                    <small class="text-muted ml-2">
                                        {{ $item->status_lengkap['keterangan'] ?? $item->status }}
                                    </small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Tabel Ringkasan per Tahun -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="text-info">Ringkasan Kunjungan per Tahun</h6>
                        @php
                            $kunjunganPerTahun = $riwayatKunjungan->groupBy(function($item) {
                                return \Carbon\Carbon::parse($item->tgl_pendaftaran)->year;
                            });
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Total Kunjungan</th>
                                        <th>Pemeriksaan Umum</th>
                                        <th>Laboratorium</th>
                                        <th>Radiologi</th>
                                        <th>Status Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kunjunganPerTahun->sortKeysDesc() as $tahun => $kunjunganTahun)
                                    <tr>
                                        <td><strong>{{ $tahun }}</strong></td>
                                        <td>{{ $kunjunganTahun->count() }}</td>
                                        <td>{{ $kunjunganTahun->where('keluhan', 'pemeriksaan_umum')->count() }}</td>
                                        <td>{{ $kunjunganTahun->where('keluhan', 'lab')->count() }}</td>
                                        <td>{{ $kunjunganTahun->where('keluhan', 'radiologi')->count() }}</td>
                                        <td>
                                            @php
                                                $selesai = $kunjunganTahun->filter(function($item) {
                                                    return ($item->status_lengkap['status'] ?? '') == 'selesai';
                                                })->count();
                                            @endphp
                                            {{ $selesai }} / {{ $kunjunganTahun->count() }}
                                            <small class="text-muted">({{ $kunjunganTahun->count() > 0 ? round(($selesai/$kunjunganTahun->count())*100) : 0 }}%)</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekomendasi dan Catatan Medis -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-user-md"></i> Catatan Medis & Rekomendasi</h5>
            </div>
            <div class="card-body">
                @php
                    $allDiagnosis = [];
                    $allObat = [];
                    $allRujukan = [];
                    
                    foreach($riwayatKunjungan as $kunjungan) {
                        if($kunjungan->keluhan == 'pemeriksaan_umum' && $kunjungan->pemeriksaanUmum) {
                            if($kunjungan->pemeriksaanUmum->diagnosis_sementara) {
                                $allDiagnosis[] = [
                                    'tanggal' => $kunjungan->tgl_pendaftaran,
                                    'diagnosis' => $kunjungan->pemeriksaanUmum->diagnosis_sementara
                                ];
                            }
                            if($kunjungan->pemeriksaanUmum->obat_diberikan) {
                                $allObat[] = [
                                    'tanggal' => $kunjungan->tgl_pendaftaran,
                                    'obat' => $kunjungan->pemeriksaanUmum->obat_diberikan
                                ];
                            }
                            if($kunjungan->pemeriksaanUmum->rujukan) {
                                $allRujukan[] = [
                                    'tanggal' => $kunjungan->tgl_pendaftaran,
                                    'rujukan' => $kunjungan->pemeriksaanUmum->rujukan
                                ];
                            }
                        }
                    }
                @endphp

                <div class="row">
                    <div class="col-md-4">
                        <h6 class="text-primary">Riwayat Diagnosis</h6>
                        @if(count($allDiagnosis) > 0)
                        <div style="max-height: 200px; overflow-y: auto;">
                            @foreach($allDiagnosis as $diag)
                            <div class="border-left border-primary pl-3 mb-2">
                                <small class="text-muted">{{ \Carbon\Carbon::parse($diag['tanggal'])->format('d/m/Y') }}</small>
                                <p class="mb-0">{{ $diag['diagnosis'] }}</p>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted">Belum ada diagnosis tercatat</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-success">Riwayat Obat</h6>
                        @if(count($allObat) > 0)
                        <div style="max-height: 200px; overflow-y: auto;">
                            @foreach($allObat as $obat)
                            <div class="border-left border-success pl-3 mb-2">
                                <small class="text-muted">{{ \Carbon\Carbon::parse($obat['tanggal'])->format('d/m/Y') }}</small>
                                <p class="mb-0">{{ $obat['obat'] }}</p>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted">Belum ada obat tercatat</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-warning">Riwayat Rujukan</h6>
                        @if(count($allRujukan) > 0)
                        <div style="max-height: 200px; overflow-y: auto;">
                            @foreach($allRujukan as $rujukan)
                            <div class="border-left border-warning pl-3 mb-2">
                                <small class="text-muted">{{ \Carbon\Carbon::parse($rujukan['tanggal'])->format('d/m/Y') }}</small>
                                <p class="mb-0">{{ $rujukan['rujukan'] }}</p>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted">Belum ada rujukan tercatat</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js untuk grafik -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Grafik Jenis Keluhan
    const ctx = document.getElementById('keluhanChart').getContext('2d');
    const keluhanData = {
        'Pemeriksaan Umum': {{ $statistikPasien['pemeriksaan_umum'] }},
        'Laboratorium': {{ $statistikPasien['laboratorium'] }},
        'Radiologi': {{ $statistikPasien['radiologi'] }}
    };
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(keluhanData),
            datasets: [{
                data: Object.values(keluhanData),
                backgroundColor: [
                    '#28a745',
                    '#ffc107', 
                    '#dc3545'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>

<!-- Custom CSS untuk Timeline -->
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.timeline-item:not(:last-child):after {
    content: '';
    position: absolute;
    left: -25px;
    top: 17px;
    height: calc(100% + 20px);
    width: 2px;
    background-color: #dee2e6;
}

.timeline-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
}

.timeline-description {
    font-size: 13px;
    margin-bottom: 0;
}

@media print {
    .btn, .no-print {
        display: none !important;
    }
    
    .card {
        border: 1px solid #000 !important;
    }
    
    .bg-primary, .bg-info, .bg-success, .bg-warning, .bg-danger, .bg-secondary {
        background-color: #f8f9fa !important;
        color: #000 !important;
    }
}
</style>

</x-admin-layout>
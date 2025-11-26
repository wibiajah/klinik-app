<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">Detail Perawat</h2>
            <div>
                <a href="{{ route('admin.data-perawat.edit', $perawat) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.data-perawat.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <!-- Foto dan Info Dasar -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        @if($perawat->foto)
                            <img src="{{ asset('storage/' . $perawat->foto) }}" 
                                 alt="Foto {{ $perawat->nama_perawat }}" 
                                 class="img-fluid rounded-circle mb-3"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                        @endif
                        
                        <h5 class="card-title mb-2">{{ $perawat->nama_perawat }}</h5>
                        <p class="text-muted mb-2">{{ $perawat->tingkat_pendidikan }}</p>
                        
                        <span class="badge {{ $perawat->status_aktif ? 'bg-success' : 'bg-danger' }} fs-6">
                            {{ $perawat->status_aktif ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Data Pribadi -->
            <div class="col-lg-8 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-user-circle"></i> Data Pribadi
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <p class="mb-0">{{ $perawat->nama_perawat }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <p class="mb-0">{{ $perawat->jenis_kelamin }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Lahir</label>
                                <p class="mb-0">{{ $perawat->tanggal_lahir->format('d F Y') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Umur</label>
                                <p class="mb-0">{{ $perawat->tanggal_lahir->age }} tahun</p>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Alamat</label>
                                <p class="mb-0">{{ $perawat->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Data Profesional -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-stethoscope"></i> Data Profesional
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tingkat Pendidikan</label>
                            <p class="mb-0">{{ $perawat->tingkat_pendidikan }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">No. STR</label>
                            <p class="mb-0 font-monospace">{{ $perawat->no_str }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <br>
                            <span class="badge {{ $perawat->status_aktif ? 'bg-success' : 'bg-danger' }}">
                                {{ $perawat->status_aktif ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Kontak -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-address-book"></i> Data Kontak
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <p class="mb-0">
                                <a href="tel:{{ $perawat->no_telepon }}" class="text-decoration-none">
                                    {{ $perawat->no_telepon }}
                                </a>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p class="mb-0">
                                <a href="mailto:{{ $perawat->email }}" class="text-decoration-none">
                                    {{ $perawat->email }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Kerja -->
        @if($perawat->jadwal_kerja && count($perawat->jadwal_kerja) > 0)
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-calendar-alt"></i> Jadwal Kerja
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $hari_indonesia = [
                                    'senin' => 'Senin',
                                    'selasa' => 'Selasa', 
                                    'rabu' => 'Rabu',
                                    'kamis' => 'Kamis',
                                    'jumat' => 'Jumat',
                                    'sabtu' => 'Sabtu',
                                    'minggu' => 'Minggu'
                                ];
                                
                                $shift_colors = [
                                    'pagi' => 'bg-warning text-dark',
                                    'siang' => 'bg-info text-white',
                                    'malam' => 'bg-dark text-white'
                                ];
                            @endphp

                            @foreach($perawat->jadwal_kerja as $hari => $jadwal)
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <h6 class="fw-bold text-primary mb-2">
                                            {{ $hari_indonesia[$hari] ?? ucfirst($hari) }}
                                        </h6>
                                        <div class="mb-2">
                                            <small class="text-muted">Jam Kerja:</small>
                                            <br>
                                            <span class="fw-semibold">
                                                {{ $jadwal['jam_mulai'] ?? '-' }} - {{ $jadwal['jam_selesai'] ?? '-' }}
                                            </span>
                                        </div>
                                        @if(isset($jadwal['shift']))
                                            <span class="badge {{ $shift_colors[$jadwal['shift']] ?? 'bg-secondary' }}">
                                                Shift {{ ucfirst($jadwal['shift']) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <a href="{{ route('admin.data-perawat.edit', $perawat) }}" 
                           class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        
                        <button type="button" 
                                class="btn btn-danger me-2" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        
                        <a href="{{ route('admin.data-perawat.index') }}" 
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data perawat <strong>{{ $perawat->nama_perawat }}</strong>?</p>
                    <p class="text-danger mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        Tindakan ini tidak dapat dibatalkan!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.data-perawat.destroy', $perawat) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<x-admin-layout>
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Detail Dokter</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.data-dokter.index') }}">Data Dokter</a></li>
                        <li class="breadcrumb-item active">{{ $dokter->nama_dokter }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.data-dokter.edit', $dokter->id_dokter) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.data-dokter.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak
                </a>
                
            </div>
        </div>

        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        @if($dokter->foto)
                            <img src="{{ asset('storage/' . $dokter->foto) }}" 
                                 alt="Foto {{ $dokter->nama_dokter }}" 
                                 class="rounded-circle mb-3" 
                                 width="150" height="150" style="object-fit: cover;">
                        @else
                            <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                        @endif
                        
                        <h4 class="card-title">{{ $dokter->nama_dokter }}</h4>
                        <p class="text-muted">{{ $dokter->spesialisasi }}</p>
                        
                        <div class="mt-3">
                            @if($dokter->status_aktif)
                                <span class="badge bg-success fs-6">Status: Aktif</span>
                            @else
                                <span class="badge bg-danger fs-6">Status: Tidak Aktif</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Information -->
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Detail</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Data Pribadi</h6>
                                
                                <div class="mb-3">
                                    <strong>Nama Lengkap:</strong>
                                    <p class="mb-1">{{ $dokter->nama_dokter }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Jenis Kelamin:</strong>
                                    <p class="mb-1">{{ $dokter->jenis_kelamin }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Tanggal Lahir:</strong>
                                    <p class="mb-1">{{ \Carbon\Carbon::parse($dokter->tanggal_lahir)->format('d F Y') }}</p>
                                    <small class="text-muted">
                                        ({{ \Carbon\Carbon::parse($dokter->tanggal_lahir)->age }} tahun)
                                    </small>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Alamat:</strong>
                                    <p class="mb-1">{{ $dokter->alamat }}</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Data Profesional</h6>
                                
                                <div class="mb-3">
                                    <strong>Spesialisasi:</strong>
                                    <p class="mb-1">
                                        <span class="badge bg-info text-dark">{{ $dokter->spesialisasi }}</span>
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>No. STR:</strong>
                                    <p class="mb-1">{{ $dokter->no_str }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>No. Telepon:</strong>
                                    <p class="mb-1">
                                        <a href="tel:{{ $dokter->no_telepon }}">{{ $dokter->no_telepon }}</a>
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Email:</strong>
                                    <p class="mb-1">
                                        <a href="mailto:{{ $dokter->email }}">{{ $dokter->email }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Praktik -->
                <div class="card shadow mt-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Jadwal Praktik</h6>
                    </div>
                    <div class="card-body">
                        @if($dokter->jadwal_praktik && count($dokter->jadwal_praktik) > 0)
                            <div class="row">
                                @php
                                    $namaHari = [
                                        'senin' => 'Senin',
                                        'selasa' => 'Selasa',
                                        'rabu' => 'Rabu',
                                        'kamis' => 'Kamis',
                                        'jumat' => 'Jumat',
                                        'sabtu' => 'Sabtu',
                                        'minggu' => 'Minggu'
                                    ];
                                @endphp
                                
                                @foreach($dokter->jadwal_praktik as $hari => $jadwal)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card border-left-primary">
                                            <div class="card-body py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <i class="fas fa-calendar-day text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold text-primary">
                                                            {{ $namaHari[$hari] ?? ucfirst($hari) }}
                                                        </div>
                                                        <div class="text-sm">
                                                            {{ $jadwal['jam_mulai'] ?? '' }} - {{ $jadwal['jam_selesai'] ?? '' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">Jadwal praktik belum diatur</h6>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="card shadow mt-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Tambahan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <strong>Data Dibuat:</strong>
                                    <p class="mb-0 text-muted">
                                        {{ $dokter->created_at->format('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <strong>Terakhir Diperbarui:</strong>
                                    <p class="mb-0 text-muted">
                                        {{ $dokter->updated_at->format('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<x-admin-layout title="Layanan Pemeriksaan Umum">
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Layanan Pemeriksaan Umum</h1>
            <div class="d-flex align-items-center">
                <label for="tanggal" class="form-label me-2 mb-0">Filter Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $tanggal }}" onchange="filterByDate()">
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.layanan.dashboard') }}">Layanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pemeriksaan Umum</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Antrian</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['menunggu_antrian'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Dalam Antrian</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['dalam_antrian'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list-ol fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['selesai'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Menunggu Antrian -->
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 bg-warning text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-user-clock me-2"></i>
                            Menunggu Antrian ({{ $statistics['menunggu_antrian'] }})
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        @if($menungguAntrian->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($menungguAntrian as $item)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $item->nama }}</h6>
                                                <p class="mb-1 small text-muted">
                                                    <i class="fas fa-id-card me-1"></i>{{ $item->nik }}<br>
                                                    <i class="fas fa-barcode me-1"></i>{{ $item->no_rekam_medis }}<br>
                                                    <i class="fas fa-clock me-1"></i>{{ $item->created_at->format('H:i') }}
                                                </p>
                                            </div>
                                            <div class="btn-group-vertical">
                                                <form method="POST" action="{{ route('admin.layanan.pemeriksaan-umum.antrian', $item->id) }}" 
                                                      class="d-inline" onsubmit="return confirm('Masukkan pasien ke antrian?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm mb-1" title="Masuk Antrian">
                                                        <i class="fas fa-arrow-right"></i> Antrian
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.pendaftaran.detail', $item->id) }}" 
                                                   class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada pasien menunggu antrian</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Dalam Antrian -->
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-list-ol me-2"></i>
                            Antrian Aktif ({{ $statistics['dalam_antrian'] }})
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        @if($dalamAntrian->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($dalamAntrian as $item)
                                    <div class="list-group-item {{ $loop->first ? 'bg-light border-left-primary' : '' }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-primary rounded-pill me-2 fs-6">
                                                        #{{ $item->no_antrian_pemeriksaan_umum }}
                                                    </span>
                                                    @if($loop->first)
                                                        <span class="badge bg-success">Sedang Dilayani</span>
                                                    @endif
                                                </div>
                                                <h6 class="mb-1">{{ $item->nama }}</h6>
                                                <p class="mb-1 small text-muted">
                                                    <i class="fas fa-id-card me-1"></i>{{ $item->nik }}<br>
                                                    <i class="fas fa-barcode me-1"></i>{{ $item->no_rekam_medis }}
                                                </p>
                                            </div>
                                            <div class="btn-group-vertical">
                                                @if($loop->first)
                                                    <form method="POST" action="{{ route('admin.layanan.pemeriksaan-umum.selesai', $item->id) }}" 
                                                          class="d-inline" onsubmit="return confirm('Selesaikan pemeriksaan pasien ini?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm mb-1" title="Selesai">
                                                            <i class="fas fa-check"></i> Selesai
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('admin.pendaftaran.detail', $item->id) }}" 
                                                   class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-list-ol fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada antrian aktif</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Selesai -->
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 bg-success text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-check-circle me-2"></i>
                            Selesai Hari Ini ({{ $statistics['selesai'] }})
                        </h6>
                    </div>
                    <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                        @if($selesai->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($selesai as $item)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-success rounded-pill me-2">
                                                        #{{ $item->no_antrian_pemeriksaan_umum }}
                                                    </span>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ $item->updated_at->format('H:i') }}
                                                    </small>
                                                </div>
                                                <h6 class="mb-1">{{ $item->nama }}</h6>
                                                <p class="mb-1 small text-muted">
                                                    <i class="fas fa-barcode me-1"></i>{{ $item->no_rekam_medis }}
                                                </p>
                                            </div>
                                            <div>
                                                <a href="{{ route('admin.pendaftaran.detail', $item->id) }}" 
                                                   class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-check-circle fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada yang selesai hari ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-info-circle me-2"></i>
                            Informasi Layanan Pemeriksaan Umum
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold">Alur Layanan:</h6>
                                <ol class="small">
                                    <li>Pasien yang sudah hadir akan muncul di kolom "Menunggu Antrian"</li>
                                    <li>Klik tombol "Antrian" untuk memberikan nomor antrian</li>
                                    <li>Pasien masuk ke "Antrian Aktif" berdasarkan nomor urut</li>
                                    <li>Pasien pertama dalam antrian sedang dilayani</li>
                                    <li>Klik "Selesai" setelah pemeriksaan selesai</li>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold">Keterangan Status:</h6>
                                <ul class="small">
                                    <li><span class="badge bg-warning">Menunggu Antrian</span> - Pasien hadir, belum dapat nomor</li>
                                    <li><span class="badge bg-primary">Dalam Antrian</span> - Sudah dapat nomor antrian</li>
                                    <li><span class="badge bg-success">Sedang Dilayani</span> - Antrian pertama yang sedang diperiksa</li>
                                    <li><span class="badge bg-success">Selesai</span> - Pemeriksaan sudah selesai</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function filterByDate() {
        const tanggal = document.getElementById('tanggal').value;
        const url = new URL(window.location);
        url.searchParams.set('tanggal', tanggal);
        window.location.href = url.toString();
    }
    </script>
</x-admin-layout>
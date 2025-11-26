<x-admin-layout title="Data Pendaftaran">
    <style>
        :root {
            --primary-green: #00bc84;
            --light-gray: #f8f9fa;
            --dark-gray: #6c757d;
            --border-gray: #e0e0e0;
        }
        
        .custom-card {
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: white;
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            transition: transform 0.2s;
            min-height: 100px;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .stat-icon {
            font-size: 1.5rem;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
        
        .stat-label {
            font-size: 0.75rem;
            color: var(--dark-gray);
            text-transform: uppercase;
            font-weight: 600;
            margin: 0;
        }
        
        .custom-badge {
            background-color: var(--primary-green) !important;
            color: white !important;
            font-weight: 500;
        }
        
        .table-header {
            background-color: #f1f1f1 !important;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            user-select: none;
            position: relative;
        }
        
        .table-header:hover {
            background-color: #e9ecef !important;
        }
        
        .sort-icon {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        .search-container {
            background: white;
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .search-input {
            border: 1px solid var(--border-gray);
            border-radius: 4px;
            padding: 0.5rem;
        }
        
        .search-input:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(2, 183, 35, 0.25);
        }
        
      /* Tambahkan CSS ini ke dalam <style> tag yang sudah ada */

.btn-action {
    border: none;
    border-radius: 6px;
    width: 35px;
    height: 35px;
    font-size: 0.9rem;
    margin-right: 0.3rem;
    margin-bottom: 0.2rem;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.btn-detail {
    background-color: #6c757d;
    color: white;
}

.btn-detail:hover {
    background-color: #5a6268;
    color: white;
    transform: translateY(-1px);
}

.btn-edit {
    background-color: #ffc107;
    color: #212529;
}

.btn-edit:hover {
    background-color: #e0a800;
    color: #212529;
    transform: translateY(-1px);
}

.btn-confirm {
    background-color: #28a745;
    color: white;
}

.btn-confirm:hover {
    background-color: #218838;
    color: white;
    transform: translateY(-1px);
}

.btn-reject {
    background-color: #dc3545;
    color: white;
}

.btn-reject:hover {
    background-color: #c82333;
    color: white;
    transform: translateY(-1px);
}

.btn-delete {
    background-color: #e74c3c;
    color: white;
}

.btn-delete:hover {
    background-color: #c0392b;
    color: white;
    transform: translateY(-1px);
}

/* Transfer Buttons dengan warna spesifik */
.btn-transfer {
    background-color: #007bff;
    color: white;
}

.btn-transfer:hover {
    background-color: #0056b3;
    color: white;
    transform: translateY(-1px);
}

/* Transfer Lab - Ungu untuk Laboratorium */
.btn-transfer-lab {
    background-color: #6f42c1;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    transition: all 0.2s;
}

.btn-transfer-lab:hover {
    background-color: #5a2d91;
    color: white;
    transform: translateY(-1px);
}

/* Transfer Radiologi - Orange untuk Radiologi */
.btn-transfer-radio {
    background-color: #fd7e14;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    transition: all 0.2s;
}

.btn-transfer-radio:hover {
    background-color: #e8590c;
    color: white;
    transform: translateY(-1px);
}

/* Button yang sudah di-transfer */
.btn-transferred {
    background-color: #28a745;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    opacity: 0.7;
}

/* Container untuk action buttons */
.action-buttons-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.2rem;
}
        .page-title {
            font-weight: bold;
            color: #333;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .date-filter {
            border: 1px solid var(--border-gray);
            border-radius: 4px;
            padding: 0.5rem;
        }
        
        .date-filter:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(2, 183, 35, 0.25);
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: var(--dark-gray);
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--dark-gray);
        }
        
        .empty-icon {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
        
        .keluhan-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
        }
        
        .keluhan-pemeriksaan {
            background-color: #e3f2fd;
            color: #1565c0;
        }
        
        .keluhan-lab {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }
        
        .keluhan-radiologi {
            background-color: #fff3e0;
            color: #ef6c00;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Pendaftaran  Hari Ini</h1>
            <div class="d-flex align-items-center">
                <label for="tanggal" class="form-label me-2 mb-0 fw-semibold">Filter Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" class="date-filter" value="{{ $tanggal }}" onchange="filterByDate()">
                  <a href="{{ route('admin.pendaftaran.create') }}" class="btn btn-success d-flex align-items-center">
                    <i class="fas fa-plus me-2"></i>
                    Create Pasien
                </a>
            </div>
            
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pendaftaran</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['total_hari_ini'] }}</div>
                    <div class="stat-label">Total Hari Ini</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['menunggu'] }}</div>
                    <div class="stat-label">Menunggu Konfirmasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['dikonfirmasi'] }}</div>
                    <div class="stat-label">Dikonfirmasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['ditolak'] }}</div>
                    <div class="stat-label">Ditolak</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="search-container">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Cari Nama:</label>
                    <input type="text" id="searchNama" class="form-control search-input" placeholder="Masukkan nama...">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Cari NIK:</label>
                    <input type="text" id="searchNik" class="form-control search-input" placeholder="Masukkan NIK...">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Filter Status:</label>
                    <select id="filterStatus" class="form-control search-input">
                        <option value="">Semua Status</option>
                        <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                        <option value="Dikonfirmasi">Dikonfirmasi</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Filter Keluhan:</label>
                    <select id="filterKeluhan" class="form-control search-input">
                        <option value="">Semua Keluhan</option>
                        <option value="Pemeriksaan Umum">Pemeriksaan Umum</option>
                        <option value="Laboratorium">Laboratorium</option>
                        <option value="Radiologi">Radiologi</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Main Data Table -->
        <div class="custom-card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                <h6 class="m-0 fw-bold" style="color: #333;">
                    Daftar Pendaftaran - {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                </h6>
                <span class="badge custom-badge">{{ $pendaftaran->total() }} Total</span>
            </div>
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3 auto-dismiss" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3 auto-dismiss" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

               <div class="table-responsive">
    <table class="table table-hover mb-0 compact-table" id="pendaftaranTable">
       <thead>
    <tr>
        <th class="table-header sortable" data-sort="no">
            No
            <i class="fas fa-sort sort-icon"></i>
        </th>
        <th class="table-header sortable" data-sort="rekam_medis">
            No. Rekam Medis
            <i class="fas fa-sort sort-icon"></i>
        </th>
        <th class="table-header sortable" data-sort="nama">
            Nama
            <i class="fas fa-sort sort-icon"></i>
        </th>
        <th class="table-header sortable" data-sort="nik">
            NIK
            <i class="fas fa-sort sort-icon"></i>
        </th>
        <th class="table-header sortable" data-sort="keluhan">
            Layanan
            <i class="fas fa-sort sort-icon"></i>
        </th>
        <th class="table-header sortable" data-sort="status">
            Status
            <i class="fas fa-sort sort-icon"></i>
        </th>
        <th class="table-header">
            Status Transfer <i class="fas fa-info-circle ms-1"></i>
        </th>
        <th class="table-header">
    Petugas Transfer <i class="fas fa-user-tie ms-1"></i>
</th>
        <th class="table-header">Aksi</th>
    </tr>
</thead>
       <tbody>
    @forelse($pendaftaran as $item)
    <tr>
        <td class="fw-semibold">{{ $loop->iteration + ($pendaftaran->currentPage() - 1) * $pendaftaran->perPage() }}</td>
<td>
    @if($item->no_rekam_medis)
        <code style="background-color: #f8f9fa; color: #333; padding: 2px 6px; border-radius: 3px;">{{ $item->no_rekam_medis }}</code>
    @else
        <span class="text-muted">-</span>
    @endif
    
    @if($item->is_lpk_sentosa)
        <span class="badge badge-info ms-2" style="font-size: 10px; background-color: #17a2b8; color: white; padding: 2px 6px; border-radius: 3px; margin-left: 8px;">
            LPK Sentosa
        </span>
    @endif
</td>
        <td>
            <div class="fw-semibold">{{ $item->nama }}</div>
            <small class="text-muted">{{ $item->jenis_kelamin_label }}</small>
        </td>
        <td>{{ $item->nik }}</td>
        <td>
            @if($item->keluhan == 'pemeriksaan_umum')
                <span class="badge keluhan-pemeriksaan">
                    <i class="fas fa-user-md me-1"></i>Pemeriksaan Umum
                </span>
            @elseif($item->keluhan == 'lab')
                <span class="badge keluhan-lab">
                    <i class="fas fa-flask me-1"></i>Laboratorium
                </span>
            @elseif($item->keluhan == 'radiologi')
                <span class="badge keluhan-radiologi">
                    <i class="fas fa-x-ray me-1"></i>Radiologi
                </span>
            @else
                <span class="badge" style="background-color: #6c757d; color: white;">
                    <i class="fas fa-question me-1"></i>{{ ucfirst(str_replace('_', ' ', $item->keluhan)) }}
                </span>
            @endif
        </td>
        <td>
            @if($item->status == 'menunggu')
                <span class="badge" style="background-color: #ffc107; color: #212529;">{{ $item->status_label }}</span>
            @elseif($item->status == 'dikonfirmasi')
                <span class="badge custom-badge">{{ $item->status_label }}</span>
            @else
                <span class="badge" style="background-color: #dc2626; color: white;">{{ $item->status_label }}</span>
            @endif
        </td>
        <td>
            @if($item->is_transferred)
    @if($item->keluhan == 'pemeriksaan_umum')
        <span class="badge" style="background-color: #10b981; color: white !important;">
            <i class="fas fa-user-md me-1" style="color: white !important;"></i>Sudah di P.Umum
        </span>
    @elseif($item->keluhan == 'lab')
        <span class="badge" style="background-color: #10b981; color: white !important;">
            <i class="fas fa-vial me-1" style="color: white !important;"></i>Sudah di Laboratorium
        </span>
    @elseif($item->keluhan == 'radiologi')
        <span class="badge" style="background-color: #10b981; color: white !important;">
            <i class="fas fa-image me-1" style="color: white !important;"></i>Sudah di Radiologi
        </span>
    @else
        <span class="badge" style="background-color: #10b981; color: white !important;">
            <i class="fas fa-check me-1" style="color: white !important;"></i>Sudah Transfer
        </span>
    @endif
@else
                <span class="badge" style="background-color: #6b7280; color: white;">
                    <i class="fas fa-clock me-1"></i>Belum Transfer
                </span>
            @endif
        </td>
        <td>
    @if($item->transferred_by)
        <div class="fw-semibold">{{ $item->transferredBy->name }}</div>
        <small class="text-muted">{{ $item->transferred_at ? $item->transferred_at->format('d/m/Y H:i') : '-' }}</small>
    @else
        <span class="text-muted">-</span>
    @endif
</td>
        <td>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton{{ $item->id }}" 
                        data-bs-toggle="dropdown" aria-expanded="false" 
                        style="background-color: var(--primary-green); color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px;">
                    <i class="fas fa-cog me-1"></i> Aksi
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}" style="min-width: 150px;">
                    <!-- Detail Button -->
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.pendaftaran.detail', $item->id) }}">
                            <i class="fas fa-eye me-2 text-primary"></i> Detail
                        </a>
                    </li>
                    
                    <!-- Edit Button -->
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.pendaftaran.edit', $item->id) }}">
                            <i class="fas fa-edit me-2 text-warning"></i> Edit
                        </a>
                    </li>
                    
                    @if($item->status == 'menunggu')
                        <li><hr class="dropdown-divider"></li>
                        
                        <!-- Confirm Button -->
                       <li>
    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi{{ $item->id }}">
        <i class="fas fa-check me-2 text-success"></i> Konfirmasi
    </button>
</li>
                        
                        <!-- Reject Button -->
                        <li>
                            <form method="POST" action="{{ route('admin.pendaftaran.tolak', $item->id) }}" 
                                  class="d-inline w-100" onsubmit="return confirm('Tolak pendaftaran ini?')">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-times me-2 text-danger"></i> Tolak
                                </button>
                            </form>
                        </li>
                        
                        <!-- Delete Button -->
                        @if(!$item->is_transferred)
                        <li>
                            <form method="POST" action="{{ route('admin.pendaftaran.destroy', $item->id) }}" 
                                  class="d-inline w-100" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-trash me-2"></i> Hapus
                                </button>
                            </form>
                        </li>
                        @endif
                        
                    @elseif($item->status == 'dikonfirmasi' && $item->no_rekam_medis)
                        <li><hr class="dropdown-divider"></li>
                        
                        @if($item->keluhan == 'pemeriksaan_umum')
                            @if(!$item->is_transferred)
                                <li>
                                    <form method="POST" action="{{ route('admin.pemeriksaanumum.transfer', $item->id) }}" 
                                          class="d-inline w-100" onsubmit="return confirm('Transfer ke Pemeriksaan Umum?')">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-user-md me-2" style="color: var(--primary-green);"></i> Transfer ke P.Umum
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <span class="dropdown-item text-success">
                                        <i class="fas fa-check-double me-2"></i> Sudah di P.Umum
                                    </span>
                                </li>
                            @endif
                            
                        @elseif($item->keluhan == 'lab')
                            @if(!$item->is_transferred)
                                <li>
                                    <form method="POST" action="{{ route('admin.laboratorium.transfer', $item->id) }}" class="d-inline w-100">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-flask me-2" style="color: var(--primary-green);"></i> Transfer ke Lab
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <span class="dropdown-item text-success">
                                        <i class="fas fa-vial me-2"></i> Sudah di Lab
                                    </span>
                                </li>
                            @endif
                            
                        @elseif($item->keluhan == 'radiologi')
                            @if(!$item->is_transferred)
                                <li>
                                    <form method="POST" action="{{ route('admin.radiologi.transfer', $item->id) }}" class="d-inline w-100">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-x-ray me-2" style="color: var(--primary-green);"></i> Transfer ke Radiologi
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <span class="dropdown-item text-success">
                                        <i class="fas fa-image me-2"></i> Sudah di Radiologi
                                    </span>
                                </li>
                            @endif
                        @endif
                    @endif
                </ul>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9">
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <p class="mb-0">Tidak ada pendaftaran pada tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>
    </table>
</div>

                <!-- Pagination -->
                @if($pendaftaran->hasPages())
                    <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                        {{ $pendaftaran->appends(['tanggal' => $tanggal])->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@foreach($pendaftaran as $item)
@if($item->status == 'menunggu')
<div class="modal fade" id="modalKonfirmasi{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

                <form method="POST" action="{{ route('admin.pendaftaran.konfirmasi', $item->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Pasien:</strong> {{ $item->nama }}<br>
                        <strong>NIK:</strong> {{ $item->nik }}
                    </div>
                    
                    <div class="mb-3">
                        <label for="email{{ $item->id }}" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email{{ $item->id }}" name="email" 
                               value="{{ $item->email ?? '' }}" required>
                        <div class="form-text">Masukkan email pasien untuk komunikasi</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="no_hp{{ $item->id }}" class="form-label">No. HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_hp{{ $item->id }}" name="no_hp" 
                               value="{{ $item->no_hp }}" required maxlength="15">
                        <div class="form-text">Periksa kembali nomor HP pasien</div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_lpk_sentosa{{ $item->id }}" 
                                   name="is_lpk_sentosa" value="1" {{ $item->is_lpk_sentosa ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_lpk_sentosa{{ $item->id }}">
                                <strong>Anak LPK Sentosa</strong>
                            </label>
                        </div>
                        <div class="form-text">Centang jika pasien adalah anak dari LPK Sentosa</div>
                    </div>
                    <div class="mb-3" id="foto_bukti_container{{ $item->id }}" style="display: none;">
    <label for="foto_bukti{{ $item->id }}" class="form-label">
        Foto Bukti Anak LPK Sentosa <span class="text-danger">*</span>
    </label>
    <input type="file" class="form-control" id="foto_bukti{{ $item->id }}" name="foto_bukti" 
           accept="image/jpeg,image/png,image/jpg">
    <div class="form-text">Upload foto bukti bahwa pasien adalah anak LPK Sentosa (JPG, PNG, max 2MB)</div>
</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i> Konfirmasi Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach
    <!-- Di bagian bawah layout atau sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter by date
        function filterByDate() {
            const tanggal = document.getElementById('tanggal').value;
            const url = new URL(window.location);
            url.searchParams.set('tanggal', tanggal);
            window.location.href = url.toString();
        }

        // Auto dismiss alerts after 3 seconds
document.addEventListener('DOMContentLoaded', function() {
    // Auto dismiss alerts
    const alerts = document.querySelectorAll('.auto-dismiss');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 3000);
    });

    // Setup sortable table
    setupSortableTable();
});

        // Search and filter functionality
        document.getElementById('searchNama').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('searchNik').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('filterStatus').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('filterKeluhan').addEventListener('change', function() {
            filterTable();
        });

       function filterTable() {
    const searchNama = document.getElementById('searchNama').value.toLowerCase();
    const searchNik = document.getElementById('searchNik').value.toLowerCase();
    const filterStatus = document.getElementById('filterStatus').value.toLowerCase();
    const filterKeluhan = document.getElementById('filterKeluhan').value.toLowerCase();
    
    // PERBAIKAN: Gunakan ID tabel yang benar
    const table = document.getElementById('pendaftaranTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length > 1) { // Skip empty state row
            // PERBAIKAN: Index kolom yang benar sesuai struktur tabel baru
            const nama = cells[2].querySelector('.fw-semibold') ? 
                        cells[2].querySelector('.fw-semibold').textContent.toLowerCase() : 
                        cells[2].textContent.toLowerCase();
            const nik = cells[3].textContent.toLowerCase();
            const keluhan = cells[4].textContent.toLowerCase();
            const status = cells[5].textContent.toLowerCase(); // Index 5 bukan 6

            const showRow = (
                (searchNama === '' || nama.includes(searchNama)) &&
                (searchNik === '' || nik.includes(searchNik)) &&
                (filterStatus === '' || status.includes(filterStatus)) &&
                (filterKeluhan === '' || keluhan.includes(filterKeluhan))
            );

            rows[i].style.display = showRow ? '' : 'none';
        }
    }
}
function setupSortableTable() {
    const sortableHeaders = document.querySelectorAll('.table-header.sortable');
    
    sortableHeaders.forEach((header, index) => {
        header.addEventListener('click', function() {
            const columnIndex = Array.from(header.parentNode.children).indexOf(header);
            sortTable(columnIndex);
        });
        
        // Make it visually clear that it's clickable
        header.style.cursor = 'pointer';
    });
}
        // Table sorting
  let sortDirection = {};

function sortTable(columnIndex) {
    const table = document.getElementById('pendaftaranTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = Array.from(tbody.getElementsByTagName('tr'));
    
    // Skip if no data rows or only empty state
    if (rows.length === 0 || (rows.length === 1 && rows[0].cells.length === 1)) {
        return;
    }

    // Filter out empty state rows
    const dataRows = rows.filter(row => row.cells.length > 1);
    
    if (dataRows.length === 0) {
        return;
    }

    // Determine sort direction
    const currentDirection = sortDirection[columnIndex] || 'asc';
    const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
    sortDirection[columnIndex] = newDirection;

    // Update sort icons
    const sortIcons = document.querySelectorAll('.sort-icon');
    sortIcons.forEach(icon => {
        icon.className = 'fas fa-sort sort-icon';
    });
    
    const currentIcon = table.querySelectorAll('.sort-icon')[columnIndex];
    if (currentIcon) {
        currentIcon.className = newDirection === 'asc' ? 'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';
    }

    // Sort rows based on column
    dataRows.sort((a, b) => {
        let aValue = '', bValue = '';
        
        // Handle different column types
        switch(columnIndex) {
            case 0: // No
                aValue = parseInt(a.cells[0].textContent.trim()) || 0;
                bValue = parseInt(b.cells[0].textContent.trim()) || 0;
                break;
            case 1: // No. Rekam Medis
                aValue = a.cells[1].textContent.trim().replace('-', '');
                bValue = b.cells[1].textContent.trim().replace('-', '');
                break;
            case 2: // Nama
                aValue = a.cells[2].querySelector('.fw-semibold').textContent.trim().toLowerCase();
                bValue = b.cells[2].querySelector('.fw-semibold').textContent.trim().toLowerCase();
                break;
            case 3: // NIK
                aValue = a.cells[3].textContent.trim();
                bValue = b.cells[3].textContent.trim();
                break;
            case 4: // Keluhan (yang sebelumnya Jam Transfer)
                aValue = a.cells[4].textContent.trim().toLowerCase();
                bValue = b.cells[4].textContent.trim().toLowerCase();
                break;
            case 5: // Status
                aValue = a.cells[5].textContent.trim().toLowerCase();
                bValue = b.cells[5].textContent.trim().toLowerCase();
                break;
            default:
                aValue = a.cells[columnIndex].textContent.trim().toLowerCase();
                bValue = b.cells[columnIndex].textContent.trim().toLowerCase();
        }

        // Compare values
        if (typeof aValue === 'number' && typeof bValue === 'number') {
            return newDirection === 'asc' ? aValue - bValue : bValue - aValue;
        }
        
        if (aValue < bValue) {
            return newDirection === 'asc' ? -1 : 1;
        }
        if (aValue > bValue) {
            return newDirection === 'asc' ? 1 : -1;
        }
        return 0;
    });

    // Clear tbody and re-append sorted rows
    tbody.innerHTML = '';
    dataRows.forEach(row => tbody.appendChild(row));
    
    // Add back empty state if no data
    if (dataRows.length === 0) {
        const emptyRow = rows.find(row => row.cells.length === 1);
        if (emptyRow) {
            tbody.appendChild(emptyRow);
        }
    }
}
// Handle LPK Sentosa checkbox untuk setiap modal
document.addEventListener('DOMContentLoaded', function() {
    @foreach($pendaftaran as $item)
    @if($item->status == 'menunggu')
    document.getElementById('is_lpk_sentosa{{ $item->id }}').addEventListener('change', function() {
        const fotoContainer = document.getElementById('foto_bukti_container{{ $item->id }}');
        const fotoInput = document.getElementById('foto_bukti{{ $item->id }}');
        
        if (this.checked) {
            fotoContainer.style.display = 'block';
            fotoInput.required = true;
        } else {
            fotoContainer.style.display = 'none';
            fotoInput.required = false;
            fotoInput.value = '';
        }
    });
    @endif
    @endforeach
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-admin-layout>
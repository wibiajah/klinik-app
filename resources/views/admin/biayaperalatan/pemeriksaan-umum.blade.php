{{-- resources/views/admin/biayaperalatan/pemeriksaan-umum.blade.php --}}
<x-admin-layout title="Biaya Peralatan - Pemeriksaan Umum">
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
            min-height: 120px;
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
        
        .btn-action {
            border: none;
            border-radius: 4px;
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
            margin-right: 0.2rem;
            transition: all 0.2s;
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
        
        .equipment-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid var(--border-gray);
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .maintenance-badge {
            display: inline-block;
            padding: 2px 6px;
            margin: 1px;
            border-radius: 8px;
            font-size: 0.65rem;
            font-weight: 500;
        }
        
        .btn-add-equipment {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-add-equipment:hover {
            background-color: #028a1c;
            color: white;
            text-decoration: none;
        }
        
        .price-text {
            font-weight: 600;
            color: #333;
        }
        
        .equipment-info {
            display: flex;
            align-items: center;
        }
        
        .equipment-details {
            margin-left: 12px;
        }
        
        .equipment-name {
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .equipment-meta {
            font-size: 0.8rem;
            color: var(--dark-gray);
            margin: 0;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Biaya Peralatan Pemeriksaan Umum</h1>
            <a href="{{ route('admin.biaya-peralatan.create', 'pemeriksaan-umum') }}" class="btn-add-equipment">
                <i class="fas fa-plus me-2"></i>Tambah Peralatan
            </a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: var(--primary-green); text-decoration: none;">Biaya Peralatan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pemeriksaan Umum</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="stat-number">{{ $peralatan->total() }}</div>
                    <div class="stat-label">Total Peralatan</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $peralatan->where('status', 'aktif')->count() }}</div>
                    <div class="stat-label">Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="stat-number">{{ $peralatan->where('status', 'maintenance')->count() }}</div>
                    <div class="stat-label">Maintenance</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-number">Rp {{ number_format($peralatan->sum('harga_beli'), 0, ',', '.') }}</div>
                    <div class="stat-label">Total Investasi</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="search-container">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Cari Nama Alat:</label>
                    <input type="text" id="searchNamaAlat" class="form-control search-input" placeholder="Masukkan nama alat...">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Cari Merek:</label>
                    <input type="text" id="searchMerek" class="form-control search-input" placeholder="Masukkan merek...">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Filter Status:</label>
                    <select id="filterStatus" class="form-control search-input">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                        <option value="rusak">Rusak</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Filter Lokasi:</label>
                    <select id="filterLokasi" class="form-control search-input">
                        <option value="">Semua Lokasi</option>
                        @foreach($peralatan->pluck('lokasi')->unique() as $lokasi)
                            <option value="{{ $lokasi }}">{{ $lokasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Main Data Table -->
        <div class="custom-card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                <h6 class="m-0 fw-bold" style="color: #333;">
                    Daftar Peralatan Pemeriksaan Umum
                </h6>
                <span class="badge custom-badge">{{ $peralatan->total() }} Total</span>
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
                    <table class="table table-hover mb-0" id="dataTable">
                        <thead>
                            <tr>
                                <th class="table-header" onclick="sortTable(0)">
                                    No
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(1)">
                                    Peralatan
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(2)">
                                    Merek & Model
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(3)">
                                    Tahun & Seri
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(4)">
                                    Harga Beli
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(5)">
                                    Biaya Operasional
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(6)">
                                    Biaya Perawatan
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(7)">
                                    Total Biaya
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(8)">
                                    Status
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(9)">
                                    Lokasi
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header">
                                    Maintenance
                                </th>
                                <th class="table-header">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peralatan as $alat)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration + ($peralatan->currentPage() - 1) * $peralatan->perPage() }}</td>
                                <td>
                                   <div class="equipment-info d-flex align-items-center">
    @if($alat->gambar)
        <img src="{{ asset('storage/' . $alat->gambar) }}" 
             alt="{{ $alat->nama_alat }}" 
             class="equipment-image me-3"
             onerror="this.src='{{ asset('images/no-image.png') }}'">
    @else
        <div class="equipment-image me-3 d-flex justify-content-center align-items-center" 
             style="width: 80px; height: 80px; background-color: #ddd; font-size: 20px; border-radius: 8px;">
            {{ strtoupper(substr($alat->nama_alat, 0, 2)) }}
        </div>
    @endif
    <div class="equipment-details">
        <div class="equipment-name">{{ $alat->nama_alat }}</div>
        <div class="equipment-meta">{{ $alat->penanggung_jawab }}</div>
    </div>
</div>

                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $alat->merek }}</div>
                                    <small class="text-muted">{{ $alat->model ?: '-' }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $alat->tahun_pembelian ?: '-' }}</div>
                                    <small class="text-muted">{{ $alat->nomor_seri ?: '-' }}</small>
                                </td>
                                <td class="price-text">{{ $alat->formatted_harga_beli }}</td>
                                <td class="price-text">{{ $alat->formatted_biaya_operasional }}</td>
                                <td class="price-text">{{ $alat->formatted_biaya_perawatan }}</td>
                                <td class="price-text fw-bold">{{ $alat->formatted_total_biaya }}</td>
                                <td>
                                    @if($alat->status === 'aktif')
                                        <span class="status-badge" style="background-color: #d4edda; color: #155724;">
                                            <i class="fas fa-check-circle me-1"></i>{{ $alat->status_text }}
                                        </span>
                                    @elseif($alat->status === 'tidak_aktif')
                                        <span class="status-badge" style="background-color: #f8d7da; color: #721c24;">
                                            <i class="fas fa-times-circle me-1"></i>{{ $alat->status_text }}
                                        </span>
                                    @elseif($alat->status === 'rusak')
                                        <span class="status-badge" style="background-color: #f8d7da; color: #721c24;">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $alat->status_text }}
                                        </span>
                                    @else
                                        <span class="status-badge" style="background-color: #fff3cd; color: #856404;">
                                            <i class="fas fa-tools me-1"></i>{{ $alat->status_text }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $alat->lokasi }}</td>
                                <td>
                                    @if($alat->tanggal_maintenance_selanjutnya)
                                        <div class="maintenance-badge {{ $alat->is_maintenance_due ? 'bg-warning text-dark' : 'bg-secondary text-white' }}">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $alat->tanggal_maintenance_selanjutnya->format('d/m/Y') }}
                                        </div>
                                        @if($alat->is_maintenance_due)
                                            <small class="text-warning">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Segera
                                            </small>
                                        @endif
                                    @else
                                        <span class="maintenance-badge bg-light text-muted">
                                            <i class="fas fa-minus me-1"></i>Tidak terjadwal
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton{{ $alat->id }}" 
                                                data-bs-toggle="dropdown" aria-expanded="false" 
                                                style="background-color: var(--primary-green); color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px;">
                                            <i class="fas fa-cog me-1"></i> Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $alat->id }}" style="min-width: 150px;">
                                            <!-- Detail Button -->
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.biaya-peralatan.show', ['kategori' => 'pemeriksaan-umum', 'id' => $alat->id]) }}">
                                                    <i class="fas fa-eye me-2 text-primary"></i> Lihat Detail
                                                </a>
                                            </li>
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            
                                            <!-- Edit Button -->
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.biaya-peralatan.edit', ['kategori' => 'pemeriksaan-umum', 'id' => $alat->id]) }}">
                                                    <i class="fas fa-edit me-2 text-warning"></i> Edit
                                                </a>
                                            </li>
                                            
                                            <!-- Update Status Button -->
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#statusModal{{ $alat->id }}">
                                                    <i class="fas fa-sync-alt me-2 text-info"></i> Update Status
                                                </a>
                                            </li>
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            
                                            <!-- Delete Button -->
                                            <li>
                                                <form action="{{ route('admin.biaya-peralatan.destroy', ['kategori' => 'pemeriksaan-umum', 'id' => $alat->id]) }}" method="POST" class="d-inline w-100" 
                                                      onsubmit="return confirm('Yakin ingin menghapus peralatan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash me-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Status Update Modal -->
                            <div class="modal fade" id="statusModal{{ $alat->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $alat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="statusModalLabel{{ $alat->id }}">Update Status Peralatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.biaya-peralatan.update-status', ['kategori' => 'pemeriksaan-umum', 'id' => $alat->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="status{{ $alat->id }}" class="form-label">Status</label>
                                                    <select class="form-select" id="status{{ $alat->id }}" name="status" required>
                                                        <option value="aktif" {{ $alat->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="tidak_aktif" {{ $alat->status === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                        <option value="rusak" {{ $alat->status === 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                        <option value="maintenance" {{ $alat->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Update Status</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="12">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-stethoscope"></i>
                                        </div>
                                        <p class="mb-0">Belum ada peralatan pemeriksaan umum yang terdaftar</p>
                                        <small class="text-muted">Tambah peralatan pertama dengan mengklik tombol "Tambah Peralatan"</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($peralatan->hasPages())
                    <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                        {{ $peralatan->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Auto dismiss alerts after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.auto-dismiss');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 3000);
            });
        });

        // Search functionality
        document.getElementById('searchNamaAlat').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('searchMerek').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('filterStatus').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('filterLokasi').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchNamaAlat = document.getElementById('searchNamaAlat').value.toLowerCase();
            const searchMerek = document.getElementById('searchMerek').value.toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.toLowerCase();
            const filterLokasi = document.getElementById('filterLokasi').value.toLowerCase();
            
            const table = document.getElementById('dataTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    const namaAlat = cells[1].textContent.toLowerCase();
                    const merek = cells[2].textContent.toLowerCase();
                    const status = cells[8].textContent.toLowerCase();
                    const lokasi = cells[9].textContent.toLowerCase();

                    const showRow = (
                        (searchNamaAlat === '' || namaAlat.includes(searchNamaAlat)) &&
                        (searchMerek === '' || merek.includes(searchMerek)) &&
                        (filterStatus === '' || status.includes(filterStatus)) &&
                        (filterLokasi === '' || lokasi.includes(filterLokasi))
                    );

                    rows[i].style.display = showRow ? '' : 'none';
                }
            }
        }

        // Table sorting
        let sortDirection = {};

        function sortTable(columnIndex) {
            const table = document.getElementById('dataTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const rows = Array.from(tbody.getElementsByTagName('tr'));
            
            // Skip if no data rows
            if (rows.length === 0 || (rows.length === 1 && rows[0].cells.length === 1)) {
                return;
            }

            // Determine sort direction
            const currentDirection = sortDirection[columnIndex] || 'asc';
            const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            sortDirection[columnIndex] = newDirection;

            // Update sort icons
            const headers = table.getElementsByClassName('sort-icon');
            for (let i = 0; i < headers.length; i++) {
                headers[i].className = 'fas fa-sort sort-icon';
            }
            
            const currentHeader = table.getElementsByClassName('sort-icon')[columnIndex];
            if (currentHeader) {
                currentHeader.className = newDirection === 'asc' ? 'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';
            }

            // Sort rows
            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].textContent.trim();
                let bValue = b.cells[columnIndex].textContent.trim();

                // Handle numeric sorting for specific columns
                if (columnIndex === 0) { // No column
                    aValue = parseInt(aValue) || 0;
                    bValue = parseInt(bValue) || 0;
                } else if (columnIndex >= 4 && columnIndex <= 7) { // Price columns
                    aValue = parseFloat(aValue.replace(/[^\d,]/g, '').replace(',', '.')) || 0;
                    bValue = parseFloat(bValue.replace(/[^\d,]/g, '').replace(',', '.')) || 0;
                } else if (columnIndex === 3) { // Year column
                    aValue = parseInt(aValue) || 0;
                    bValue = parseInt(bValue) || 0;
                }

                if (aValue < bValue) {
                    return newDirection === 'asc' ? -1 : 1;
                }
                if (aValue > bValue) {
                    return newDirection === 'asc' ? 1 : -1;
                }
                return 0;
            });

            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));
        }
    </script>
</x-admin-layout>
{{-- resources/views/admin/biayaperalatan/radiologi.blade.php --}}
<x-admin-layout title="Kelola Peralatan Radiologi">
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
        
        .status-aktif {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-tidak-aktif {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-rusak {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-maintenance {
            background-color: #fff3cd;
            color: #856404;
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
        
        .maintenance-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
            border-radius: 6px;
            padding: 0.5rem;
            font-size: 0.75rem;
        }
        
        .currency-text {
            font-weight: 600;
            color: #2e7d32;
        }
        
        .equipment-info {
            line-height: 1.4;
        }
        
        .equipment-brand {
            font-size: 0.85rem;
            color: var(--dark-gray);
        }
        
        .equipment-model {
            font-size: 0.8rem;
            color: #999;
        }
        
        .location-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 0.7rem;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Kelola Peralatan Radiologi</h1>
            <a href="{{ route('admin.biaya-peralatan.create', 'radiologi') }}" class="btn-add-equipment">
                <i class="fas fa-plus me-2"></i>Tambah Peralatan
            </a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: var(--primary-green); text-decoration: none;">Biaya Peralatan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Radiologi</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-x-ray"></i>
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
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-number">{{ $peralatan->where('status', 'rusak')->count() }}</div>
                    <div class="stat-label">Rusak</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="search-container">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Cari Nama Alat:</label>
                    <input type="text" id="searchNama" class="form-control search-input" placeholder="Masukkan nama alat...">
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
                        <option value="maintenance">Maintenance</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label fw-semibold">Cari Lokasi:</label>
                    <input type="text" id="searchLokasi" class="form-control search-input" placeholder="Masukkan lokasi...">
                </div>
            </div>
        </div>

        <!-- Main Data Table -->
        <div class="custom-card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                <h6 class="m-0 fw-bold" style="color: #333;">
                    Daftar Peralatan Radiologi
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
                                <th class="table-header">
                                    Gambar
                                </th>
                                <th class="table-header" onclick="sortTable(2)">
                                    Informasi Alat
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(3)">
                                    Spesifikasi
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(4)">
                                    Biaya
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(5)">
                                    Status
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(6)">
                                    Lokasi & PJ
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
                            @forelse($peralatan as $item)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration + ($peralatan->currentPage() - 1) * $peralatan->perPage() }}</td>
                                <td>
    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.png') }}" 
         alt="{{ $item->nama_alat }}" 
         class="equipment-image"
         onerror="this.src='{{ asset('images/no-image.png') }}'">
</td>

                                <td>
                                    <div class="equipment-info">
                                        <div class="fw-semibold">{{ $item->nama_alat }}</div>
                                        <div class="equipment-brand">{{ $item->merek }}</div>
                                        @if($item->model)
                                            <div class="equipment-model">{{ $item->model }}</div>
                                        @endif
                                        @if($item->nomor_seri)
                                            <small class="text-muted">SN: {{ $item->nomor_seri }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        @if($item->tahun_pembelian)
                                            <div><strong>Tahun:</strong> {{ $item->tahun_pembelian }}</div>
                                        @endif
                                        @if($item->umur_alat)
                                            <div><strong>Umur:</strong> {{ $item->umur_alat }} tahun</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="currency-text">{{ $item->formatted_harga_beli }}</div>
                                        <div class="text-muted">Operasional: {{ $item->formatted_biaya_operasional }}</div>
                                        <div class="text-muted">Perawatan: {{ $item->formatted_biaya_perawatan }}</div>
                                        <hr class="my-1">
                                        <div class="fw-bold currency-text">Total: {{ $item->formatted_total_biaya }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $item->status }}">
                                        @if($item->status === 'aktif')
                                            <i class="fas fa-check-circle me-1"></i>
                                        @elseif($item->status === 'maintenance')
                                            <i class="fas fa-tools me-1"></i>
                                        @elseif($item->status === 'rusak')
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                        @else
                                            <i class="fas fa-times-circle me-1"></i>
                                        @endif
                                        {{ $item->status_text }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="location-badge">{{ $item->lokasi }}</div>
                                        <div class="mt-1"><strong>PJ:</strong> {{ $item->penanggung_jawab }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        @if($item->tanggal_maintenance_terakhir)
                                            <div><strong>Terakhir:</strong> {{ $item->tanggal_maintenance_terakhir->format('d/m/Y') }}</div>
                                        @endif
                                        @if($item->tanggal_maintenance_selanjutnya)
                                            <div><strong>Selanjutnya:</strong> {{ $item->tanggal_maintenance_selanjutnya->format('d/m/Y') }}</div>
                                            @if($item->is_maintenance_due)
                                                <div class="maintenance-warning mt-1">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                                    Maintenance Due!
                                                </div>
                                            @endif
                                        @endif
                                    </div>
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
                                                <a class="dropdown-item" href="{{ route('admin.biaya-peralatan.show', ['kategori' => $kategori, 'id' => $item->id]) }}">
                                                    <i class="fas fa-eye me-2 text-primary"></i> Lihat Detail
                                                </a>
                                            </li>
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            
                                            <!-- Edit Button -->
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.biaya-peralatan.edit', ['kategori' => $kategori, 'id' => $item->id]) }}">
                                                    <i class="fas fa-edit me-2 text-warning"></i> Edit
                                                </a>
                                            </li>
                                            
                                            <!-- Update Status Button -->
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $item->id }}">
                                                    <i class="fas fa-sync me-2 text-info"></i> Update Status
                                                </a>
                                            </li>
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            
                                            <!-- Delete Button -->
                                            <li>
                                                <form action="{{ route('admin.biaya-peralatan.destroy', ['kategori' => $kategori, 'id' => $item->id]) }}" method="POST" class="d-inline w-100" 
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

                            <!-- Update Status Modal -->
                            <div class="modal fade" id="updateStatusModal{{ $item->id }}" tabindex="-1" aria-labelledby="updateStatusModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateStatusModalLabel{{ $item->id }}">Update Status Peralatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.biaya-peralatan.update-status', ['kategori' => $kategori, 'id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="status{{ $item->id }}" class="form-label">Status</label>
                                                    <select class="form-select" id="status{{ $item->id }}" name="status" required>
                                                        <option value="aktif" {{ $item->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="tidak_aktif" {{ $item->status === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                        <option value="maintenance" {{ $item->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                        <option value="rusak" {{ $item->status === 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                    </select>
                                                </div>
                                                <div class="alert alert-info">
                                                    <small>Peralatan: <strong>{{ $item->nama_alat }}</strong></small>
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
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-x-ray"></i>
                                        </div>
                                        <p class="mb-0">Belum ada peralatan radiologi yang terdaftar</p>
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
        document.getElementById('searchNama').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('searchMerek').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('filterStatus').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('searchLokasi').addEventListener('keyup', function() {
            filterTable();
        });

        function filterTable() {
            const searchNama = document.getElementById('searchNama').value.toLowerCase();
            const searchMerek = document.getElementById('searchMerek').value.toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.toLowerCase();
            const searchLokasi = document.getElementById('searchLokasi').value.toLowerCase();
            
            const table = document.getElementById('dataTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    const nama = cells[2].textContent.toLowerCase();
                    const status = cells[5].textContent.toLowerCase();
                    const lokasi = cells[6].textContent.toLowerCase();

                    const showRow = (
                        (searchNama === '' || nama.includes(searchNama)) &&
                        (searchMerek === '' || nama.includes(searchMerek)) &&
                        (filterStatus === '' || status.includes(filterStatus)) &&
                        (searchLokasi === '' || lokasi.includes(searchLokasi))
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

                // Handle numeric sorting for specific columns (No column)
                if (columnIndex === 0) {
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
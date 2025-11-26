<x-admin-layout title="Data Dokter">
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
        
        .dokter-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #333;
            border: 2px solid var(--border-gray);
        }
        
        .spesialisasi-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .jadwal-badge {
            display: inline-block;
            padding: 2px 6px;
            margin: 1px;
            border-radius: 8px;
            font-size: 0.65rem;
            font-weight: 500;
            background-color: #e8f5e8;
            color: #2e7d32;
        }
        
        .btn-add-dokter {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-add-dokter:hover {
            background-color: #028a1c;
            color: white;
            text-decoration: none;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Data Dokter</h1>
            <a href="{{ route('admin.data-dokter.create') }}" class="btn-add-dokter">
                <i class="fas fa-plus me-2"></i>Tambah Dokter
            </a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Dokter</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="stat-number">{{ $dokters->count() }}</div>
                    <div class="stat-label">Total Dokter</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $dokters->where('status_aktif', true)->count() }}</div>
                    <div class="stat-label">Dokter Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-number">{{ $dokters->filter(function($dokter) { return !empty($dokter->jadwal_praktik); })->count() }}</div>
                    <div class="stat-label">Jadwal Tersedia</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="stat-number">{{ $dokters->pluck('spesialisasi')->unique()->count() }}</div>
                    <div class="stat-label">Spesialisasi</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="search-container">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Cari Nama:</label>
                    <input type="text" id="searchNama" class="form-control search-input" placeholder="Masukkan nama dokter...">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Cari Spesialisasi:</label>
                    <input type="text" id="searchSpesialisasi" class="form-control search-input" placeholder="Masukkan spesialisasi...">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Filter Status:</label>
                    <select id="filterStatus" class="form-control search-input">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Main Data Table -->
        <div class="custom-card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                <h6 class="m-0 fw-bold" style="color: #333;">
                    Daftar Dokter
                </h6>
                <span class="badge custom-badge">{{ $dokters->count() }} Total</span>
            </div>
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3 auto-dismiss" role="alert">
                        {{ session('success') }}
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
                                    Dokter
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(2)">
                                    Spesialisasi
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(3)">
                                    No. STR
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header">
                                    Kontak
                                </th>
                                <th class="table-header">
                                    Jadwal Praktik
                                </th>
                                <th class="table-header" onclick="sortTable(6)">
                                    Status
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokters as $index => $dokter)
                            <tr>
                                <td class="fw-semibold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($dokter->foto)
                                            <img src="{{ asset('storage/' . $dokter->foto) }}" 
                                                 alt="Foto {{ $dokter->nama_dokter }}" 
                                                 class="dokter-avatar me-3">
                                        @else
                                            <div class="dokter-avatar me-3">
                                                {{ strtoupper(substr($dokter->nama_dokter, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-semibold">{{ $dokter->nama_dokter }}</div>
                                            <small class="text-muted">{{ $dokter->jenis_kelamin }} • {{ \Carbon\Carbon::parse($dokter->tanggal_lahir)->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="spesialisasi-badge" style="background-color: #e3f2fd; color: #1976d2;">
                                        {{ $dokter->spesialisasi }}
                                    </span>
                                </td>
                                <td class="fw-semibold">{{ $dokter->no_str }}</td>
                                <td>
                                    <div>
                                        <small class="d-block"><i class="fas fa-phone text-success me-1"></i>{{ $dokter->no_telepon }}</small>
                                        <small class="d-block text-muted"><i class="fas fa-envelope me-1"></i>{{ $dokter->email }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($dokter->jadwal_praktik && !empty($dokter->jadwal_praktik))
                                        <div>
                                            @php
                                                $jadwal = is_string($dokter->jadwal_praktik) ? json_decode($dokter->jadwal_praktik, true) : $dokter->jadwal_praktik;
                                                $hariNames = [
                                                    'senin' => 'Sen',
                                                    'selasa' => 'Sel',
                                                    'rabu' => 'Rab',
                                                    'kamis' => 'Kam',
                                                    'jumat' => 'Jum',
                                                    'sabtu' => 'Sab',
                                                    'minggu' => 'Min'
                                                ];
                                            @endphp
                                            @if(is_array($jadwal) && count($jadwal) > 0)
                                                @foreach($jadwal as $hari => $waktu)
                                                    <span class="jadwal-badge">
                                                        {{ $hariNames[$hari] ?? ucfirst($hari) }}: {{ $waktu['jam_mulai'] ?? '' }}-{{ $waktu['jam_selesai'] ?? '' }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <small class="text-muted">Belum diatur</small>
                                            @endif
                                        </div>
                                    @else
                                        <small class="text-muted">Belum diatur</small>
                                    @endif
                                </td>
                                <td>
                                    @if($dokter->status_aktif)
                                        <span class="status-badge" style="background-color: var(--primary-green); color: white;">
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        </span>
                                    @else
                                        <span class="status-badge" style="background-color: #dc3545; color: white;">
                                            <i class="fas fa-times-circle me-1"></i>Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton{{ $dokter->id_dokter }}" 
                                                data-bs-toggle="dropdown" aria-expanded="false" 
                                                style="background-color: var(--primary-green); color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px;">
                                            <i class="fas fa-cog me-1"></i> Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $dokter->id_dokter }}" style="min-width: 150px;">
                                            <!-- Detail Button -->
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.data-dokter.show', $dokter->id_dokter) }}">
                                                    <i class="fas fa-eye me-2 text-primary"></i> Lihat Detail
                                                </a>
                                            </li>
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            
                                            <!-- Edit Button -->
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.data-dokter.edit', $dokter->id_dokter) }}">
                                                    <i class="fas fa-edit me-2 text-warning"></i> Edit
                                                </a>
                                            </li>
                                            
                                            <li><hr class="dropdown-divider"></li>
                                            
                                            <!-- Delete Button -->
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" onclick="confirmDelete({{ $dokter->id_dokter }})">
                                                    <i class="fas fa-trash me-2"></i> Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <p class="mb-0">Belum ada data dokter</p>
                                        <small class="text-muted">Silakan tambah data dokter untuk memulai</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data dokter ini?</p>
                    <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
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

        document.getElementById('searchSpesialisasi').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('filterStatus').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchNama = document.getElementById('searchNama').value.toLowerCase();
            const searchSpesialisasi = document.getElementById('searchSpesialisasi').value.toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.toLowerCase();
            
            const table = document.getElementById('dataTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    const nama = cells[1].textContent.toLowerCase();
                    const spesialisasi = cells[2].textContent.toLowerCase();
                    const status = cells[6].textContent.toLowerCase();

                    const showRow = (
                        (searchNama === '' || nama.includes(searchNama)) &&
                        (searchSpesialisasi === '' || spesialisasi.includes(searchSpesialisasi)) &&
                        (filterStatus === '' || status.includes(filterStatus))
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

        function confirmDelete(dokterId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `{{ route('admin.data-dokter.destroy', '') }}/${dokterId}`;
            
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Initialize DataTable if you're using it
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 25,
                "responsive": true
            });
        });
    </script>

</x-admin-layout>
{{-- resources/views/admin/data-perawat/index.blade.php --}}
<x-admin-layout title="Data Perawat">
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
        
        .perawat-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-gray);
        }
        
        .perawat-placeholder {
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
        
        .role-badge {
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
        
        .btn-add-perawat {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-add-perawat:hover {
            background-color: #028a1c;
            color: white;
            text-decoration: none;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Data Perawat</h1>
            <a href="{{ route('admin.data-perawat.create') }}" class="btn-add-perawat">
                <i class="fas fa-plus me-2"></i>Tambah Perawat
            </a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Perawat</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <div class="stat-number">{{ $perawats->count() }}</div>
                    <div class="stat-label">Total Perawat</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-number">{{ $perawats->where('status_aktif', true)->count() }}</div>
                    <div class="stat-label">Perawat Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-venus"></i>
                    </div>
                    <div class="stat-number">{{ $perawats->where('jenis_kelamin', 'Perempuan')->count() }}</div>
                    <div class="stat-label">Perempuan</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-mars"></i>
                    </div>
                    <div class="stat-number">{{ $perawats->where('jenis_kelamin', 'Laki-laki')->count() }}</div>
                    <div class="stat-label">Laki-laki</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="search-container">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Cari Nama:</label>
                    <input type="text" id="searchNama" class="form-control search-input" placeholder="Masukkan nama perawat...">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Filter Pendidikan:</label>
                    <select id="filterPendidikan" class="form-control search-input">
                        <option value="">Semua Pendidikan</option>
                        <option value="D3 Keperawatan">D3 Keperawatan</option>
                        <option value="S1 Keperawatan">S1 Keperawatan</option>
                        <option value="S2 Keperawatan">S2 Keperawatan</option>
                    </select>
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

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Data Table -->
        <div class="custom-card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                <h6 class="m-0 fw-bold" style="color: #333;">
                    <i class="fas fa-users"></i> Daftar Perawat
                </h6>
                <span class="badge custom-badge">{{ $perawats->count() }} Total</span>
            </div>
            <div class="card-body p-0">
                @if($perawats->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="perawatTable">
                            <thead>
                                <tr>
                                    <th class="table-header" onclick="sortTable(0)">
                                        No
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(1)">
                                        Nama Perawat
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(2)">
                                        Pendidikan
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(3)">
                                        No. STR
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header">
                                        Kontak
                                    </th>
                                    <th class="table-header" onclick="sortTable(5)">
                                        Status
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perawats as $index => $perawat)
                                <tr>
                                    <td class="fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($perawat->foto)
                                                <img src="{{ asset('storage/' . $perawat->foto) }}" 
                                                     alt="Foto {{ $perawat->nama_perawat }}" 
                                                     class="perawat-avatar me-3">
                                            @else
                                                <div class="perawat-placeholder me-3">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $perawat->nama_perawat }}</div>
                                                <small class="text-muted">
                                                    <i class="fas fa-venus-mars"></i> {{ $perawat->jenis_kelamin }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="role-badge" style="background-color: #e3f2fd; color: #1976d2;">
                                            {{ $perawat->tingkat_pendidikan }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold">{{ $perawat->no_str }}</td>
                                    <td>
                                        <small>
                                            <i class="fas fa-phone text-success"></i> {{ $perawat->no_telepon }}<br>
                                            <i class="fas fa-envelope text-primary"></i> {{ $perawat->email }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($perawat->status_aktif)
                                            <span class="status-badge" style="background-color: var(--primary-green); color: white;">
                                                <i class="fas fa-check"></i> Aktif
                                            </span>
                                        @else
                                            <span class="status-badge" style="background-color: #dc3545; color: white;">
                                                <i class="fas fa-times"></i> Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton{{ $perawat->id_perawat }}" 
                                                    data-bs-toggle="dropdown" aria-expanded="false" 
                                                    style="background-color: var(--primary-green); color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px;">
                                                <i class="fas fa-cog me-1"></i> Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $perawat->id_perawat }}" style="min-width: 150px;">
                                                <!-- Detail Button -->
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.data-perawat.show', $perawat->id_perawat) }}">
                                                        <i class="fas fa-eye me-2 text-primary"></i> Lihat Detail
                                                    </a>
                                                </li>
                                                
                                                <li><hr class="dropdown-divider"></li>
                                                
                                                <!-- Edit Button -->
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.data-perawat.edit', $perawat->id_perawat) }}">
                                                        <i class="fas fa-edit me-2 text-warning"></i> Edit
                                                    </a>
                                                </li>
                                                
                                                <li><hr class="dropdown-divider"></li>
                                                
                                                <!-- Delete Button -->
                                                <li>
                                                    <button type="button" class="dropdown-item text-danger" 
                                                            onclick="confirmDelete({{ $perawat->id_perawat }}, '{{ $perawat->nama_perawat }}')">
                                                        <i class="fas fa-trash me-2"></i> Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Hidden Delete Form -->
                                        <form id="delete-form-{{ $perawat->id_perawat }}" 
                                              action="{{ route('admin.data-perawat.destroy', $perawat->id_perawat) }}" 
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <p class="mb-0">Belum ada data perawat</p>
                        <small class="text-muted">Silakan tambah data perawat terlebih dahulu</small>
                        <br><br>
                        <a href="{{ route('admin.data-perawat.create') }}" class="btn-add-perawat">
                            <i class="fas fa-plus"></i> Tambah Perawat Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data perawat:</p>
                    <p><strong id="perawatName"></strong></p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Data yang dihapus tidak dapat dikembalikan!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash"></i> Ya, Hapus
                    </button>
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

        document.getElementById('filterPendidikan').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('filterStatus').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchNama = document.getElementById('searchNama').value.toLowerCase();
            const filterPendidikan = document.getElementById('filterPendidikan').value.toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.toLowerCase();
            
            const table = document.getElementById('perawatTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    const nama = cells[1].textContent.toLowerCase();
                    const pendidikan = cells[2].textContent.toLowerCase();
                    const status = cells[5].textContent.toLowerCase();

                    const showRow = (
                        (searchNama === '' || nama.includes(searchNama)) &&
                        (filterPendidikan === '' || pendidikan.includes(filterPendidikan)) &&
                        (filterStatus === '' || status.includes(filterStatus))
                    );

                    rows[i].style.display = showRow ? '' : 'none';
                }
            }
        }

        // Table sorting
        let sortDirection = {};

        function sortTable(columnIndex) {
            const table = document.getElementById('perawatTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const rows = Array.from(tbody.getElementsByTagName('tr'));
            
            // Skip if no data rows
            if (rows.length === 0) {
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

        // Confirm delete function
        function confirmDelete(id, nama) {
            document.getElementById('perawatName').textContent = nama;
            
            document.getElementById('confirmDeleteBtn').onclick = function() {
                document.getElementById('delete-form-' + id).submit();
            };
            
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
</x-admin-layout>
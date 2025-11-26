    <x-admin-layout title="Riwayat Surat Keterangan">
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
            
            .btn-add-surat {
                background-color: var(--primary-green);
                color: white;
                border: none;
                padding: 0.6rem 1rem;
                border-radius: 6px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.2s;
                margin-right: 0.5rem;
            }
            
            .btn-add-surat:hover {
                background-color: #028a1c;
                color: white;
                text-decoration: none;
            }
            
            .btn-add-surat.btn-warning {
                background-color: #ffc107;
                color: #212529;
            }
            
            .btn-add-surat.btn-warning:hover {
                background-color: #e0a800;
                color: #212529;
            }
            
            .status-badge {
                padding: 4px 8px;
                border-radius: 12px;
                font-size: 0.75rem;
                font-weight: 500;
            }
            
            .jenis-surat-badge {
                display: inline-flex;
                align-items: center;
                padding: 4px 8px;
                border-radius: 12px;
                font-size: 0.75rem;
                font-weight: 500;
            }
            
            .status-indicator {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 6px;
            }
            
            .status-sehat {
                background-color: #28a745;
            }
            
            .status-sakit {
                background-color: #dc3545;
            }
            
            .user-info {
                display: flex;
                align-items: center;
            }
            
            .user-avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background-color: #f8f9fa;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                color: #333;
                border: 2px solid var(--border-gray);
                margin-right: 8px;
            }
        </style>

        <div class="container-fluid">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 page-title">Riwayat Surat Keterangan</h1>
                <div>
                    <a href="{{ route('admin.suratketerangan.suratsehat') }}" class="btn-add-surat">
                        <i class="fas fa-plus me-2"></i>Surat Sehat
                    </a>
                    <a href="{{ route('admin.suratketerangan.suratsakit') }}" class="btn-add-surat btn-warning">
                        <i class="fas fa-plus me-2"></i>Surat Sakit
                    </a>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Surat Keterangan</li>
                </ol>
            </nav>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-number">{{ $history->where('jenis_surat', 'sehat')->count() }}</div>
                        <div class="stat-label">Surat Sehat</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="stat-number">{{ $history->where('jenis_surat', 'sakit')->count() }}</div>
                        <div class="stat-label">Surat Sakit</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div class="stat-number">{{ $history->total() }}</div>
                        <div class="stat-label">Total Surat</div>
                    </div>
                </div>
            </div>

            <!-- Search Container -->
            <div class="search-container">
                <form method="GET" action="{{ route('admin.suratketerangan.riwayat') }}" id="filterForm">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label fw-semibold">Jenis Surat:</label>
                            <select name="jenis_surat" id="jenis_surat" class="form-control search-input">
                                <option value="">Semua Jenis</option>
                                <option value="sehat" {{ request('jenis_surat') == 'sehat' ? 'selected' : '' }}>Surat Sehat</option>
                                <option value="sakit" {{ request('jenis_surat') == 'sakit' ? 'selected' : '' }}>Surat Sakit</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label fw-semibold">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                                class="form-control search-input" value="{{ request('tanggal_mulai') }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label fw-semibold">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" 
                                class="form-control search-input" value="{{ request('tanggal_selesai') }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label fw-semibold">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="fas fa-search me-1"></i> Filter
                                </button>
                                <a href="{{ route('admin.suratketerangan.riwayat') }}" class="btn btn-secondary flex-fill">
                                    <i class="fas fa-refresh me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Main Data Table -->
            <div class="custom-card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                    <h6 class="m-0 fw-bold" style="color: #333;">
                        Daftar Riwayat Pencetakan Surat
                        @if(request()->hasAny(['jenis_surat', 'tanggal_mulai', 'tanggal_selesai']))
                            <small class="ms-2 text-muted">(Hasil Filter)</small>
                        @endif
                    </h6>
                    <span class="badge custom-badge">{{ $history->total() }} Total</span>
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
                                        Jenis Surat
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(2)">
                                        Tanggal Cetak
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(3)">
                                        Dicetak Oleh
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header">
                                        Status
                                    </th>
                                    <th class="table-header" onclick="sortTable(5)">
                                        Waktu Cetak
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($history as $index => $item)
                                <tr>
                                    <td class="fw-semibold">{{ $history->firstItem() + $index }}</td>
                                    <td>
                                        @if($item->jenis_surat === 'sehat')
                                            <span class="jenis-surat-badge" style="background-color: #e8f5e8; color: #2e7d32;">
                                                <span class="status-indicator status-sehat"></span>
                                                Surat Sehat
                                            </span>
                                        @else
                                            <span class="jenis-surat-badge" style="background-color: #ffebee; color: #c62828;">
                                                <span class="status-indicator status-sakit"></span>
                                                Surat Sakit
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar me-2 text-muted"></i>
                                            <span>{{ $item->printed_at->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($item->user->name ?? 'SYS', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $item->user->name ?? 'System' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background-color: var(--primary-green); color: white;">
                                            <i class="fas fa-print me-1"></i>Tercetak
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock me-2 text-muted"></i>
                                            <span>{{ $item->printed_at->format('H:i:s') }}</span>
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
                                                <li>
                                                    <button type="button" class="dropdown-item text-danger btn-delete" 
                                                            data-id="{{ $item->id }}" 
                                                            data-jenis="{{ $item->jenis_surat }}">
                                                        <i class="fas fa-trash me-2"></i> Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="fas fa-file-medical"></i>
                                            </div>
                                            <p class="mb-0">
                                                @if(request()->hasAny(['jenis_surat', 'tanggal_mulai', 'tanggal_selesai']))
                                                    Tidak ada riwayat yang sesuai dengan filter yang dipilih
                                                @else
                                                    Belum ada riwayat surat keterangan
                                                @endif
                                            </p>
                                            <small class="text-muted">
                                                @if(request()->hasAny(['jenis_surat', 'tanggal_mulai', 'tanggal_selesai']))
                                                    Coba ubah filter atau reset untuk melihat semua data
                                                @else
                                                    Mulai dengan membuat surat sehat atau surat sakit
                                                @endif
                                            </small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($history->hasPages())
                        <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                            {{ $history->appends(request()->query())->links() }}
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

            // Auto submit form when filter changes
            document.getElementById('jenis_surat').addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });

            document.getElementById('tanggal_mulai').addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });

            document.getElementById('tanggal_selesai').addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });

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

            // Delete history functionality
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-delete') || e.target.closest('.btn-delete')) {
                    const button = e.target.classList.contains('btn-delete') ? e.target : e.target.closest('.btn-delete');
                    const id = button.dataset.id;
                    const jenis = button.dataset.jenis;
                    const row = button.closest('tr');

                    if (confirm(`Yakin ingin menghapus riwayat surat ${jenis}?`)) {
                        // Create form and submit
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ route('admin.suratketerangan.delete.history', '') }}/${id}`;
                        
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        
                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);
                        form.submit();
                    }
                }
            });
        </script>
    </x-admin-layout>
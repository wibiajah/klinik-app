<x-admin-layout title="Laporan Pemeriksaan Umum">
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
        
        .btn-export {
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
        
        .btn-export:hover {
            background-color: #028a1c;
            color: white;
            text-decoration: none;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-dikonfirmasi {
            background-color: #cff4fc;
            color: #0a58ca;
        }
        
        .status-sedang-diperiksa {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-selesai {
            background-color: #d1e7dd;
            color: #0a3622;
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
        
        .rujukan-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .dengan-rujukan {
            background-color: #e8f5e8;
            color: #2e7d32;
        }
        
        .tanpa-rujukan {
            background-color: #f3f4f6;
            color: #6b7280;
        }
        
        .lpk-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .lpk-sentosa {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .lpk-umum {
            background-color: #f9fafb;
            color: #374151;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Laporan Pemeriksaan Umum</h1>
            <div>
           <button onclick="window.print()" class="btn-export">
    <i class="fas fa-print me-2"></i>Cetak Laporan
</button>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Pemeriksaan Umum</li>
            </ol>
        </nav>

        <!-- Period Info -->
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Periode Laporan:</strong> {{ $judul_periode }}
        </div>

       

        <!-- Filter Container -->
        <div class="search-container">
            <form method="GET" action="{{ route('admin.laporanklinik.pemeriksaan-umum') }}" id="filterForm">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label class="form-label fw-semibold">Periode:</label>
                        <select name="periode" id="periode" class="form-control search-input">
                            <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="custom" {{ $periode == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2" id="tanggal_mulai_container" style="{{ $periode != 'custom' ? 'display: none;' : '' }}">
                        <label class="form-label fw-semibold">Tanggal Mulai:</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                               class="form-control search-input" value="{{ $tanggal_mulai }}">
                    </div>
                    <div class="col-md-3 mb-2" id="tanggal_selesai_container" style="{{ $periode != 'custom' ? 'display: none;' : '' }}">
                        <label class="form-label fw-semibold">Tanggal Selesai:</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" 
                               class="form-control search-input" value="{{ $tanggal_selesai }}">
                    </div>
                    <div class="col-md-3 mb-2">
    <label class="form-label fw-semibold">Jenis Pasien:</label>
    <select name="filter_pasien" class="form-control search-input">
        <option value="semua" {{ $filter_pasien == 'semua' ? 'selected' : '' }}>Semua</option>
        <option value="lpk_sentosa" {{ $filter_pasien == 'lpk_sentosa' ? 'selected' : '' }}>LPK Sentosa</option>
        <option value="umum" {{ $filter_pasien == 'umum' ? 'selected' : '' }}>Umum</option>
    </select>
</div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label fw-semibold">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.laporanklinik.pemeriksaan-umum') }}" class="btn btn-secondary flex-fill">
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
                    Data Pemeriksaan Umum - {{ $judul_periode }}
                </h6>
                <span class="badge custom-badge">{{ $pemeriksaan_umum->total() }} Total</span>
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
                                    No Antrian
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(2)">
                                    Nama Pasien
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(3)">
                                    Tanggal Transfer
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header">
                                    Status
                                </th>
                                <th class="table-header">
                                    Jenis Kelamin
                                </th>
                                <th class="table-header">
                                    Rujukan
                                </th>
                                <th class="table-header">
                                    Jenis Pasien
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemeriksaan_umum as $index => $item)
                            <tr>
                                <td class="fw-semibold">{{ $pemeriksaan_umum->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $item->no_antrian ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($item->nama ?? 'N/A', 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $item->nama ?? 'Tidak ada nama' }}</div>
                                            <small class="text-muted">{{ $item->nik ?? 'Tidak ada NIK' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar me-2 text-muted"></i>
                                        <span>{{ $item->tgl_transfer ? \Carbon\Carbon::parse($item->tgl_transfer)->format('d/m/Y') : '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @switch($item->status_pemeriksaan)
                                        @case('menunggu')
                                            <span class="status-badge status-menunggu">
                                                <i class="fas fa-hourglass-half me-1"></i>Menunggu
                                            </span>
                                            @break
                                        @case('dikonfirmasi')
                                            <span class="status-badge status-dikonfirmasi">
                                                <i class="fas fa-check-circle me-1"></i>Dikonfirmasi
                                            </span>
                                            @break
                                        @case('sedang_diperiksa')
                                            <span class="status-badge status-sedang-diperiksa">
                                                <i class="fas fa-user-md me-1"></i>Sedang Diperiksa
                                            </span>
                                            @break
                                        @case('selesai')
                                            <span class="status-badge status-selesai">
                                                <i class="fas fa-clipboard-check me-1"></i>Selesai
                                            </span>
                                            @break
                                        @default
                                            <span class="status-badge status-menunggu">
                                                <i class="fas fa-question me-1"></i>{{ ucfirst($item->status_pemeriksaan ?? 'Tidak diketahui') }}
                                            </span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($item->jenis_kelamin == 'L')
                                        <i class="fas fa-mars text-primary me-1"></i>Laki-laki
                                    @elseif($item->jenis_kelamin == 'P')
                                        <i class="fas fa-venus text-danger me-1"></i>Perempuan
                                    @else
                                        <i class="fas fa-question text-muted me-1"></i>Tidak diketahui
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($item->rujukan))
                                        <span class="rujukan-badge dengan-rujukan">
                                            <i class="fas fa-notes-medical me-1"></i>Ya
                                        </span>
                                    @else
                                        <span class="rujukan-badge tanpa-rujukan">
                                            <i class="fas fa-user-friends me-1"></i>Tidak
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->is_lpk_sentosa)
                                        <span class="lpk-badge lpk-sentosa">
                                            <i class="fas fa-building me-1"></i>LPK Sentosa
                                        </span>
                                    @else
                                        <span class="lpk-badge lpk-umum">
                                            <i class="fas fa-users me-1"></i>Umum
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-file-medical"></i>
                                        </div>
                                        <p class="mb-0">Tidak ada data pemeriksaan umum untuk periode ini</p>
                                        <small class="text-muted">Coba ubah periode atau tanggal untuk melihat data lain</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pemeriksaan_umum->hasPages())
                    <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                        {{ $pemeriksaan_umum->appends(request()->query())->links() }}
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

        // Show/hide custom date inputs
       

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
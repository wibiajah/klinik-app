<x-admin-layout title="Laporan Laboratorium">
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
        
        .btn-export.btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-export.btn-secondary:hover {
            background-color: #545b62;
            color: white;
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
        
        .status-sedang-diperiksa {
            background-color: #cce5ff;
            color: #0066cc;
        }
        
        .status-selesai {
            background-color: #d4edda;
            color: #155724;
        }
        
        .jenis-kelamin-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .lpk-badge {
            background-color: #e8f5e8;
            color: #2e7d32;
        }
        
        .umum-badge {
            background-color: #fff3e0;
            color: #ef6c00;
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
        
        .periode-title {
            color: var(--primary-green);
            font-weight: 600;
        }
        
        .dokter-stats {
            background: white;
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .dokter-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .dokter-item:last-child {
            border-bottom: none;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Laporan Laboratorium</h1>
            <div>
              <div class="export-buttons mb-3">
    <button onclick="window.print()" class="btn-export">
    <i class="fas fa-print me-2"></i>Cetak Laporan
</button>
</div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: var(--primary-green); text-decoration: none;">Laporan Klinik</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Laboratorium</li>
            </ol>
        </nav>

        <!-- Periode Info -->
        <div class="alert alert-info mb-4">
            <i class="fas fa-calendar me-2"></i>
            <strong>Periode Laporan:</strong> <span class="periode-title">{{ $judul_periode }}</span>
        </div>

        

        <!-- Top Dokter Stats -->
        @if($dokter_stats->count() > 0)
        <div class="dokter-stats mb-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-user-md me-2"></i>Top 5 Dokter Pemeriksa</h6>
            @foreach($dokter_stats as $dokter)
            <div class="dokter-item">
                <div class="d-flex align-items-center">
                    <div class="user-avatar me-3">
                        {{ strtoupper(substr($dokter->dokter_pemeriksa, 0, 2)) }}
                    </div>
                    <div>
                        <div class="fw-semibold">{{ $dokter->dokter_pemeriksa }}</div>
                        <small class="text-muted">Dokter Pemeriksa</small>
                    </div>
                </div>
                <span class="badge custom-badge">{{ $dokter->total }} pasien</span>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Filter Container -->
        <div class="search-container">
            <form method="GET" action="{{ route('admin.laporanklinik.laboratorium') }}" id="filterForm">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label class="form-label fw-semibold">Periode:</label>
                        <select name="periode" id="periode" class="form-control search-input">
                            <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="custom" {{ $periode == 'custom' ? 'selected' : '' }}>Pilih Tanggal</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2" id="tanggal_mulai_container" style="{{ $periode == 'custom' ? '' : 'display: none;' }}">
                        <label class="form-label fw-semibold">Tanggal Mulai:</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                               class="form-control search-input" value="{{ $tanggal_mulai }}">
                    </div>
                    <div class="col-md-3 mb-2" id="tanggal_selesai_container" style="{{ $periode == 'custom' ? '' : 'display: none;' }}">
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
                            <a href="{{ route('admin.laporanklinik.laboratorium') }}" class="btn btn-secondary flex-fill">
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
                    Data Laboratorium - {{ $judul_periode }}
                </h6>
                <span class="badge custom-badge">{{ $laboratorium->total() }} Total</span>
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
                                <th class="table-header">
                                    Jenis Kelamin
                                </th>
                                <th class="table-header" onclick="sortTable(4)">
                                    Tanggal Pemeriksaan
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header">
                                    Status
                                </th>
                                <th class="table-header">
                                    Dokter Pemeriksa
                                </th>
                                <th class="table-header">
                                    Tipe Pasien
                                </th>
                                <th class="table-header">
                                    Hasil Lab
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laboratorium as $index => $item)
                            <tr>
                                <td class="fw-semibold">{{ $laboratorium->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-hashtag me-2 text-muted"></i>
                                        <span class="fw-semibold">{{ $item->no_antrian }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-info">
                                       
                                        <div>
                                            <div class="fw-semibold">{{ $item->nama ?? 'Tidak Ada Nama' }}</div>
                                            <small class="text-muted">{{ $item->umur ?? '-' }} tahun</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($item->jenis_kelamin === 'L')
                                        <span class="jenis-kelamin-badge" style="background-color: #e3f2fd; color: #1976d2;">
                                            <i class="fas fa-male me-1"></i>Laki-laki
                                        </span>
                                    @else
                                        <span class="jenis-kelamin-badge" style="background-color: #fce4ec; color: #c2185b;">
                                            <i class="fas fa-female me-1"></i>Perempuan
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar me-2 text-muted"></i>
                                        <span>{{ \Carbon\Carbon::parse($item->tgl_pemeriksaan)->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                <td>
                                    @switch($item->status_pemeriksaan)
                                        @case('menunggu')
                                            <span class="status-badge status-menunggu">
                                                <i class="fas fa-clock me-1"></i>Menunggu
                                            </span>
                                            @break
                                        @case('sedang_diperiksa')
                                            <span class="status-badge status-sedang-diperiksa">
                                                <i class="fas fa-spinner me-1"></i>Sedang Diperiksa
                                            </span>
                                            @break
                                        @case('selesai')
                                            <span class="status-badge status-selesai">
                                                <i class="fas fa-check-circle me-1"></i>Selesai
                                            </span>
                                            @break
                                        @default
                                            <span class="status-badge" style="background-color: #f8f9fa; color: #6c757d;">
                                                <i class="fas fa-question me-1"></i>{{ ucfirst($item->status_pemeriksaan) }}
                                            </span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($item->dokter_pemeriksa)
                                        <div class="user-info">
                                         
                                            <div>
                                                <div class="fw-semibold">{{ $item->dokter_pemeriksa }}</div>
                                                <small class="text-muted">Dokter</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->is_lpk_sentosa)
                                        <span class="lpk-badge">
                                            <i class="fas fa-building me-1"></i>LPK Sentosa
                                        </span>
                                    @else
                                        <span class="umum-badge">
                                            <i class="fas fa-users me-1"></i>Umum
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->hasil_lab && $item->hasil_lab !== '')
                                        <span class="badge" style="background-color: var(--primary-green); color: white;">
                                            <i class="fas fa-check me-1"></i>Ada Hasil
                                        </span>
                                    @else
                                        <span class="badge" style="background-color: #6c757d; color: white;">
                                            <i class="fas fa-times me-1"></i>Belum Ada
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-vials"></i>
                                        </div>
                                        <p class="mb-0">Tidak ada data laboratorium untuk periode yang dipilih</p>
                                        <small class="text-muted">Coba ubah periode atau filter untuk melihat data lainnya</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($laboratorium->hasPages())
                    <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                        {{ $laboratorium->appends(request()->query())->links() }}
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

        // Handle periode change
       
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
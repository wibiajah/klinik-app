<x-admin-layout title="Laporan Radiologi">
    
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
            box-shadow: 0 0 0 0.2rem rgba(0, 188, 132, 0.25);
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
        
        .status-sedang-diperiksa {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-selesai {
            background-color: #d1e7dd;
            color: #0a3622;
        }
        
        .jenis-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .jenis-rontgen {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .jenis-ct-scan {
            background-color: #e0e7ff;
            color: #3730a3;
        }
        
        .jenis-mri {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .jenis-usg {
            background-color: #ecfdf5;
            color: #065f46;
        }
        
        .jenis-mammografi {
            background-color: #fce7f3;
            color: #be185d;
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

        .hasil-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .ada-hasil {
            background-color: #d1e7dd;
            color: #0a3622;
        }
        
        .belum-ada-hasil {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>

    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Laporan Klinik</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Radiologi</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="page-title mb-0">Laporan Radiologi</h1>
             
            </div>
            
            <div>
                
  <button onclick="window.print()" class="btn-export">
    <i class="fas fa-print me-2"></i>Cetak Laporan
</button>
            </div>
        </div>
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Periode Laporan:</strong> {{ $judul_periode }}
        </div>
        <!-- Filter Section -->
       

       
<div class="search-container">
            <form method="GET" action="{{ route('admin.laporanklinik.radiologi') }}" id="filterForm">
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
                            <a href="{{ route('admin.laporanklinik.radiologi') }}" class="btn btn-secondary flex-fill">
                                <i class="fas fa-refresh me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Hasil Radiologi Statistics -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <p class="stat-number">{{ number_format($ada_hasil) }}</p>
                    <p class="stat-label">Ada Hasil</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <p class="stat-number">{{ number_format($belum_ada_hasil) }}</p>
                    <p class="stat-label">Belum Ada Hasil</p>
                </div>
            </div>

           
        </div>

        <!-- Top Dokter & Teknisi -->
        @if($dokter_stats->count() > 0 || $teknisi_stats->count() > 0)
        <div class="row mb-4">
            @if($dokter_stats->count() > 0)
            <div class="col-md-6 mb-3">
                <div class="custom-card">
                    <div class="card-header">
                        <h5 class="mb-0">Top 5 Dokter Radiologi</h5>
                    </div>
                    <div class="card-body">
                        @foreach($dokter_stats as $dokter)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $dokter->dokter_radiologi }}</span>
                            <span class="badge custom-badge">{{ $dokter->total }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if($teknisi_stats->count() > 0)
            <div class="col-md-6 mb-3">
                <div class="custom-card">
                    <div class="card-header">
                        <h5 class="mb-0">Top 5 Teknisi Radiologi</h5>
                    </div>
                    <div class="card-body">
                        @foreach($teknisi_stats as $teknisi)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $teknisi->teknisi_radiologi }}</span>
                            <span class="badge custom-badge">{{ $teknisi->total }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

        <!-- Data Table -->
        <div class="custom-card">
            <div class="card-header">
                <h5 class="mb-0">Data Radiologi</h5>
            </div>
            <div class="card-body">
                @if($radiologi->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable">
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
                                        Tanggal
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(3)">
                                        Nama Pasien
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(4)">
                                        Umur/JK
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(5)">
                                        Jenis Radiologi
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(6)">
                                        Status
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(7)">
                                        Dokter
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(8)">
                                        Teknisi
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(9)">
                                        Tipe
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(10)">
                                        Hasil
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($radiologi as $index => $item)
                                <tr>
                                    <td>{{ $radiologi->firstItem() + $index }}</td>
                                    <td>{{ $item->no_antrian }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_pemeriksaan)->format('d/m/Y') }}</td>
                                    <td>{{ $item->nama_pasien }}</td>
                                    <td>
                                        {{ $item->umur ? $item->umur . ' th' : '-' }} / 
                                        {{ $item->jenis_kelamin == 'L' ? 'L' : 'P' }}
                                    </td>
                                    <td>
                                        @switch($item->jenis_radiologi)
                                            @case('rontgen')
                                                <span class="jenis-badge jenis-rontgen">Rontgen</span>
                                                @break
                                            @case('ct_scan')
                                                <span class="jenis-badge jenis-ct-scan">CT Scan</span>
                                                @break
                                            @case('mri')
                                                <span class="jenis-badge jenis-mri">MRI</span>
                                                @break
                                            @case('usg')
                                                <span class="jenis-badge jenis-usg">USG</span>
                                                @break
                                            @case('mammografi')
                                                <span class="jenis-badge jenis-mammografi">Mammografi</span>
                                                @break
                                            @default
                                                <span class="jenis-badge jenis-rontgen">{{ ucfirst($item->jenis_radiologi) }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($item->status_pemeriksaan)
                                            @case('menunggu')
                                                <span class="status-badge status-menunggu">Menunggu</span>
                                                @break
                                            @case('sedang_diperiksa')
                                                <span class="status-badge status-sedang-diperiksa">Sedang Diperiksa</span>
                                                @break
                                            @case('selesai')
                                                <span class="status-badge status-selesai">Selesai</span>
                                                @break
                                            @default
                                                <span class="status-badge status-menunggu">{{ ucfirst($item->status_pemeriksaan) }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $item->dokter_radiologi ?: '-' }}</td>
                                    <td>{{ $item->teknisi_radiologi ?: '-' }}</td>
                                    <td>
                                        @if($item->is_lpk_sentosa)
                                            <span class="lpk-badge lpk-sentosa">LPK Sentosa</span>
                                        @else
                                            <span class="lpk-badge lpk-umum">Umum</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->hasil_radiologi && $item->hasil_radiologi != '')
                                            <span class="hasil-badge ada-hasil">Ada Hasil</span>
                                        @else
                                            <span class="hasil-badge belum-ada-hasil">Belum Ada</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <small class="text-muted">
                                Menampilkan {{ $radiologi->firstItem() }} - {{ $radiologi->lastItem() }} 
                                dari {{ $radiologi->total() }} data
                            </small>
                        </div>
                        <div>
                            {{ $radiologi->links() }}
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-x-ray"></i>
                        </div>
                        <h5>Tidak ada data radiologi</h5>
                        <p>Belum ada data radiologi untuk periode yang dipilih.</p>
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
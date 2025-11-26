<x-admin-layout title="Laporan Surat Keterangan">
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
        
        .surat-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .surat-sehat {
            background-color: #d1e7dd;
            color: #0a3622;
        }
        
        .surat-sakit {
            background-color: #f8d7da;
            color: #721c24;
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
        
        .daily-stats-container {
            background: white;
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .stats-header {
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-gray);
            padding-bottom: 0.5rem;
        }
        
        .user-stats-item {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .daily-stats-item {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            margin-bottom: 0.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
        }

        .content-preview {
            max-width: 200px;
            max-height: 50px;
            overflow: hidden;
            font-size: 0.875rem;
            color: #6c757d;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: all 0.2s;
        }

        .content-preview:hover {
            background-color: #e9ecef;
            border-color: var(--primary-green);
        }

        .content-preview.expanded {
            max-height: none;
            max-width: 400px;
            white-space: pre-wrap;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Laporan Surat Keterangan</h1>
            <div>
                <a href="{{ route('admin.laporanklinik.export-surat-keterangan', request()->all()) }}" 
                   class="btn-export">
                    <i class="fas fa-download me-2"></i>Export PDF
                </a>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Surat Keterangan</li>
            </ol>
        </nav>

        <!-- Period Info -->
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Periode Laporan:</strong> {{ $judul_periode }}
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-12 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <div class="stat-number">{{ $total_surat }}</div>
                    <div class="stat-label">Total Surat</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-number">{{ $surat_sehat }}</div>
                    <div class="stat-label">Surat Sehat</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-thermometer-full"></i>
                    </div>
                    <div class="stat-number">{{ $surat_sakit }}</div>
                    <div class="stat-label">Surat Sakit</div>
                </div>
            </div>
        </div>

        <!-- Additional Statistics -->
        @if(!empty($user_stats) || !empty($daily_stats))
        <div class="row mb-4">
            <!-- User Statistics -->
            @if(!empty($user_stats))
            <div class="col-lg-6 mb-3">
                <div class="daily-stats-container">
                    <div class="stats-header">
                        <i class="fas fa-user-md me-2"></i>Statistik Berdasarkan Petugas
                    </div>
                    @foreach($user_stats as $stat)
                    <div class="user-stats-item">
                        <div>
                            <i class="fas fa-user me-2"></i>{{ $stat['user_name'] }}
                        </div>
                        <span class="badge" style="background-color: var(--primary-green); color: white;">
                            {{ $stat['total'] }} surat
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Daily Statistics -->
            @if(!empty($daily_stats))
            <div class="col-lg-6 mb-3">
                <div class="daily-stats-container">
                    <div class="stats-header">
                        <i class="fas fa-calendar-day me-2"></i>Statistik Harian
                    </div>
                    <div style="max-height: 300px; overflow-y: auto;">
                        @foreach($daily_stats as $stat)
                        <div class="daily-stats-item">
                            <div>
                                <i class="fas fa-calendar me-1"></i>{{ $stat['tanggal'] }}
                            </div>
                            <span class="badge" style="background-color: var(--primary-green); color: white;">
                                {{ $stat['total'] }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

        <!-- Filter Container -->
        <div class="search-container">
            <form method="GET" action="{{ route('admin.laporanklinik.surat-keterangan') }}" id="filterForm">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <label class="form-label fw-semibold">Periode:</label>
                        <select name="periode" id="periode" class="form-control search-input">
                            <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="custom" {{ $periode == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2" id="tanggal_mulai_container" style="{{ $periode != 'custom' ? 'display: none;' : '' }}">
                        <label class="form-label fw-semibold">Tanggal Mulai:</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                               class="form-control search-input" value="{{ $tanggal_mulai }}">
                    </div>
                    <div class="col-md-2 mb-2" id="tanggal_selesai_container" style="{{ $periode != 'custom' ? 'display: none;' : '' }}">
                        <label class="form-label fw-semibold">Tanggal Selesai:</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" 
                               class="form-control search-input" value="{{ $tanggal_selesai }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label fw-semibold">Jenis Surat:</label>
                        <select name="jenis_surat" id="jenis_surat" class="form-control search-input">
                            <option value="semua" {{ $jenis_surat == 'semua' ? 'selected' : '' }}>Semua</option>
                            <option value="sehat" {{ $jenis_surat == 'sehat' ? 'selected' : '' }}>Surat Sehat</option>
                            <option value="sakit" {{ $jenis_surat == 'sakit' ? 'selected' : '' }}>Surat Sakit</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label fw-semibold">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.laporanklinik.surat-keterangan') }}" class="btn btn-secondary flex-fill">
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
                    Data Surat Keterangan - {{ $judul_periode }}
                </h6>
                <span class="badge custom-badge">{{ $surat_keterangan->total() }} Total</span>
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
                                    ID Surat
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(2)">
                                    Jenis Surat
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                
                                <th class="table-header" onclick="sortTable(4)">
                                    Tanggal Cetak
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header">
                                    Dicetak Oleh
                                </th>
                                <th class="table-header">
                                    Waktu Cetak
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($surat_keterangan as $index => $item)
                            <tr>
                                <td class="fw-semibold">{{ $surat_keterangan->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-medical me-2 text-muted"></i>
                                        <span class="fw-semibold">#{{ $item->id }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($item->jenis_surat == 'sehat')
                                        <span class="surat-badge surat-sehat">
                                            <i class="fas fa-heart me-1"></i>Surat Sehat
                                        </span>
                                    @elseif($item->jenis_surat == 'sakit')
                                        <span class="surat-badge surat-sakit">
                                            <i class="fas fa-thermometer-full me-1"></i>Surat Sakit
                                        </span>
                                    @else
                                        <span class="surat-badge" style="background-color: #f3f4f6; color: #6b7280;">
                                            <i class="fas fa-question me-1"></i>{{ ucfirst($item->jenis_surat ?? 'Tidak diketahui') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->content)
                                        <div class="content-preview" onclick="toggleContent(this)" title="Klik untuk melihat detail">
                                            {{ Str::limit(strip_tags($item->content), 50) }}
                                            @if(strlen(strip_tags($item->content)) > 50)
                                                <small class="text-primary">... (klik untuk detail)</small>
                                            @endif
                                        </div>
                                        <div class="content-full" style="display: none;">
                                            {!! nl2br(e($item->content)) !!}
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar me-2 text-muted"></i>
                                        <span>{{ $item->printed_at ? $item->printed_at->format('d/m/Y') : '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                            {{ strtoupper(substr($item->user->name ?? 'N/A', 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $item->user->name ?? 'Unknown' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock me-2 text-muted"></i>
                                        <span>{{ $item->printed_at ? $item->printed_at->format('H:i:s') : '-' }}</span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-file-medical-alt"></i>
                                        </div>
                                        <p class="mb-0">Tidak ada data surat keterangan untuk periode ini</p>
                                        <small class="text-muted">Coba ubah periode, tanggal, atau jenis surat untuk melihat data lain</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($surat_keterangan->hasPages())
                    <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                        {{ $surat_keterangan->appends(request()->query())->links() }}
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
        document.getElementById('periode').addEventListener('change', function() {
            const periode = this.value;
            const tanggalMulaiContainer = document.getElementById('tanggal_mulai_container');
            const tanggalSelesaiContainer = document.getElementById('tanggal_selesai_container');
            
            if (periode === 'custom') {
                tanggalMulaiContainer.style.display = 'block';
                tanggalSelesaiContainer.style.display = 'block';
            } else {
                tanggalMulaiContainer.style.display = 'none';
                tanggalSelesaiContainer.style.display = 'none';
                // Auto submit form when non-custom option is selected
                document.getElementById('filterForm').submit();
            }
        });

        // Auto submit form when filters change
        document.getElementById('jenis_surat').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('tanggal_mulai').addEventListener('change', function() {
            if (document.getElementById('periode').value === 'custom') {
                document.getElementById('filterForm').submit();
            }
        });

        document.getElementById('tanggal_selesai').addEventListener('change', function() {
            if (document.getElementById('periode').value === 'custom') {
                document.getElementById('filterForm').submit();
            }
        });

        // Content preview toggle
        function toggleContent(element) {
            const row = element.closest('tr');
            const preview = element;
            const fullContent = row.querySelector('.content-full');
            
            if (preview.classList.contains('expanded')) {
                preview.classList.remove('expanded');
                preview.innerHTML = preview.dataset.original;
                fullContent.style.display = 'none';
            } else {
                preview.dataset.original = preview.innerHTML;
                preview.classList.add('expanded');
                preview.innerHTML = fullContent.innerHTML;
                fullContent.style.display = 'block';
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

                // Handle numeric sorting for specific columns (No column, ID column)
                if (columnIndex === 0 || columnIndex === 1) {
                    aValue = parseInt(aValue.replace(/[^0-9]/g, '')) || 0;
                    bValue = parseInt(bValue.replace(/[^0-9]/g, '')) || 0;
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
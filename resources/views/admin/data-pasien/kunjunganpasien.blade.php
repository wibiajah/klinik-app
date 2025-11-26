<x-admin-layout title="Data Kunjungan Pasien">
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

        .badge-blue {
            background-color: #007bff !important;
            color: white !important;
        }

        .badge-green {
            background-color: #28a745 !important;
            color: white !important;
        }

        .btn-search {
            background-color: var(--primary-green);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.5rem 1rem;
            transition: all 0.2s;
        }

        .btn-search:hover {
            background-color: #028a1c;
            color: white;
        }

        .btn-detail {
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-detail:hover {
            background-color: #5a6268;
            color: white;
            text-decoration: none;
        }

        .select-filter {
            border: 1px solid var(--border-gray);
            border-radius: 4px;
            padding: 0.5rem;
        }

        .select-filter:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(2, 183, 35, 0.25);
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Data Kunjungan Pasien</h1>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Kunjungan Pasien</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ number_format($totalPasien) }}</div>
                    <div class="stat-label">Total Pasien</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="stat-number">{{ number_format($totalKunjungan) }}</div>
                    <div class="stat-label">Total Kunjungan</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-number">{{ $rataRataKunjungan }}</div>
                    <div class="stat-label">Rata-rata Kunjungan</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
       <div class="search-container">
    <div class="row align-items-end">
        <div class="col-md-3 mb-2">
            <label class="form-label fw-semibold">Cari Nama:</label>
            <input type="text" 
                   name="search_nama" 
                   class="form-control search-input" 
                   placeholder="Ketik nama pasien..."
                   autocomplete="off">
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label fw-semibold">Cari NIK:</label>
            <input type="text" 
                   name="search_nik" 
                   class="form-control search-input" 
                   placeholder="Ketik NIK pasien..."
                   autocomplete="off">
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label fw-semibold">Data per halaman:</label>
            <select name="per_page" class="form-control select-filter">
                <option value="25" {{ $per_page == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $per_page == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $per_page == 100 ? 'selected' : '' }}>100</option>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <button type="button" class="btn btn-search w-100" onclick="clearSearch()">
                <i class="fas fa-times me-1"></i> Clear
            </button>
        </div>
    </div>
</div>

        <!-- Main Data Table -->
        <div class="custom-card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                <h6 class="m-0 fw-bold" style="color: #333;">
                    Daftar Kunjungan Pasien
                </h6>
                <span class="badge custom-badge">{{ $dataPasien->total() }} Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable">
                        <thead>
                            <tr>
                                <th class="table-header" onclick="sortTable(0)">
                                    No
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(1)">
                                    NIK
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(2)">
                                    Nama
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(3)">
                                    Jenis Kelamin
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(4)">
                                    No. Rekam Medis
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(5)">
                                    Total Kunjungan
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(6)">
                                    Kunjungan Pertama
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(7)">
                                    Kunjungan Terakhir
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPasien as $index => $pasien)
                            <tr>
                                <td class="fw-semibold">{{ $dataPasien->firstItem() + $index }}</td>
                                <td>
                                    <code style="background-color: #f8f9fa; color: #333; padding: 2px 6px; border-radius: 3px;">
                                        {{ $pasien->nik }}
                                    </code>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $pasien->nama }}</div>
                                    <small class="text-muted">
                                        {{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </small>
                                </td>
                                <td>
                                    @if($pasien->jenis_kelamin == 'L')
                                        <span class="badge text-white" style="background-color: #007bff; color: white;">Laki-laki</span>
                                    @else
                                        <span class="badge" style="background-color: #e83e8c; color: white;">Perempuan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pasien->no_rekam_medis)
                                        <span class="badge badge-blue">{{ $pasien->no_rekam_medis }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-green fw-bold" style="font-size: 0.9rem;">
                                        {{ $pasien->total_kunjungan }}
                                    </span>
                                </td>
                                <td class="fw-semibold">
                                    {{ $pasien->kunjungan_pertama ? $pasien->kunjungan_pertama->format('d/m/Y') : '-' }}
                                </td>
                                <td class="fw-semibold">
                                    {{ $pasien->kunjungan_terakhir ? $pasien->kunjungan_terakhir->format('d/m/Y') : '-' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.data-pasien.detail-by-nik', $pasien->nik) }}" 
                                       class="btn-detail">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <p class="mb-0">Tidak ada data pasien ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($dataPasien->hasPages())
                    <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                        {{ $dataPasien->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
   function performSearch() {
    const searchNama = document.querySelector('input[name="search_nama"]').value.toLowerCase();
    const searchNik = document.querySelector('input[name="search_nik"]').value.toLowerCase();
    const tableRows = document.querySelectorAll('#dataTable tbody tr');
    
    tableRows.forEach(row => {
        // Skip empty state row
        if (row.cells.length === 1) return;
        
        const nik = row.cells[1].textContent.toLowerCase();
        const nama = row.cells[2].textContent.toLowerCase();
        
        const namaMatch = searchNama === '' || nama.includes(searchNama);
        const nikMatch = searchNik === '' || nik.includes(searchNik);
        
        if (namaMatch && nikMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update counter
    const visibleRows = document.querySelectorAll('#dataTable tbody tr:not([style*="display: none"])');
    const badge = document.querySelector('.custom-badge');
    badge.textContent = visibleRows.length + ' Total';
}

// Event listeners
document.querySelector('input[name="search_nama"]').addEventListener('input', performSearch);
document.querySelector('input[name="search_nik"]').addEventListener('input', performSearch);

// Clear search function
function clearSearch() {
    document.querySelector('input[name="search_nama"]').value = '';
    document.querySelector('input[name="search_nik"]').value = '';
    performSearch();
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
            currentHeader.className = newDirection === 'asc' ? 'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';

            // Sort rows
            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].textContent.trim();
                let bValue = b.cells[columnIndex].textContent.trim();

                // Handle numeric sorting for specific columns
                if (columnIndex === 0 || columnIndex === 5) { // No and Total Kunjungan
                    aValue = parseInt(aValue) || 0;
                    bValue = parseInt(bValue) || 0;
                } else if (columnIndex === 6 || columnIndex === 7) { // Date columns
                    // Convert date format from d/m/Y to sortable format
                    if (aValue !== '-') {
                        const dateA = aValue.split('/');
                        aValue = new Date(dateA[2], dateA[1] - 1, dateA[0]);
                    } else {
                        aValue = new Date(0);
                    }
                    
                    if (bValue !== '-') {
                        const dateB = bValue.split('/');
                        bValue = new Date(dateB[2], dateB[1] - 1, dateB[0]);
                    } else {
                        bValue = new Date(0);
                    }
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
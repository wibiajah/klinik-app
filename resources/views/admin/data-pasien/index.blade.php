<x-admin-layout title="Data Pasien">
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
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-icon.primary { color: #007bff; }
        .stat-icon.success { color: #28a745; }
        .stat-icon.warning { color: #ffc107; }
        .stat-icon.info { color: #17a2b8; }
        
        .stat-number {
            font-size: 1.8rem;
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
            font-size: 0.75rem;
            margin-bottom: 0.2rem;
            transition: all 0.2s;
            width: 100%;
        }
        
        .btn-detail {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-detail:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .btn-history {
            background-color: #17a2b8;
            color: white;
        }
        
        .btn-history:hover {
            background-color: #138496;
            color: white;
        }
        
        .btn-print {
            background-color: #6f42c1;
            color: white;
        }
        
        .btn-print:hover {
            background-color: #5a2d91;
            color: white;
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
        
        .date-filter {
            border: 1px solid var(--border-gray);
            border-radius: 4px;
            padding: 0.5rem;
        }
        
        .date-filter:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(2, 183, 35, 0.25);
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
        
        .table td {
            vertical-align: top;
        }
        
        .patient-info {
            margin-bottom: 0.5rem;
        }
        
        .patient-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }
        
        .patient-detail {
            font-size: 0.8rem;
            color: var(--dark-gray);
            margin-bottom: 1px;
        }
        
        .keluhan-badge {
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 3px;
            margin-bottom: 4px;
        }
        
        .status-badge {
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 3px;
        }
        
      .timeline-compact {
            font-size: 0.95rem;
        }
        
        .timeline-step {
            color: var(--primary-green);
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .timeline-date {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }
        
        .hasil-section {
            font-size: 0.8rem;
        }
        
        .hasil-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }
        
        .hasil-content {
            color: var(--dark-gray);
            margin-bottom: 8px;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 page-title">Data Lengkap Pasien</h1>
                <small class="text-muted">Kelola dan lihat riwayat lengkap pasien berdasarkan NIK</small>
            </div>
            <div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Lengkap Pasien</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['total_kunjungan'] }}</div>
                    <div class="stat-label">Total Kunjungan</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['pemeriksaan_umum'] }}</div>
                    <div class="stat-label">Pemeriksaan Umum</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-vial"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['laboratorium'] }}</div>
                    <div class="stat-label">Laboratorium</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon info">
                        <i class="fas fa-x-ray"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['radiologi'] }}</div>
                    <div class="stat-label">Radiologi</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="search-container">
    <div class="row">
        <div class="col-md-4 mb-2">
            <label class="form-label fw-semibold">Cari Nama:</label>
            <input type="text" id="searchNama" class="form-control search-input" placeholder="Masukkan nama pasien...">
        </div>
        <div class="col-md-4 mb-2">
            <label class="form-label fw-semibold">Cari NIK:</label>
            <input type="text" id="searchNik" class="form-control search-input" placeholder="Masukkan NIK...">
        </div>
        <div class="col-md-4 mb-2">
            <label class="form-label fw-semibold">Cari No. Rekam Medis:</label>
            <input type="text" id="searchRekamMedis" class="form-control search-input" placeholder="Masukkan no. rekam medis...">
        </div>
    </div>
</div>

        <!-- Main Data Table -->
        <div class="custom-card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                <h6 class="m-0 fw-bold" style="color: #333;">
                    <i class="fas fa-table"></i> Daftar Data Pasien
                </h6>
                <span class="badge custom-badge">{{ $dataPasien->total() }} Total Data</span>
            </div>
            <div class="card-body p-0">
                @if($dataPasien->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable">
                        <thead>
                            <tr>
                                <th class="table-header" onclick="sortTable(0)" width="5%">
                                    No
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(1)" width="18%">
                                    Identitas Pasien
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(2)" width="15%">
                                    Keluhan & Status
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(3)" width="18%">
                                    Timeline Proses
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(4)" width="22%">
                                    Hasil Pemeriksaan
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(5)" width="12%">
                                    Riwayat Kunjungan
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" width="10%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataPasien as $index => $pasien)
                            <tr>
                                <td class="fw-semibold">{{ $dataPasien->firstItem() + $index }}</td>
                                
                                <!-- Identitas Pasien -->
                                <td>
                                    <div class="patient-info">
                                        <div class="patient-name">{{ $pasien->nama }}</div>
                                          @if($pasien->is_lpk_sentosa)
            <span class="badge bg-info text-white" style="font-size: 0.75rem;">
                <i class="fas fa-graduation-cap me-1"></i>LPK Sentosa
            </span>
        @endif
                                        <div class="patient-detail">NIK: {{ $pasien->nik }}</div>
                                        <div class="patient-detail">RM: 
                                            <code style="background-color: #f8f9fa; color: #333; padding: 1px 4px; border-radius: 2px;">
                                                {{ $pasien->no_rekam_medis ?? 'Belum ada' }}
                                            </code>
                                        </div>
                                        <div class="patient-detail">{{ $pasien->alamat }}</div>
                                        <div class="patient-detail">{{ $pasien->no_hp }}</div>
                                    </div>
                                </td>

                                <!-- Keluhan & Status -->
                                <td>
                                    <div class="mb-2">
                                        <span class="keluhan-badge custom-badge">
                                            {{ ucfirst(str_replace('_', ' ', $pasien->keluhan)) }}
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        @php
                                            $statusClass = match($pasien->status_lengkap['status']) {
                                                'selesai' => 'success',
                                                'sedang_diperiksa' => 'warning',
                                                'siap_periksa' => 'info',
                                                'menunggu' => 'secondary',
                                                'ditolak' => 'danger',
                                                default => 'secondary'
                                            };
                                        @endphp
                                        <span class="status-badge bg-{{ $statusClass }} text-white">
                                            {{ $pasien->status_lengkap['keterangan'] }}
                                        </span>
                                    </div>
                                    <div class="patient-detail">
                                        Daftar: {{ \Carbon\Carbon::parse($pasien->tgl_pendaftaran)->format('d/m/Y') }}
                                    </div>
                                </td>

                                <!-- Timeline Proses -->
                                <td>
    <div class="timeline-compact">
        @foreach(array_slice($pasien->timeline, 0, 3) as $timeline)
        <div class="timeline-item mb-1">
            <small class="fw-bold text-primary">{{ $timeline['step'] }}</small>
            <br><small class="text-muted">
                @if(isset($timeline['waktu']) && $timeline['waktu'])
                    @php
                        $waktu = $timeline['waktu'];
                        if (is_string($waktu)) {
                            $waktu = \Carbon\Carbon::parse($waktu);
                        }
                    @endphp
                    {{ $waktu->format('d/m/Y H:i') }}
                @else
                    {{ \Carbon\Carbon::parse($timeline['tanggal'])->format('d/m/Y') }}
                @endif
            </small>
            @if($timeline['keterangan'])
            <br><small class="text-secondary">{{ $timeline['keterangan'] }}</small>
            @endif
            <hr class="my-1">
        </div>
        @endforeach
        @if(count($pasien->timeline) > 3)
        <small class="text-muted">+ {{ count($pasien->timeline) - 3 }} langkah lagi</small>
        @endif
    </div>
</td>

                                <!-- Hasil Pemeriksaan -->
                                <td>
                                    <div class="hasil-section">
                                        @if(!empty($pasien->hasil_pemeriksaan))
                                            @if($pasien->keluhan == 'pemeriksaan_umum')
                                                <div class="mb-2">
                                                    <div class="hasil-label">Diagnosis:</div>
                                                    <div class="hasil-content">{{ $pasien->hasil_pemeriksaan['diagnosis'] ?? 'Belum ada' }}</div>
                                                </div>
                                                @if($pasien->hasil_pemeriksaan['obat'])
                                                <div class="mb-2">
                                                    <div class="hasil-label">Obat:</div>
                                                    <div class="hasil-content">{{ Str::limit($pasien->hasil_pemeriksaan['obat'], 50) }}</div>
                                                </div>
                                                @endif
                                                @if($pasien->hasil_pemeriksaan['rujukan'])
                                                <div>
                                                    <span class="badge bg-warning text-dark">Ada Rujukan</span>
                                                </div>
                                                @endif
                                            @elseif($pasien->keluhan == 'lab')
                                                <div class="mb-2">
                                                    <div class="hasil-label">Hasil Lab:</div>
                                                    <div class="hasil-content">{{ Str::limit($pasien->hasil_pemeriksaan['hasil_lab'] ?? 'Belum ada', 80) }}</div>
                                                </div>
                                                <div class="hasil-content">
                                                    Dokter: {{ $pasien->hasil_pemeriksaan['dokter_pemeriksa'] ?? '-' }}
                                                </div>
                                            @elseif($pasien->keluhan == 'radiologi')
                                                <div class="mb-2">
                                                    <div class="hasil-label">Jenis:</div>
                                                    <div class="hasil-content">{{ ucfirst($pasien->hasil_pemeriksaan['jenis_radiologi'] ?? '-') }}</div>
                                                </div>
                                                <div class="mb-2">
                                                    <div class="hasil-label">Hasil:</div>
                                                    <div class="hasil-content">{{ Str::limit($pasien->hasil_pemeriksaan['hasil_radiologi'] ?? 'Belum ada', 80) }}</div>
                                                </div>
                                                <div class="hasil-content">
                                                    Dokter: {{ $pasien->hasil_pemeriksaan['dokter_radiologi'] ?? '-' }}
                                                </div>
                                            @endif
                                        @else
                                            <div class="hasil-content">Belum ada hasil pemeriksaan</div>
                                        @endif
                                    </div>
                                </td>

                                <!-- Riwayat Kunjungan -->
                                <td>
                                    <div class="mb-2">
                                        <span class="badge bg-info text-white">
                                            {{ $pasien->total_kunjungan_nik }} Kunjungan
                                        </span>
                                    </div>
                                    <small class="text-muted">
                                        Klik detail untuk melihat seluruh riwayat kunjungan pasien
                                    </small>
                                </td>

                                <!-- Aksi -->
                                <td>
                                    <div class="d-flex flex-column">
                                       <a href="{{ route('admin.data-pasien.detail-satu-kunjungan', $pasien->id) }}" 
   class="btn btn-action btn-detail" title="Detail Kunjungan">
    <i class="fas fa-eye"></i> Kunjungan
</a>
                                        <a href="{{ route('admin.data-pasien.detail-by-nik', $pasien->nik) }}" 
                                           class="btn btn-action btn-history" title="Riwayat NIK">
                                            <i class="fas fa-history"></i> Detail
                                        </a>
                                        <button class="btn btn-action btn-print" 
                                                onclick="printKunjungan({{ $pasien->id }})" title="Print">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($dataPasien->hasPages())
                    <div class="d-flex justify-content-between align-items-center p-3" style="border-top: 1px solid var(--border-gray);">
                        <div>
                            <small class="text-muted">
                                Menampilkan {{ $dataPasien->firstItem() }} - {{ $dataPasien->lastItem() }} 
                                dari {{ $dataPasien->total() }} data
                            </small>
                        </div>
                        <div>
                            {{ $dataPasien->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h5 class="text-muted">Tidak ada data yang ditemukan</h5>
                    <p class="text-muted">Coba ubah filter pencarian Anda</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 8px; border: none;">
                <div class="modal-header" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                    <h5 class="modal-title fw-bold">Export Data Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.data-pasien.export') }}" method="GET">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Format Export</label>
                            <select class="form-select search-input" name="format" required>
                                <option value="">Pilih Format</option>
                                <option value="excel">Excel (.xlsx)</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        
                        <!-- Include current filters -->
                      
                        
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                Export akan menggunakan filter yang sedang aktif
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--border-gray);">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
function printKunjungan(id) {
    window.open(`{{ url('admin/data-pasien/detail-kunjungan') }}/${id}?print=1`, '_blank');
}

// Table sorting
let sortDirection = {};

function sortTable(columnIndex) {
    const table = document.getElementById('dataTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = Array.from(tbody.getElementsByTagName('tr'));
    
    if (rows.length === 0) return;

    const currentDirection = sortDirection[columnIndex] || 'asc';
    const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
    sortDirection[columnIndex] = newDirection;

    const headers = table.getElementsByClassName('sort-icon');
    for (let i = 0; i < headers.length; i++) {
        headers[i].className = 'fas fa-sort sort-icon';
    }
    
    const currentHeader = table.getElementsByClassName('sort-icon')[columnIndex];
    if (currentHeader) {
        currentHeader.className = newDirection === 'asc' ? 'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';
    }

    rows.sort((a, b) => {
        let aValue = a.cells[columnIndex].textContent.trim();
        let bValue = b.cells[columnIndex].textContent.trim();

        if (columnIndex === 0) {
            aValue = parseInt(aValue) || 0;
            bValue = parseInt(bValue) || 0;
        }

        if (aValue < bValue) return newDirection === 'asc' ? -1 : 1;
        if (aValue > bValue) return newDirection === 'asc' ? 1 : -1;
        return 0;
    });

    rows.forEach(row => tbody.appendChild(row));
}

// Search functionality
function filterTable() {
    const searchNama = document.getElementById('searchNama').value.toLowerCase();
    const searchNik = document.getElementById('searchNik').value.toLowerCase();
    const searchRekamMedis = document.getElementById('searchRekamMedis').value.toLowerCase();
    
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            const identitasCell = cells[1].textContent.toLowerCase();
            
            const nama = identitasCell;
            const nikMatch = identitasCell.match(/nik:\s*(\d+)/);
            const nik = nikMatch ? nikMatch[1] : '';
            const rmMatch = identitasCell.match(/rm:\s*([^\s]+)/);
            const rekamMedis = rmMatch ? rmMatch[1] : '';

            const showRow = (
                (searchNama === '' || nama.includes(searchNama)) &&
                (searchNik === '' || nik.includes(searchNik)) &&
                (searchRekamMedis === '' || rekamMedis.includes(searchRekamMedis))
            );

            rows[i].style.display = showRow ? '' : 'none';
        }
    }
}

// Event listeners for search
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchNama').addEventListener('input', filterTable);
    document.getElementById('searchNik').addEventListener('input', filterTable);
    document.getElementById('searchRekamMedis').addEventListener('input', filterTable);
});

// Auto refresh setiap 5 menit
setTimeout(function() {
    location.reload();
}, 300000);
</script>
</x-admin-layout>
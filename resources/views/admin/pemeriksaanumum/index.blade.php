<x-admin-layout title="Data Pemeriksaan Umum">
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
        
        .btn-detail {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-detail:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .btn-confirm {
            background-color: #ffc107;
            color: #212529;
        }
        
        .btn-confirm:hover {
            background-color: #e0a800;
            color: #212529;
        }
        
        .btn-start {
            background-color: #007bff;
            color: white;
        }
        
        .btn-start:hover {
            background-color: #0056b3;
            color: white;
        }
        
        .btn-finish {
            background-color: var(--primary-green);
            color: white;
        }
        
        .btn-finish:hover {
            background-color: #028a1c;
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
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Data Pemeriksaan Umum</h1>
            <div class="d-flex align-items-center">
                <label for="tanggal" class="form-label me-2 mb-0 fw-semibold">Filter Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" class="date-filter" value="{{ $tanggal }}" onchange="filterByDate()">
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pemeriksaan Umum</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['total_hari_ini'] }}</div>
                    <div class="stat-label">Total Hari Ini</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['menunggu'] }}</div>
                    <div class="stat-label">Menunggu Konfirmasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['dikonfirmasi'] }}</div>
                    <div class="stat-label">Menunggu Periksa</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $statistics['selesai'] }}</div>
                    <div class="stat-label">Sudah Selesai Diperiksa</div>
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
                    Daftar Pemeriksaan Umum - {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                </h6>
                <span class="badge custom-badge">{{ $pemeriksaanUmum->total() }} Total</span>
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
                                    No. Antrian
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(2)">
                                    No. Rekam Medis
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(3)">
                                    Nama
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(4)">
                                    NIK
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(5)">
                                    Jam Transfer
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(6)">
                                    Status
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="table-header" onclick="sortTable(7)">
    Petugas Terakhir
    <i class="fas fa-sort sort-icon"></i>
</th>
                                <th class="table-header">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemeriksaanUmum as $item)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration + ($pemeriksaanUmum->currentPage() - 1) * $pemeriksaanUmum->perPage() }}</td>
                                <td>
                                    @if($item->no_antrian)
                                        <span class="badge custom-badge">{{ $item->no_antrian }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                               <td>
    <div class="d-flex align-items-center gap-2">
        <code style="background-color: #f8f9fa; color: #333; padding: 2px 6px; border-radius: 3px;">
            {{ $item->no_rekam_medis }}
        </code>
        @if($item->is_lpk_sentosa)
            <span class="badge bg-info text-white" style="font-size: 0.75rem;">
                <i class="fas fa-graduation-cap me-1"></i>LPK Sentosa
            </span>
        @endif
    </div>
</td>
                                <td>
                                    <div class="fw-semibold">{{ $item->nama }}</div>
                                    <small class="text-muted">{{ $item->jenis_kelamin_label }}</small>
                                </td>
                                <td>{{ $item->nik }}</td>
                                <td class="fw-semibold">{{ $item->created_at->format('H:i') }}</td>
                                <td>
                                    @if($item->status_pemeriksaan == 'menunggu')
                                        <span class="badge" style="background-color: #ffc107; color: #212529;">{{ $item->status_pemeriksaan_label }}</span>
                                    @elseif($item->status_pemeriksaan == 'dikonfirmasi')
                                        <span class="badge" style="background-color: #007bff; color: white;">{{ $item->status_pemeriksaan_label }}</span>
                                    @elseif($item->status_pemeriksaan == 'sedang_diperiksa')
                                        <span class="badge" style="background-color: #17a2b8; color: white;">{{ $item->status_pemeriksaan_label }}</span>
                                    @else
                                        <span class="badge custom-badge">{{ $item->status_pemeriksaan_label }}</span>
                                    @endif
                                </td>
                              <td>
    @if($item->selesai_periksa_by)
        <div class="fw-semibold text-success">{{ $item->selesaiPeriksaBy->name }}</div>
        <small class="text-muted">Selesai: {{ $item->waktu_selesai_periksa->format('d/m H:i') }}</small>
    @elseif($item->mulai_periksa_by)
        <div class="fw-semibold text-primary">{{ $item->mulaiPeriksaBy->name }}</div>
        <small class="text-muted">Mulai: {{ $item->waktu_mulai_periksa->format('d/m H:i') }}</small>
    @elseif($item->konfirmasi_by)
        <div class="fw-semibold text-warning">{{ $item->konfirmasiBy->name }}</div>
        <small class="text-muted">Konfirmasi: {{ $item->waktu_konfirmasi->format('d/m H:i') }}</small>
    @else
        <span class="text-muted">-</span>
    @endif
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
                <a class="dropdown-item" href="{{ route('admin.pemeriksaanumum.detail', $item->id) }}">
                    <i class="fas fa-eye me-2 text-primary"></i> Detail
                </a>
            </li>
            
            @if($item->status_pemeriksaan == 'menunggu')
                <li><hr class="dropdown-divider"></li>
                
                <!-- Konfirmasi Button -->
                <li>
                    <form method="POST" action="{{ route('admin.pemeriksaanumum.konfirmasi', $item->id) }}" 
                          class="d-inline w-100" onsubmit="return confirm('Konfirmasi dan beri nomor antrian?')">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-check-circle me-2 text-success"></i> Konfirmasi & Beri Antrian
                        </button>
                    </form>
                </li>
                
            @elseif($item->status_pemeriksaan == 'dikonfirmasi')
                <li><hr class="dropdown-divider"></li>
                
                <!-- Mulai Pemeriksaan Button -->
                <li>
                    <form method="POST" action="{{ route('admin.pemeriksaanumum.update-status', $item->id) }}" 
                          class="d-inline w-100" onsubmit="return confirm('Mulai pemeriksaan?')">
                        @csrf
                        <input type="hidden" name="status_pemeriksaan" value="sedang_diperiksa">
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-play-circle me-2 text-warning"></i> Mulai Pemeriksaan
                        </button>
                    </form>
                </li>
                
            @elseif($item->status_pemeriksaan == 'sedang_diperiksa')
                <li><hr class="dropdown-divider"></li>
                
                <!-- Selesaikan Pemeriksaan Button -->
                <li>
                    <button type="button" class="dropdown-item" onclick="openHasilModal({{ $item->id }})">
                        <i class="fas fa-clipboard-check me-2 text-info"></i> Selesaikan Pemeriksaan
                    </button>
                </li>
            @endif
        </ul>
    </div>
</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <p class="mb-0">Tidak ada pemeriksaan umum pada tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pemeriksaanUmum->hasPages())
                    <div class="d-flex justify-content-center p-3" style="border-top: 1px solid var(--border-gray);">
                        {{ $pemeriksaanUmum->appends(['tanggal' => $tanggal])->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Hasil Pemeriksaan -->
    <div class="modal fade" id="hasilModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 8px; border: none;">
                <div class="modal-header" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                    <h5 class="modal-title fw-bold text-dark">Hasil Pemeriksaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="hasilForm" method="POST">
                    @csrf
                    <input type="hidden" name="status_pemeriksaan" value="selesai">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Diagnosis Sementara *</label>
                            <textarea name="diagnosis_sementara" class="form-control" rows="2" required 
                                    placeholder="Contoh: Flu, Infeksi Saluran Pernapasan, Hipertensi, Gastritis" 
                                    style="border: 1px solid var(--border-gray);"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Obat yang Diberikan</label>
                            <textarea name="obat_diberikan" class="form-control" rows="3" 
                                    placeholder="Contoh: Paracetamol 500 mg, 3x sehari" 
                                    style="border: 1px solid var(--border-gray);"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Anjuran / Instruksi</label>
                            <textarea name="anjuran_instruksi" class="form-control" rows="3" 
                                    placeholder="Contoh: Istirahat cukup, Minum air putih banyak, Kontrol ulang jika perlu" 
                                    style="border: 1px solid var(--border-gray);"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rujukan (jika ada)</label>
                            <textarea name="rujukan" class="form-control" rows="2" 
                                    placeholder="Contoh: Dirujuk ke RS/Spesialis (jika diperlukan)" 
                                    style="border: 1px solid var(--border-gray);"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--border-gray);">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-finish">Selesaikan Pemeriksaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Filter by date
        function filterByDate() {
            const tanggal = document.getElementById('tanggal').value;
            const url = new URL(window.location);
            url.searchParams.set('tanggal', tanggal);
            window.location.href = url.toString();
        }

        // Open modal
        function openHasilModal(id) {
            const form = document.getElementById('hasilForm');
            form.action = `/admin/pemeriksaan-umum/${id}/update-status`;
            
            const modal = new bootstrap.Modal(document.getElementById('hasilModal'));
            modal.show();
        }

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

        document.getElementById('searchNik').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('searchRekamMedis').addEventListener('keyup', function() {
            filterTable();
        });

        function filterTable() {
            const searchNama = document.getElementById('searchNama').value.toLowerCase();
            const searchNik = document.getElementById('searchNik').value.toLowerCase();
            const searchRekamMedis = document.getElementById('searchRekamMedis').value.toLowerCase();
            
            const table = document.getElementById('dataTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    const nama = cells[3].textContent.toLowerCase();
                    const nik = cells[4].textContent.toLowerCase();
                    const rekamMedis = cells[2].textContent.toLowerCase();

                    const showRow = (
                        (searchNama === '' || nama.includes(searchNama)) &&
                        (searchNik === '' || nik.includes(searchNik)) &&
                        (searchRekamMedis === '' || rekamMedis.includes(searchRekamMedis))
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
            currentHeader.className = newDirection === 'asc' ? 'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';

            // Sort rows
            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].textContent.trim();
                let bValue = b.cells[columnIndex].textContent.trim();

                // Handle numeric sorting for specific columns
                if (columnIndex === 0 || columnIndex === 1 || columnIndex === 5) {
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
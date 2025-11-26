<x-admin-layout>
    <x-slot name="title">Manajemen Email</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-envelope text-primary"></i>
                                Manajemen Email Pasien
                            </h3>
                            <button type="button" class="btn btn-success">
                                <i class="fas fa-file-export"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manajemen Email Pasien</li>
                            </ol>
                        </nav>

                        <!-- Period Info Banner -->
                        <div class="alert alert-info mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    <strong>Periode Laporan:</strong> 
                                    <span id="periodInfo">
                                        @if(isset($tanggal))
                                            {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                                        @else
                                            {{ date('d F Y') }}
                                        @endif
                                    </span>
                                   
                                </div>
                            </div>
                        </div>

                        <!-- Filter Form with Better Layout -->
                        <div class="row mb-4">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="periode">Periode Waktu</label>
                                    <select id="periode" class="form-control" onchange="handlePeriodeChange()">
                                        <option value="today">Hari Ini</option>
                                        <option value="week">Minggu Ini</option>
                                        <option value="month">Bulan Ini</option>
                                        <option value="custom" selected>Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="customDateContainer">
                                <div class="form-group">
                                    <label for="tanggal">Pilih Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" id="tanggal" class="form-control" value="{{ $tanggal ?? date('Y-m-d') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" onclick="applyFilters()">
                                                <i class="fas fa-calendar-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis_layanan">Jenis Layanan</label>
                                    <select id="jenis_layanan" class="form-control" onchange="searchTable()">
                                        <option value="all" {{ ($jenis_layanan ?? 'all') == 'all' ? 'selected' : '' }}>Semua Layanan</option>
                                        <option value="pemeriksaan_umum" {{ ($jenis_layanan ?? '') == 'pemeriksaan_umum' ? 'selected' : '' }}>Pemeriksaan Umum</option>
                                        <option value="laboratorium" {{ ($jenis_layanan ?? '') == 'laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                                        <option value="radiologi" {{ ($jenis_layanan ?? '') == 'radiologi' ? 'selected' : '' }}>Radiologi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="search">Cari Nama/Email Pasien</label>
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control" value="{{ request('search') }}" 
                                               placeholder="Ketik nama atau email untuk mencari..." oninput="searchTable()">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="text-muted">Pencarian otomatis saat mengetik</small>
                                </div>
                            </div>
                        </div>

                        <!-- Result Summary -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="alert alert-light border">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span id="resultInfo">
                                                Ditemukan <strong id="totalCount">{{ $data->count() ?? 0 }}</strong> pasien 
                                                (<strong id="visibleCount">{{ $data->count() ?? 0 }}</strong> ditampilkan)
                                            </span>
                                        </div>
                                        <div class="text-muted">
                                            <small>
                                                <i class="fas fa-clock me-1"></i>
                                                Terakhir diperbarui: {{ date('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table -->
                        @if(isset($data) && $data->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="dataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Pasien</th>
                                        <th>Email</th>
                                        <th>Jenis Layanan</th>
                                        <th>No. Rekam Medis</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                    <tr class="table-row">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <strong class="searchable-name">{{ $item['nama'] }}</strong>
                                                <div class="mt-1">
                                                    @if($item['is_lpk_sentosa'])
                                                        <span class="badge badge-warning">
                                                            <i class="fas fa-star"></i> PMI_Sentosa
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-user"></i> Umum
                                                        </span>
                                                    @endif
                                                    @if(!empty($item['no_antrian']))
                                                        <span class="badge badge-info ml-1">
                                                            <i class="fas fa-ticket-alt"></i> {{ $item['no_antrian'] }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $item['email'] }}" class="text-decoration-none">
                                                <i class="fas fa-envelope text-primary me-1"></i> 
                                                <span class="searchable-email">{{ $item['email'] }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="badge layanan-badge
                                                    @if($item['jenis_layanan'] == 'Pemeriksaan Umum') badge-primary
                                                    @elseif($item['jenis_layanan'] == 'Laboratorium') badge-success
                                                    @elseif($item['jenis_layanan'] == 'Radiologi') badge-warning
                                                    @else badge-secondary
                                                    @endif" data-layanan="{{ strtolower(str_replace(' ', '_', $item['jenis_layanan'])) }}">
                                                    {{ $item['jenis_layanan'] }}
                                                </span>
                                                <small class="text-muted mt-1">{{ $item['keluhan'] }}</small>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <code>{{ $item['no_rekam_medis'] }}</code>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge 
                                                @if(strpos($item['status'], 'Menunggu') !== false) badge-warning
                                                @elseif(strpos($item['status'], 'Sedang') !== false) badge-info
                                                @elseif(strpos($item['status'], 'Selesai') !== false) badge-success
                                                @else badge-secondary
                                                @endif">
                                                {{ $item['status'] }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary btn-sm" 
        onclick="openEmailClient('{{ $item['email'] }}', '{{ $item['nama'] }}', '{{ $item['jenis_layanan'] }}', '{{ $item['no_rekam_medis'] }}', '{{ $item['tanggal'] }}', '{{ $item['status'] }}', '{{ $item['no_antrian'] ?? '' }}')"
        title="Kirim Email">
    <i class="fas fa-envelope"></i> Kirim Email
</button>

                                                <button type="button" class="btn btn-info btn-sm" 
                                                        onclick="showEmailTemplate('{{ $item['nama'] }}', '{{ $item['jenis_layanan'] }}', '{{ $item['no_rekam_medis'] }}', '{{ $item['tanggal'] }}', '{{ $item['status'] }}', '{{ $item['no_antrian'] ?? '' }}')" 
                                                        data-toggle="modal" data-target="#emailTemplateModal"
                                                        title="Lihat Template">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- No Results Message -->
                        <div id="noResultsMessage" class="text-center py-5" style="display: none;">
                            <i class="fas fa-search text-muted" style="font-size: 3rem;"></i>
                            <h4 class="text-muted mt-3">Tidak ditemukan hasil pencarian</h4>
                            <p class="text-muted">Coba ubah kata kunci pencarian atau filter yang digunakan.</p>
                        </div>

                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-envelope text-muted" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mt-3">Tidak ada data pasien</h4>
                            <p class="text-muted">Tidak ditemukan pasien dengan alamat email pada periode yang dipilih.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Template Email -->
    <div class="modal fade" id="emailTemplateModal" tabindex="-1" role="dialog" aria-labelledby="emailTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="emailTemplateModalLabel">
                        <i class="fas fa-envelope"></i> Template Email
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="emailSubject"><strong>Subject:</strong></label>
                        <input type="text" id="emailSubject" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="emailBody"><strong>Body Email:</strong></label>
                        <textarea id="emailBody" class="form-control" rows="15" readonly style="white-space: pre-wrap; font-family: monospace;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                    <button type="button" class="btn btn-primary" onclick="copyEmailTemplate()">
                        <i class="fas fa-copy"></i> Copy Template
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Variables untuk tracking
    let totalRows = {{ isset($data) ? $data->count() : 0 }};
    
    // Set periode berdasarkan tanggal yang dipilih saat page load
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalInput = document.getElementById('tanggal');
        const periodeSelect = document.getElementById('periode');
        const today = new Date().toISOString().split('T')[0];
        
        // Update period info display
        updatePeriodInfo();
        
        // Jika tanggal adalah hari ini, set periode ke "today"
        if (tanggalInput.value === today) {
            periodeSelect.value = 'today';
            handlePeriodeChange();
        }
    });
    
    // Update period info display
    function updatePeriodInfo() {
        const tanggalInput = document.getElementById('tanggal');
        const periodInfo = document.getElementById('periodInfo');
        
        if (tanggalInput.value) {
            const date = new Date(tanggalInput.value);
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                weekday: 'long'
            };
            periodInfo.textContent = date.toLocaleDateString('id-ID', options);
        }
    }
    
    // Handle periode change
    function handlePeriodeChange() {
        const periode = document.getElementById('periode').value;
        const tanggalInput = document.getElementById('tanggal');
        const today = new Date().toISOString().split('T')[0];
        
        // Set tanggal berdasarkan periode
        if (periode === 'today') {
            tanggalInput.value = today;
        } else if (periode === 'week') {
            // Set ke awal minggu ini (Senin)
            const now = new Date();
            const monday = new Date(now.setDate(now.getDate() - now.getDay() + 1));
            tanggalInput.value = monday.toISOString().split('T')[0];
        } else if (periode === 'month') {
            // Set ke awal bulan ini
            const now = new Date();
            const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
            tanggalInput.value = firstDay.toISOString().split('T')[0];
        }
        
        // Update period info
        updatePeriodInfo();
        
        // Hanya redirect jika bukan custom
        if (periode !== 'custom') {
            applyFilters();
        }
    }
    
    // Apply filters (untuk server-side filtering)
    function applyFilters() {
        const tanggal = document.getElementById('tanggal').value;
        const jenisLayanan = document.getElementById('jenis_layanan').value;
        
        // Update period info
        updatePeriodInfo();
        
        // Buat URL dengan parameter
        const params = new URLSearchParams();
        if (tanggal) {
            params.append('tanggal', tanggal);
        }
        params.append('jenis_layanan', jenisLayanan);
        
        // Redirect dengan parameter baru hanya jika ada perubahan
        const currentUrl = new URL(window.location);
        const newUrl = `{{ route('admin.komunikasi.email.index') }}?${params.toString()}`;
        
        if (currentUrl.href !== newUrl) {
            window.location.href = newUrl;
        }
    }
    
    // Real-time search function
    function searchTable() {
        const searchTerm = document.getElementById('search').value.toLowerCase();
        const jenisLayanan = document.getElementById('jenis_layanan').value;
        const rows = document.querySelectorAll('#dataTable tbody .table-row');
        let visibleCount = 0;
        
        rows.forEach(row => {
            const nama = row.querySelector('.searchable-name').textContent.toLowerCase();
            const email = row.querySelector('.searchable-email').textContent.toLowerCase();
            const layananBadge = row.querySelector('.layanan-badge');
            const layananValue = layananBadge ? layananBadge.getAttribute('data-layanan') : '';
            
            // Check search criteria
            const matchesSearch = searchTerm === '' || 
                                nama.includes(searchTerm) || 
                                email.includes(searchTerm);
            
            // Check jenis layanan filter
            const matchesLayanan = jenisLayanan === 'all' || layananValue === jenisLayanan;
            
            if (matchesSearch && matchesLayanan) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Update info
        updateResultInfo(visibleCount);
        
        // Show/hide no results message
        const noResultsMsg = document.getElementById('noResultsMessage');
        const dataTable = document.getElementById('dataTable');
        
        if (visibleCount === 0 && totalRows > 0) {
            noResultsMsg.style.display = 'block';
            dataTable.style.display = 'none';
        } else {
            noResultsMsg.style.display = 'none';
            dataTable.style.display = 'table';
        }
    }
    
    // Update result info
    function updateResultInfo(visibleCount) {
        document.getElementById('totalCount').textContent = totalRows;
        document.getElementById('visibleCount').textContent = visibleCount;
    }
    
    // Email functions (unchanged)
    function openEmailClient(email, nama, jenisLayanan, noRekamMedis, tanggal, status, noAntrian) {
        const subject = `Informasi Layanan Kesehatan - ${jenisLayanan}`;
        
        let body = `Kepada Yth. ${nama},\n\n`;
        body += `Kami ingin menginformasikan status layanan kesehatan Anda:\n\n`;
        body += `Detail Layanan:\n`;
        body += `• Jenis Layanan: ${jenisLayanan}\n`;
        body += `• No. Rekam Medis: ${noRekamMedis}\n`;
        body += `• Tanggal Layanan: ${tanggal}\n`;
        
        if (noAntrian !== '') {
            body += `• No. Antrian: ${noAntrian}\n`;
        }
        
        body += `• Status Saat Ini: ${status}\n\n`;
        body += `Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami.\n\n`;
        body += `Terima kasih atas kepercayaan Anda.\n\n`;
        body += `Salam hormat,\n`;
        body += `Tim Klinik Kesehatan`;
        
        const encodedSubject = encodeURIComponent(subject);
        const encodedBody = encodeURIComponent(body);
        const emailUrl = `mailto:${email}?subject=${encodedSubject}&body=${encodedBody}`;
        window.location.href = emailUrl;
    }

    function showEmailTemplate(nama, jenisLayanan, noRekamMedis, tanggal, status, noAntrian) {
        const subject = `Informasi Layanan Kesehatan - ${jenisLayanan}`;
        document.getElementById('emailSubject').value = subject;
        
        let body = `Kepada Yth. ${nama},\n\n`;
        body += `Kami ingin menginformasikan status layanan kesehatan Anda:\n\n`;
        body += `Detail Layanan:\n`;
        body += `• Jenis Layanan: ${jenisLayanan}\n`;
        body += `• No. Rekam Medis: ${noRekamMedis}\n`;
        body += `• Tanggal Layanan: ${tanggal}\n`;
        
        if (noAntrian !== '') {
            body += `• No. Antrian: ${noAntrian}\n`;
        }
        
        body += `• Status Saat Ini: ${status}\n\n`;
        body += `Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami.\n\n`;
        body += `Terima kasih atas kepercayaan Anda.\n\n`;
        body += `Salam hormat,\n`;
        body += `Tim Klinik Kesehatan`;
        
        document.getElementById('emailBody').value = body;
    }

    function copyEmailTemplate() {
        const subject = document.getElementById('emailSubject').value;
        const body = document.getElementById('emailBody').value;
        const fullTemplate = `Subject: ${subject}\n\n${body}`;
        
        navigator.clipboard.writeText(fullTemplate).then(function() {
            alert('Template email berhasil disalin ke clipboard!');
        }).catch(function(err) {
            console.error('Gagal menyalin template: ', err);
            const textArea = document.createElement('textarea');
            textArea.value = fullTemplate;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Template email berhasil disalin ke clipboard!');
        });
    }
    </script>

</x-admin-layout>
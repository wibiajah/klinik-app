<x-admin-layout>
    <x-slot name="title">Manajemen WhatsApp</x-slot>
<style>:root {
    --primary-green: #00bc84;
    --light-gray: #f8f9fa;
    --dark-gray: #6c757d;
    --border-gray: #e0e0e0;
}

.custom-card {
    border: 1px solid var(--border-gray);
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
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



.role-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    margin-right: 4px;
}

.permission-badge {
    display: inline-block;
    padding: 4px 8px;
    margin: 1px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 500;
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

.table-responsive {
    border-radius: 0 0 8px 8px;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 188, 132, 0.05);
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
    padding: 6px 10px;
    border-radius: 12px;
}</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">
                                <i class="fab fa-whatsapp text-success"></i>
                                Manajemen WhatsApp Pasien
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
                                <li class="breadcrumb-item active" aria-current="page">Manajemen WhatsApp Pasien</li>
                            </ol>
                        </nav>

                        <!-- Period Info Banner -->
                        <div class="alert alert-success mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fab fa-whatsapp me-2"></i>
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
                                            <button type="button" class="btn btn-success" onclick="applyFilters()">
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
                                    <label for="search">Cari Nama/No. HP Pasien</label>
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control" value="{{ request('search') }}" 
                                               placeholder="Ketik nama atau nomor HP untuk mencari..." oninput="searchTable()">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                   
                                </div>
                            </div>
                        </div>

                        <!-- Result Summary -->
                        

                        <!-- Data Table -->
                       @if(isset($data) && $data->count() > 0)
<div class="custom-card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
        <h6 class="m-0 fw-bold" style="color: #333;">
            <i class="fab fa-whatsapp text-success me-2"></i>
            Daftar Pasien WhatsApp
        </h6>
        <span class="badge custom-badge">{{ $data->count() }} Total</span>
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
                            Nama Pasien
                            <i class="fas fa-sort sort-icon"></i>
                        </th>
                        <th class="table-header" onclick="sortTable(2)">
                            No. WhatsApp
                            <i class="fas fa-sort sort-icon"></i>
                        </th>
                        <th class="table-header" onclick="sortTable(3)">
                            Jenis Layanan
                            <i class="fas fa-sort sort-icon"></i>
                        </th>
                        <th class="table-header" onclick="sortTable(4)">
                            No. Rekam Medis
                            <i class="fas fa-sort sort-icon"></i>
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
                    @foreach($data as $index => $item)
                    <tr class="table-row">
                        <td class="fw-semibold">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                
                                <div>
                                    <div class="fw-semibold searchable-name">{{ $item['nama'] }}</div>
                                    <div class="mt-1">
                                        @if($item['is_lpk_sentosa'])
                                            <span class="role-badge" style="background-color: #fff3cd; color: #856404;">
                                                <i class="fas fa-star me-1"></i>PMI_Sentosa
                                            </span>
                                        @else
                                            <span class="role-badge" style="background-color: #f5f5f5; color: #757575;">
                                                <i class="fas fa-user me-1"></i>Umum
                                            </span>
                                        @endif
                                        @if(!empty($item['no_antrian']))
                                            <span class="role-badge ml-1" style="background-color: #e3f2fd; color: #1976d2;">
                                                <i class="fas fa-ticket-alt me-1"></i>{{ $item['no_antrian'] }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item['no_hp']) }}" target="_blank" class="text-decoration-none text-success fw-semibold">
                                <i class="fab fa-whatsapp me-1"></i> 
                                <span class="searchable-phone">{{ $item['no_hp'] }}</span>
                            </a>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="role-badge layanan-badge
                                    @if($item['jenis_layanan'] == 'Pemeriksaan Umum') 
                                        style="background-color: #e3f2fd; color: #1976d2;"
                                    @elseif($item['jenis_layanan'] == 'Laboratorium') 
                                        style="background-color: #e8f5e8; color: #2e7d32;"
                                    @elseif($item['jenis_layanan'] == 'Radiologi') 
                                        style="background-color: #fff3cd; color: #856404;"
                                    @else 
                                        style="background-color: #f5f5f5; color: #757575;"
                                    @endif" data-layanan="{{ strtolower(str_replace(' ', '_', $item['jenis_layanan'])) }}">
                                    {{ $item['jenis_layanan'] }}
                                </span>
                                <small class="text-muted mt-1">{{ $item['keluhan'] }}</small>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="permission-badge" style="background-color: #f3e5f5; color: #7b1fa2; font-family: monospace;">
                                {{ $item['no_rekam_medis'] }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if(strpos($item['status'], 'Menunggu') !== false)
                                <span class="badge" style="background-color: #fff3cd; color: #856404;">
                                    <i class="fas fa-clock me-1"></i>{{ $item['status'] }}
                                </span>
                            @elseif(strpos($item['status'], 'Sedang') !== false)
                                <span class="badge" style="background-color: #e3f2fd; color: #1976d2;">
                                    <i class="fas fa-spinner me-1"></i>{{ $item['status'] }}
                                </span>
                            @elseif(strpos($item['status'], 'Selesai') !== false)
                                <span class="badge" style="background-color: var(--primary-green); color: white;">
                                    <i class="fas fa-check-circle me-1"></i>{{ $item['status'] }}
                                </span>
                            @else
                                <span class="badge" style="background-color: #f5f5f5; color: #757575;">
                                    {{ $item['status'] }}
                                </span>
                            @endif
                        </td>
                        <td>
                            
<div class="action-buttons d-flex gap-1">
    <button class="btn btn-success btn-sm" type="button" 
            onclick="openWhatsApp('{{ $item['no_hp'] }}', '{{ $item['nama'] }}', '{{ $item['jenis_layanan'] }}', '{{ $item['no_rekam_medis'] }}', '{{ $item['tanggal'] }}', '{{ $item['status'] }}', '{{ $item['no_antrian'] ?? '' }}')"
            style="padding: 6px 10px; border-radius: 6px; font-size: 12px;">
        <i class="fab fa-whatsapp me-1"></i> Kirim
    </button>
    
    <button class="btn btn-warning btn-sm" type="button" 
            onclick="showWhatsAppTemplate('{{ $item['nama'] }}', '{{ $item['jenis_layanan'] }}', '{{ $item['no_rekam_medis'] }}', '{{ $item['tanggal'] }}', '{{ $item['status'] }}', '{{ $item['no_antrian'] ?? '' }}')" 
            data-bs-toggle="modal" data-bs-target="#whatsappTemplateModal"
            style="padding: 6px 10px; border-radius: 6px; font-size: 12px;">
        <i class="fas fa-eye me-1"></i> 
    </button>
</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- No Results Message -->
<div id="noResultsMessage" class="custom-card" style="display: none;">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <p class="mb-0">Tidak ditemukan hasil pencarian</p>
            <small class="text-muted">Coba ubah kata kunci pencarian atau filter yang digunakan.</small>
        </div>
    </div>
</div>

@else
<div class="custom-card">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <p class="mb-0">Tidak ada data pasien</p>
            <small class="text-muted">Tidak ditemukan pasien dengan nomor WhatsApp pada periode yang dipilih.</small>
        </div>
    </div>
</div>
@endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Template WhatsApp -->
    <div class="modal fade" id="whatsappTemplateModal" tabindex="-1" role="dialog" aria-labelledby="whatsappTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="whatsappTemplateModalLabel">
                        <i class="fab fa-whatsapp"></i> Template WhatsApp
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="whatsappMessage"><strong>Pesan WhatsApp:</strong></label>
                        <textarea id="whatsappMessage" class="form-control" rows="15" readonly style="white-space: pre-wrap; font-family: monospace;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                    <button type="button" class="btn btn-success" onclick="copyWhatsAppTemplate()">
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
        const newUrl = `{{ route('admin.komunikasi.whatsapp.index') }}?${params.toString()}`;
        
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
            const phone = row.querySelector('.searchable-phone').textContent.toLowerCase();
            const layananBadge = row.querySelector('.layanan-badge');
            const layananValue = layananBadge ? layananBadge.getAttribute('data-layanan') : '';
            
            // Check search criteria
            const matchesSearch = searchTerm === '' || 
                                nama.includes(searchTerm) || 
                                phone.includes(searchTerm);
            
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
    
    // WhatsApp functions
    function openWhatsApp(noHp, nama, jenisLayanan, noRekamMedis, tanggal, status, noAntrian) {
        // Buat pesan WhatsApp
        let message = `Halo ${nama},\n\n`;
        message += `Kami ingin menginformasikan status layanan kesehatan Anda:\n\n`;
        message += `📋 *Detail Layanan:*\n`;
        message += `• Jenis Layanan: ${jenisLayanan}\n`;
        message += `• No. Rekam Medis: ${noRekamMedis}\n`;
        message += `• Tanggal Layanan: ${tanggal}\n`;
        
        if (noAntrian !== '') {
            message += `• No. Antrian: ${noAntrian}\n`;
        }
        
        message += `• Status Saat Ini: ${status}\n\n`;
        message += `Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami.\n\n`;
        message += `Terima kasih atas kepercayaan Anda. 🙏\n\n`;
        message += `_Tim Klinik Kesehatan_`;
        
        // Bersihkan nomor HP
        let cleanPhone = noHp.replace(/[^0-9]/g, '');
        if (cleanPhone.startsWith('0')) {
            cleanPhone = '62' + cleanPhone.substring(1);
        } else if (!cleanPhone.startsWith('62')) {
            cleanPhone = '62' + cleanPhone;
        }
        
        // Encode pesan untuk URL
        const encodedMessage = encodeURIComponent(message);
        
        // Buka WhatsApp
        const whatsappUrl = `https://wa.me/${cleanPhone}?text=${encodedMessage}`;
        window.open(whatsappUrl, '_blank');
    }

    function showWhatsAppTemplate(nama, jenisLayanan, noRekamMedis, tanggal, status, noAntrian) {
        // Set pesan template
        let message = `Halo ${nama},\n\n`;
        message += `Kami ingin menginformasikan status layanan kesehatan Anda:\n\n`;
        message += `📋 *Detail Layanan:*\n`;
        message += `• Jenis Layanan: ${jenisLayanan}\n`;
        message += `• No. Rekam Medis: ${noRekamMedis}\n`;
        message += `• Tanggal Layanan: ${tanggal}\n`;
        
        if (noAntrian !== '') {
            message += `• No. Antrian: ${noAntrian}\n`;
        }
        
        message += `• Status Saat Ini: ${status}\n\n`;
        message += `Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami.\n\n`;
        message += `Terima kasih atas kepercayaan Anda. 🙏\n\n`;
        message += `_Tim Klinik Kesehatan_`;
        
        document.getElementById('whatsappMessage').value = message;
    }

    function copyWhatsAppTemplate() {
        const message = document.getElementById('whatsappMessage').value;
        
        navigator.clipboard.writeText(message).then(function() {
            alert('Template WhatsApp berhasil disalin ke clipboard!');
        }).catch(function(err) {
            console.error('Gagal menyalin template: ', err);
            const textArea = document.createElement('textarea');
            textArea.value = message;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Template WhatsApp berhasil disalin ke clipboard!');
        });
    }

    // Format nomor HP saat mengetik di pencarian
    document.getElementById('search').addEventListener('input', function(e) {
        let value = e.target.value;
        // Auto-format phone numbers
        if (/^[0-9+\-\s()]+$/.test(value) && value.length > 5) {
            let cleaned = value.replace(/[^0-9]/g, '');
            if (cleaned.startsWith('62')) {
                e.target.value = '+62 ' + cleaned.substring(2);
            } else if (cleaned.startsWith('0')) {
                e.target.value = cleaned;
            } else {
                e.target.value = value;
            }
        }
    });
    </script>

</x-admin-layout>
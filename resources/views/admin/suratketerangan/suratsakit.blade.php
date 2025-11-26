<x-admin-layout>
    <x-slot name="title">Template Surat Sakit</x-slot>

   
        <style>
        .template-preview {
            font-family: 'Times New Roman', serif;
        }

        .template-content {
            line-height: 1.6;
        }

        .template-content table {
            width: 100%;
            margin-bottom: 15px;
        }

        .template-content table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .template-content .text-center {
            text-align: center;
        }

        .template-content .text-right {
            text-align: right;
        }

        .template-content .mb-3 {
            margin-bottom: 15px;
        }

        .template-content .mb-4 {
            margin-bottom: 20px;
        }

        .template-content .mb-5 {
            margin-bottom: 25px;
        }

        .template-content .mt-5 {
            margin-top: 25px;
        }

        #templateEditor {
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }

        .edit-mode {
            border: 2px dashed #dc3545 !important;
            cursor: text;
        }

        .card {
            border-radius: 10px;
        }

        .btn {
            border-radius: 6px;
        }
        </style>
 

    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Template Surat Sakit</h1>
                <p class="text-muted">Kelola template dan cetak surat keterangan sakit</p>
            </div>
            <div>
                <a href="{{ route('admin.suratketerangan.riwayat') }}" class="btn btn-outline-primary">
                    <i class="fas fa-history"></i> Riwayat
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Live Preview Panel -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-eye"></i> Live Preview Template
                        </h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-light btn-sm" id="editModeBtn">
                                <i class="fas fa-edit"></i> Mode Edit
                            </button>
                            <button type="button" class="btn btn-light btn-sm" id="previewModeBtn">
                                <i class="fas fa-eye"></i> Mode Preview
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-4" style="background: #f8f9fa;">
                        <!-- Template Preview Container -->
                        <div id="templatePreview" class="template-preview bg-white p-4 shadow-sm" style="min-height: 600px; border: 1px solid #dee2e6;">
                            <div class="template-content" id="templateContent">
                                {!! $template->content ?? '<p class="text-muted">Template tidak ditemukan. Klik tombol edit untuk membuat template baru.</p>' !!}
                            </div>
                        </div>

                        <!-- Inline Editor (Hidden by default) -->
                        <div id="inlineEditor" class="mt-3" style="display: none;">
                            <textarea id="templateEditor" class="form-control" rows="20" placeholder="Masukkan konten template...">{{ $template->content ?? '' }}</textarea>
                            <div class="mt-2">
                                <button type="button" class="btn btn-success" id="saveTemplateBtn">
                                    <i class="fas fa-save"></i> Simpan Template
                                </button>
                                <button type="button" class="btn btn-secondary" id="cancelEditBtn">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Panel -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="fas fa-cogs"></i> Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Print Button -->
                        <div class="d-grid gap-2 mb-3">
                            <a href="{{ route('admin.suratketerangan.cetak', 'sakit') }}" 
                               class="btn btn-danger btn-lg" 
                               id="cetakSuratBtn">
                                <i class="fas fa-print"></i> Cetak Surat Kosong
                            </a>
                        </div>

                        <!-- Template Info -->
                        <div class="mb-3">
                            <h6 class="text-muted">Informasi Template:</h6>
                            <ul class="list-unstyled small">
                                <li><strong>Jenis:</strong> Surat Sakit</li>
                                <li><strong>Terakhir diubah:</strong> 
                                    <span id="lastUpdated">
                                        {{ $template ? $template->updated_at->format('d/m/Y H:i') : 'Belum ada data' }}
                                    </span>
                                </li>
                                <li><strong>Status:</strong> 
                                    <span class="badge bg-success">Siap Cetak</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mb-3">
                            <h6 class="text-muted">Quick Actions:</h6>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-danger btn-sm" id="previewPdfBtn">
                                    <i class="fas fa-file-pdf"></i> Preview PDF
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm" id="resetTemplateBtn">
                                    <i class="fas fa-undo"></i> Reset ke Default
                                </button>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="mt-4">
                            <h6 class="text-muted">Navigasi:</h6>
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.suratketerangan.suratsehat') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-file-medical-alt"></i> Template Surat Sehat
                                </a>
                                <a href="{{ route('admin.suratketerangan.riwayat') }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-history"></i> Riwayat Pencetakan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="card shadow-sm border-0 mt-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-lightbulb"></i> Tips Penggunaan
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                Klik "Mode Edit" untuk mengubah template
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                Template otomatis tersimpan saat edit
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                PDF yang dicetak berisi field kosong untuk diisi manual
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                Sertakan periode istirahat dan diagnosis
                            </li>
                            <li>
                                <i class="fas fa-check text-success"></i>
                                Gunakan HTML untuk formatting text
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="saveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Sukses</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                Template berhasil disimpan!
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" 
         style="background: rgba(0,0,0,0.5); z-index: 9999; display: none !important;">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const editModeBtn = document.getElementById('editModeBtn');
            const previewModeBtn = document.getElementById('previewModeBtn');
            const inlineEditor = document.getElementById('inlineEditor');
            const templatePreview = document.getElementById('templatePreview');
            const templateContent = document.getElementById('templateContent');
            const templateEditor = document.getElementById('templateEditor');
            const saveTemplateBtn = document.getElementById('saveTemplateBtn');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const resetTemplateBtn = document.getElementById('resetTemplateBtn');
            const saveToast = new bootstrap.Toast(document.getElementById('saveToast'));
            const loadingOverlay = document.getElementById('loadingOverlay');

            let isEditMode = false;
            let originalContent = templateEditor.value;

            // Toggle Edit Mode
            editModeBtn.addEventListener('click', function() {
                enterEditMode();
            });

            previewModeBtn.addEventListener('click', function() {
                exitEditMode();
            });

            // Enter Edit Mode
            function enterEditMode() {
                isEditMode = true;
                inlineEditor.style.display = 'block';
                templatePreview.classList.add('edit-mode');
                editModeBtn.classList.add('active');
                previewModeBtn.classList.remove('active');
                templateEditor.focus();
            }

            // Exit Edit Mode
            function exitEditMode() {
                isEditMode = false;
                inlineEditor.style.display = 'none';
                templatePreview.classList.remove('edit-mode');
                editModeBtn.classList.remove('active');
                previewModeBtn.classList.add('active');
                
                // Update preview content
                templateContent.innerHTML = templateEditor.value;
            }

            // Save Template
            saveTemplateBtn.addEventListener('click', function() {
                saveTemplate();
            });

            // Cancel Edit
            cancelEditBtn.addEventListener('click', function() {
                templateEditor.value = originalContent;
                exitEditMode();
            });

            // Auto-save on content change (debounced)
            let saveTimeout;
            templateEditor.addEventListener('input', function() {
                clearTimeout(saveTimeout);
                saveTimeout = setTimeout(() => {
                    autoSaveTemplate();
                }, 2000); // Auto-save after 2 seconds of no typing
            });

            // Save Template Function
            function saveTemplate() {
    const content = templateEditor.value.trim();
    
    if (!content) {
        alert('Template tidak boleh kosong!');
        return;
    }

    // Cara alternatif mengambil CSRF token
    let csrfToken = '';
    
    // Method 1: Dari meta tag
    const metaToken = document.querySelector('meta[name="csrf-token"]');
    if (metaToken) {
        csrfToken = metaToken.getAttribute('content');
    }
    
    // Method 2: Dari Laravel global (fallback)
    if (!csrfToken && typeof window.Laravel !== 'undefined') {
        csrfToken = window.Laravel.csrfToken;
    }
    
    // Method 3: Dari form tersembunyi (jika ada)
    if (!csrfToken) {
        const hiddenInput = document.querySelector('input[name="_token"]');
        if (hiddenInput) {
            csrfToken = hiddenInput.value;
        }
    }

    if (!csrfToken) {
        alert('CSRF token tidak ditemukan. Refresh halaman dan coba lagi.');
        return;
    }

    showLoading(true);

    fetch('{{ route("admin.suratketerangan.update.template") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            jenis_surat: 'sakit', // PERUBAHAN: dari 'sehat' ke 'sakit'
            content: content
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        showLoading(false);
        
        if (data.success) {
            originalContent = content;
            templateContent.innerHTML = content;
            updateLastModified();
            showToast('Template berhasil disimpan!');
            exitEditMode();
        } else {
            alert('Gagal menyimpan template: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        showLoading(false);
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan template: ' + error.message);
    });
}

            // Auto-save Template
            function autoSaveTemplate() {
                const content = templateEditor.value.trim();
                if (content && content !== originalContent) {
                    fetch('{{ route("admin.suratketerangan.update.template") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            jenis_surat: 'sakit', // PERUBAHAN: dari 'sehat' ke 'sakit'
                            content: content
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            originalContent = content;
                            templateContent.innerHTML = content;
                            updateLastModified();
                            showMiniToast('Auto-saved');
                        }
                    })
                    .catch(error => {
                        console.error('Auto-save error:', error);
                    });
                }
            }

            // Reset Template
            resetTemplateBtn.addEventListener('click', function() {
                if (confirm('Yakin ingin reset template ke default? Perubahan yang belum disimpan akan hilang.')) {
                    location.reload();
                }
            });

            // Show Loading
            function showLoading(show) {
                loadingOverlay.style.display = show ? 'flex' : 'none';
            }

            // Show Toast
            function showToast(message) {
                document.querySelector('#saveToast .toast-body').textContent = message;
                saveToast.show();
            }

            // Show Mini Toast (for auto-save)
            function showMiniToast(message) {
                // Create temporary mini toast
                const miniToast = document.createElement('div');
                miniToast.className = 'position-fixed bottom-0 end-0 p-2';
                miniToast.innerHTML = `
                    <div class="badge bg-success">
                        <i class="fas fa-check"></i> ${message}
                    </div>
                `;
                document.body.appendChild(miniToast);
                
                setTimeout(() => {
                    miniToast.remove();
                }, 2000);
            }

            // Update Last Modified
            function updateLastModified() {
                const now = new Date();
                const formatted = now.toLocaleDateString('id-ID') + ' ' + now.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
                document.getElementById('lastUpdated').textContent = formatted;
            }

            // PDF Preview
            document.getElementById('previewPdfBtn').addEventListener('click', function() {
                window.open('{{ route("admin.suratketerangan.cetak", "sakit") }}', '_blank');
            });

            // Cetak Surat with confirmation
            document.getElementById('cetakSuratBtn').addEventListener('click', function(e) {
                e.preventDefault();
                
                if (confirm('Cetak surat keterangan sakit kosong?')) {
                    window.location.href = this.href;
                }
            });
        });
        </script>

</x-admin-layout>
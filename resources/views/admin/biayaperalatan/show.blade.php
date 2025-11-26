<x-admin-layout>
    <x-slot name="title">Detail Peralatan - {{ $peralatan->nama_alat }}</x-slot>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Detail Peralatan {{ $peralatan->kategori_text }}
                        </h4>
                        <div class="btn-group">
                            <a href="{{ route('admin.biaya-peralatan.index', $kategori) }}" 
                               class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <a href="{{ route('admin.biaya-peralatan.edit', [$kategori, $peralatan->id]) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Gambar Peralatan -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Gambar Peralatan</h6>
                                    </div>
                                   <div class="card-body text-center">
    @if($peralatan->gambar)
        <img src="{{ asset('storage/' . $peralatan->gambar) }}" 
             alt="{{ $peralatan->nama_alat }}" 
             class="img-fluid rounded shadow-sm"
             style="max-height: 300px; object-fit: cover;"
             onerror="this.src='{{ asset('images/no-image.png') }}'">
    @else
        <div class="d-flex justify-content-center align-items-center rounded shadow-sm"
             style="height: 300px; background-color: #ddd; font-size: 36px;">
            {{ strtoupper(substr($peralatan->nama_alat, 0, 2)) }}
        </div>
    @endif
</div>

                                </div>

                                <!-- Status dan Informasi Singkat -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Status & Info</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Status:</label>
                                            <span class="badge {{ $peralatan->status_badge }} ms-2">
                                                {{ $peralatan->status_text }}
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Kategori:</label>
                                            <span class="badge bg-info ms-2">{{ $peralatan->kategori_text }}</span>
                                        </div>
                                        @if($peralatan->umur_alat)
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Umur Alat:</label>
                                            <span class="ms-2">{{ $peralatan->umur_alat }} tahun</span>
                                        </div>
                                        @endif
                                        @if($peralatan->is_maintenance_due)
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Maintenance segera diperlukan!
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Informasi -->
                            <div class="col-md-8">
                                <div class="row">
                                    <!-- Informasi Umum -->
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Informasi Umum
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Nama Alat:</label>
                                                            <p class="mb-0">{{ $peralatan->nama_alat }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Merek:</label>
                                                            <p class="mb-0">{{ $peralatan->merek }}</p>
                                                        </div>
                                                        @if($peralatan->model)
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Model:</label>
                                                            <p class="mb-0">{{ $peralatan->model }}</p>
                                                        </div>
                                                        @endif
                                                        @if($peralatan->nomor_seri)
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Nomor Seri:</label>
                                                            <p class="mb-0">{{ $peralatan->nomor_seri }}</p>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($peralatan->tahun_pembelian)
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Tahun Pembelian:</label>
                                                            <p class="mb-0">{{ $peralatan->tahun_pembelian }}</p>
                                                        </div>
                                                        @endif
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Lokasi:</label>
                                                            <p class="mb-0">{{ $peralatan->lokasi }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Penanggung Jawab:</label>
                                                            <p class="mb-0">{{ $peralatan->penanggung_jawab }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Biaya -->
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-money-bill-wave me-2"></i>
                                                    Informasi Biaya
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="text-center p-3 bg-light rounded">
                                                            <h6 class="mb-2">Harga Beli</h6>
                                                            <h5 class="text-primary mb-0">{{ $peralatan->formatted_harga_beli }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="text-center p-3 bg-light rounded">
                                                            <h6 class="mb-2">Biaya Operasional</h6>
                                                            <h5 class="text-info mb-0">{{ $peralatan->formatted_biaya_operasional }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="text-center p-3 bg-light rounded">
                                                            <h6 class="mb-2">Biaya Perawatan</h6>
                                                            <h5 class="text-warning mb-0">{{ $peralatan->formatted_biaya_perawatan }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="text-center p-3 bg-success text-white rounded">
                                                            <h6 class="mb-2">Total Biaya</h6>
                                                            <h5 class="mb-0">{{ $peralatan->formatted_total_biaya }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Maintenance -->
                                    @if($peralatan->tanggal_maintenance_terakhir || $peralatan->tanggal_maintenance_selanjutnya)
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-tools me-2"></i>
                                                    Informasi Maintenance
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @if($peralatan->tanggal_maintenance_terakhir)
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Maintenance Terakhir:</label>
                                                            <p class="mb-0">{{ $peralatan->tanggal_maintenance_terakhir->format('d/m/Y') }}</p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($peralatan->tanggal_maintenance_selanjutnya)
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Maintenance Selanjutnya:</label>
                                                            <p class="mb-0 {{ $peralatan->is_maintenance_due ? 'text-danger fw-bold' : '' }}">
                                                                {{ $peralatan->tanggal_maintenance_selanjutnya->format('d/m/Y') }}
                                                                @if($peralatan->is_maintenance_due)
                                                                    <span class="badge bg-danger ms-2">Segera!</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Keterangan -->
                                    @if($peralatan->keterangan)
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-comment-alt me-2"></i>
                                                    Keterangan
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0">{{ $peralatan->keterangan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Informasi Audit -->
                                    <div class="col-12 mt-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-clock me-2"></i>
                                                    Informasi Audit
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Dibuat pada:</label>
                                                            <p class="mb-0">{{ $peralatan->created_at->format('d/m/Y H:i') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Diperbarui pada:</label>
                                                            <p class="mb-0">{{ $peralatan->updated_at->format('d/m/Y H:i') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.biaya-peralatan.index', $kategori) }}" 
                                   class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar
                                </a>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.biaya-peralatan.edit', [$kategori, $peralatan->id]) }}" 
                                       class="btn btn-warning">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            onclick="confirmDelete({{ $peralatan->id }})">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form untuk hapus data -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>


    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data peralatan ini?')) {
                const form = document.getElementById('deleteForm');
                form.action = `{{ route('admin.biaya-peralatan.destroy', [$kategori, '__ID__']) }}`.replace('__ID__', id);
                form.submit();
            }
        }
    </script>

</x-admin-layout>
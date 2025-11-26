<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Peralatan {{ ucfirst(str_replace('-', ' ', $kategori)) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Form Edit Peralatan</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.biaya-peralatan.show', [$kategori, $peralatan->id]) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                            <a href="{{ route('admin.biaya-peralatan.index', $kategori) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.biaya-peralatan.update', [$kategori, $peralatan->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Informasi Dasar -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informasi Dasar</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="nama_alat" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" 
                                                   id="nama_alat" name="nama_alat" value="{{ old('nama_alat', $peralatan->nama_alat) }}" required>
                                            @error('nama_alat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="merek" class="form-label">Merek <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('merek') is-invalid @enderror" 
                                                   id="merek" name="merek" value="{{ old('merek', $peralatan->merek) }}" required>
                                            @error('merek')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="model" class="form-label">Model</label>
                                            <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                                   id="model" name="model" value="{{ old('model', $peralatan->model) }}">
                                            @error('model')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="nomor_seri" class="form-label">Nomor Seri</label>
                                            <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror" 
                                                   id="nomor_seri" name="nomor_seri" value="{{ old('nomor_seri', $peralatan->nomor_seri) }}">
                                            @error('nomor_seri')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="tahun_pembelian" class="form-label">Tahun Pembelian</label>
                                            <input type="number" class="form-control @error('tahun_pembelian') is-invalid @enderror" 
                                                   id="tahun_pembelian" name="tahun_pembelian" value="{{ old('tahun_pembelian', $peralatan->tahun_pembelian) }}" 
                                                   min="1900" max="{{ date('Y') }}">
                                            @error('tahun_pembelian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Gambar Alat</label>
                                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                                   id="gambar" name="gambar" accept="image/*">
                                            <div class="form-text">Format: JPEG, PNG, JPG, GIF. Max: 2MB</div>
                                            @error('gambar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            
                                            @if($peralatan->gambar)
                                                <div class="mt-2">
                                                    <label class="form-label">Gambar Saat Ini:</label>
<div class="d-flex align-items-center">
    @if($peralatan->gambar)
        <img src="{{ asset('storage/' . $peralatan->gambar) }}" 
             alt="Gambar {{ $peralatan->nama_peralatan }}" 
             class="img-thumbnail me-3" style="max-width: 200px;">
    @else
        <div class="img-thumbnail me-3 d-flex justify-content-center align-items-center" style="width: 200px; height: 200px; background-color: #ddd; font-size: 24px;">
            {{ strtoupper(substr($peralatan->nama_peralatan, 0, 2)) }}
        </div>
    @endif
    <div>
        <!-- Bisa ditambah detail peralatan di sini -->
    </div>
</div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Biaya & Status -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informasi Biaya & Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="harga_beli" class="form-label">Harga Beli <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" 
                                                       id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $peralatan->harga_beli) }}" 
                                                       min="0" step="0.01" required>
                                                @error('harga_beli')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="biaya_operasional" class="form-label">Biaya Operasional <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control @error('biaya_operasional') is-invalid @enderror" 
                                                       id="biaya_operasional" name="biaya_operasional" value="{{ old('biaya_operasional', $peralatan->biaya_operasional) }}" 
                                                       min="0" step="0.01" required>
                                                @error('biaya_operasional')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="biaya_perawatan" class="form-label">Biaya Perawatan <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control @error('biaya_perawatan') is-invalid @enderror" 
                                                       id="biaya_perawatan" name="biaya_perawatan" value="{{ old('biaya_perawatan', $peralatan->biaya_perawatan) }}" 
                                                       min="0" step="0.01" required>
                                                @error('biaya_perawatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="aktif" {{ old('status', $peralatan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ old('status', $peralatan->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                <option value="rusak" {{ old('status', $peralatan->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                <option value="maintenance" {{ old('status', $peralatan->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                                   id="lokasi" name="lokasi" value="{{ old('lokasi', $peralatan->lokasi) }}" required>
                                            @error('lokasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="penanggung_jawab" class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" 
                                                   id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab', $peralatan->penanggung_jawab) }}" required>
                                            @error('penanggung_jawab')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Total Biaya Display -->
                                        <div class="alert alert-info">
                                            <strong>Total Biaya Saat Ini:</strong> 
                                            <span id="total-biaya">{{ $peralatan->formatted_total_biaya }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Maintenance -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Informasi Maintenance</h6>
                                @if($peralatan->is_maintenance_due)
                                    <span class="badge bg-warning">Maintenance Segera!</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tanggal_maintenance_terakhir" class="form-label">Tanggal Maintenance Terakhir</label>
                                            <input type="date" class="form-control @error('tanggal_maintenance_terakhir') is-invalid @enderror" 
                                                   id="tanggal_maintenance_terakhir" name="tanggal_maintenance_terakhir" 
                                                   value="{{ old('tanggal_maintenance_terakhir', $peralatan->tanggal_maintenance_terakhir ? $peralatan->tanggal_maintenance_terakhir->format('Y-m-d') : '') }}">
                                            @error('tanggal_maintenance_terakhir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tanggal_maintenance_selanjutnya" class="form-label">Tanggal Maintenance Selanjutnya</label>
                                            <input type="date" class="form-control @error('tanggal_maintenance_selanjutnya') is-invalid @enderror" 
                                                   id="tanggal_maintenance_selanjutnya" name="tanggal_maintenance_selanjutnya" 
                                                   value="{{ old('tanggal_maintenance_selanjutnya', $peralatan->tanggal_maintenance_selanjutnya ? $peralatan->tanggal_maintenance_selanjutnya->format('Y-m-d') : '') }}">
                                            @error('tanggal_maintenance_selanjutnya')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                @if($peralatan->umur_alat)
                                    <div class="alert alert-light">
                                        <i class="fas fa-info-circle"></i> 
                                        <strong>Umur Alat:</strong> {{ $peralatan->umur_alat }} tahun
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">Keterangan</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                              id="keterangan" name="keterangan" rows="4">{{ old('keterangan', $peralatan->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Audit -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">Informasi Audit</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Dibuat:</strong> {{ $peralatan->created_at->format('d/m/Y H:i') }}</p>
                                        @if($peralatan->createdBy)
                                            <p><strong>Dibuat oleh:</strong> {{ $peralatan->createdBy->name }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Diperbarui:</strong> {{ $peralatan->updated_at->format('d/m/Y H:i') }}</p>
                                        @if($peralatan->updatedBy)
                                            <p><strong>Diperbarui oleh:</strong> {{ $peralatan->updatedBy->name }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui
                            </button>
                            <a href="{{ route('admin.biaya-peralatan.index', $kategori) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="button" class="btn btn-warning" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </form>

                    <!-- Form Delete (Hidden) -->
                    <form id="delete-form" action="{{ route('admin.biaya-peralatan.destroy', [$kategori, $peralatan->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Preview gambar
        document.getElementById('gambar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Jika ada preview sebelumnya, hapus
                    const existingPreview = document.getElementById('preview-gambar');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Buat preview baru
                    const preview = document.createElement('img');
                    preview.id = 'preview-gambar';
                    preview.src = e.target.result;
                    preview.className = 'img-thumbnail mt-2';
                    preview.style.maxWidth = '200px';
                    
                    // Tambahkan setelah input file
                    document.getElementById('gambar').parentNode.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
        });

        // Auto calculate total
        function calculateTotal() {
            const hargaBeli = parseFloat(document.getElementById('harga_beli').value) || 0;
            const biayaOperasional = parseFloat(document.getElementById('biaya_operasional').value) || 0;
            const biayaPerawatan = parseFloat(document.getElementById('biaya_perawatan').value) || 0;
            
            const total = hargaBeli + biayaOperasional + biayaPerawatan;
            
            // Format rupiah
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            
            document.getElementById('total-biaya').textContent = formatter.format(total);
        }

        // Add event listeners for calculation
        document.getElementById('harga_beli').addEventListener('input', calculateTotal);
        document.getElementById('biaya_operasional').addEventListener('input', calculateTotal);
        document.getElementById('biaya_perawatan').addEventListener('input', calculateTotal);

        // Confirm delete
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus peralatan ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('delete-form').submit();
            }
        }

        // Status change warning
        document.getElementById('status').addEventListener('change', function() {
            const status = this.value;
            if (status === 'rusak' || status === 'tidak_aktif') {
                if (!confirm('Mengubah status menjadi "' + this.options[this.selectedIndex].text + '" akan membuat peralatan tidak tersedia. Apakah Anda yakin?')) {
                    this.value = '{{ $peralatan->status }}'; // Reset ke nilai awal
                }
            }
        });

        // Validation for maintenance dates
        document.getElementById('tanggal_maintenance_terakhir').addEventListener('change', function() {
            const tanggalTerakhir = new Date(this.value);
            const tanggalSelanjutnya = document.getElementById('tanggal_maintenance_selanjutnya');
            
            if (tanggalTerakhir > new Date()) {
                alert('Tanggal maintenance terakhir tidak boleh lebih dari hari ini.');
                this.value = '';
            }
        });

        document.getElementById('tanggal_maintenance_selanjutnya').addEventListener('change', function() {
            const tanggalSelanjutnya = new Date(this.value);
            const tanggalTerakhir = document.getElementById('tanggal_maintenance_terakhir').value;
            
            if (tanggalTerakhir && tanggalSelanjutnya <= new Date(tanggalTerakhir)) {
                alert('Tanggal maintenance selanjutnya harus setelah tanggal maintenance terakhir.');
                this.value = '';
            }
        });
    </script>
    @endpush
</x-admin-layout>
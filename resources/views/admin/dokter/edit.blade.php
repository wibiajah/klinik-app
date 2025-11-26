<x-admin-layout title="Dashboard">
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Edit Dokter</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.data-dokter.index') }}">Data Dokter</a></li>
                        <li class="breadcrumb-item active">Edit {{ $dokter->nama_dokter }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Dokter</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.data-dokter.update', $dokter->id_dokter) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Data Pribadi -->
                        <div class="col-md-6">
                            <h5 class="mb-3 text-primary">Data Pribadi</h5>
                            
                            <!-- Preview Foto -->
                            @if($dokter->foto)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('storage/' . $dokter->foto) }}" 
                                         alt="Foto {{ $dokter->nama_dokter }}" 
                                         class="rounded-circle" 
                                         width="100" height="100" style="object-fit: cover;">
                                    <p class="small text-muted mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            
                            <!-- Nama Dokter -->
                            <div class="mb-3">
                                <label for="nama_dokter" class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_dokter') is-invalid @enderror" 
                                       id="nama_dokter" name="nama_dokter" value="{{ old('nama_dokter', $dokter->nama_dokter) }}" required>
                                @error('nama_dokter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                        id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                       id="tanggal_lahir" name="tanggal_lahir" 
                                       value="{{ old('tanggal_lahir', $dokter->tanggal_lahir->format('Y-m-d')) }}" required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" name="alamat" rows="3" required>{{ old('alamat', $dokter->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Foto -->
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Dokter</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                       id="foto" name="foto" accept="image/*">
                                <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</div>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Profesional -->
                        <div class="col-md-6">
                            <h5 class="mb-3 text-primary">Data Profesional</h5>
                            
                            <!-- Spesialisasi -->
                            <div class="mb-3">
                                <label for="spesialisasi" class="form-label">Spesialisasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('spesialisasi') is-invalid @enderror" 
                                       id="spesialisasi" name="spesialisasi" value="{{ old('spesialisasi', $dokter->spesialisasi) }}" 
                                       placeholder="Contoh: Umum, Gigi, Anak, Kandungan" required>
                                @error('spesialisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- No STR -->
                            <div class="mb-3">
                                <label for="no_str" class="form-label">No. STR <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_str') is-invalid @enderror" 
                                       id="no_str" name="no_str" value="{{ old('no_str', $dokter->no_str) }}" required>
                                @error('no_str')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- No Telepon -->
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                                       id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $dokter->no_telepon) }}" required>
                                @error('no_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $dokter->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Aktif -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" 
                                           id="status_aktif" name="status_aktif" 
                                           {{ old('status_aktif', $dokter->status_aktif) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_aktif">
                                        Status Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Praktik -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3 text-primary">Jadwal Praktik</h5>
                            <div class="row">
                                @php
                                    $hari = [
                                        'senin' => 'Senin',
                                        'selasa' => 'Selasa',
                                        'rabu' => 'Rabu',
                                        'kamis' => 'Kamis',
                                        'jumat' => 'Jumat',
                                        'sabtu' => 'Sabtu',
                                        'minggu' => 'Minggu'
                                    ];
                                    $jadwalLama = $dokter->jadwal_praktik ?: [];
                                @endphp
                                
                                @foreach($hari as $key => $value)
                                    @php
                                        $isChecked = isset($jadwalLama[$key]);
                                        $jamMulai = $isChecked ? ($jadwalLama[$key]['jam_mulai'] ?? '') : '';
                                        $jamSelesai = $isChecked ? ($jadwalLama[$key]['jam_selesai'] ?? '') : '';
                                    @endphp
                                    
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" 
                                                           id="jadwal_{{ $key }}" name="jadwal_{{ $key }}"
                                                           {{ $isChecked ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bold" for="jadwal_{{ $key }}">
                                                        {{ $value }}
                                                    </label>
                                                </div>
                                                <div class="jadwal-time" id="time_{{ $key }}" 
                                                     style="display: {{ $isChecked ? 'block' : 'none' }};">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label class="form-label small">Jam Mulai</label>
                                                            <input type="time" class="form-control form-control-sm" 
                                                                   name="jam_mulai_{{ $key }}" value="{{ $jamMulai }}">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label small">Jam Selesai</label>
                                                            <input type="time" class="form-control form-control-sm" 
                                                                   name="jam_selesai_{{ $key }}" value="{{ $jamSelesai }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.data-dokter.show', $dokter->id_dokter) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Handle jadwal praktik checkbox
        document.addEventListener('DOMContentLoaded', function() {
            const hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
            
            hari.forEach(function(h) {
                const checkbox = document.getElementById('jadwal_' + h);
                const timeDiv = document.getElementById('time_' + h);
                
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        timeDiv.style.display = 'block';
                    } else {
                        timeDiv.style.display = 'none';
                        // Clear time inputs
                        timeDiv.querySelectorAll('input[type="time"]').forEach(function(input) {
                            input.value = '';
                        });
                    }
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>
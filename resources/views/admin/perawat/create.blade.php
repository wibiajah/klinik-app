<x-admin-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Perawat</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.data-perawat.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.data-perawat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- Data Pribadi -->
                            <h5 class="mb-3"><i class="fas fa-user"></i> Data Pribadi</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_perawat">Nama Lengkap *</label>
                                        <input type="text" class="form-control @error('nama_perawat') is-invalid @enderror" 
                                               id="nama_perawat" name="nama_perawat" value="{{ old('nama_perawat') }}" required>
                                        @error('nama_perawat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin *</label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                                                id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir *</label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                               id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tingkat_pendidikan">Tingkat Pendidikan *</label>
                                        <select class="form-control @error('tingkat_pendidikan') is-invalid @enderror" 
                                                id="tingkat_pendidikan" name="tingkat_pendidikan" required>
                                            <option value="">Pilih Tingkat Pendidikan</option>
                                            <option value="D3 Keperawatan" {{ old('tingkat_pendidikan') == 'D3 Keperawatan' ? 'selected' : '' }}>D3 Keperawatan</option>
                                            <option value="S1 Keperawatan" {{ old('tingkat_pendidikan') == 'S1 Keperawatan' ? 'selected' : '' }}>S1 Keperawatan</option>
                                            <option value="Ners" {{ old('tingkat_pendidikan') == 'Ners' ? 'selected' : '' }}>Ners</option>
                                        </select>
                                        @error('tingkat_pendidikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat *</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                  id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Data Profesional -->
                            <h5 class="mb-3"><i class="fas fa-id-card"></i> Data Profesional</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_str">No. STR *</label>
                                        <input type="text" class="form-control @error('no_str') is-invalid @enderror" 
                                               id="no_str" name="no_str" value="{{ old('no_str') }}" required>
                                        @error('no_str')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto">Foto Profil</label>
                                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror" 
                                               id="foto" name="foto" accept="image/*">
                                        <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Kontak -->
                            <h5 class="mb-3"><i class="fas fa-phone"></i> Informasi Kontak</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telepon">No. Telepon *</label>
                                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                                               id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Jadwal Kerja -->
                            <h5 class="mb-3"><i class="fas fa-calendar"></i> Jadwal Kerja</h5>
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
                                $shifts = ['Pagi', 'Siang', 'Malam'];
                            @endphp

                            @foreach($hari as $key => $value)
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="jadwal_{{ $key }}" name="jadwal_{{ $key }}" value="1"
                                               {{ old("jadwal_{$key}") ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jadwal_{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="time" class="form-control" 
                                           name="jam_mulai_{{ $key }}" 
                                           value="{{ old("jam_mulai_{$key}") }}"
                                           placeholder="Jam Mulai">
                                </div>
                                <div class="col-md-3">
                                    <input type="time" class="form-control" 
                                           name="jam_selesai_{{ $key }}" 
                                           value="{{ old("jam_selesai_{$key}") }}"
                                           placeholder="Jam Selesai">
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="shift_{{ $key }}">
                                        <option value="">Pilih Shift</option>
                                        @foreach($shifts as $shift)
                                            <option value="{{ $shift }}" {{ old("shift_{$key}") == $shift ? 'selected' : '' }}>
                                                {{ $shift }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endforeach

                            <hr>

                            <!-- Status -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   id="status_aktif" name="status_aktif" value="1" 
                                                   {{ old('status_aktif', 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_aktif">
                                                Status Aktif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.data-perawat.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle jadwal input berdasarkan checkbox
        document.addEventListener('DOMContentLoaded', function() {
            const hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
            
            hari.forEach(function(h) {
                const checkbox = document.getElementById('jadwal_' + h);
                const jamMulai = document.querySelector('input[name="jam_mulai_' + h + '"]');
                const jamSelesai = document.querySelector('input[name="jam_selesai_' + h + '"]');
                const shift = document.querySelector('select[name="shift_' + h + '"]');
                
                function toggleInputs() {
                    if (checkbox.checked) {
                        jamMulai.disabled = false;
                        jamSelesai.disabled = false;
                        shift.disabled = false;
                    } else {
                        jamMulai.disabled = true;
                        jamSelesai.disabled = true;
                        shift.disabled = true;
                        jamMulai.value = '';
                        jamSelesai.value = '';
                        shift.value = '';
                    }
                }
                
                toggleInputs(); // Initial state
                checkbox.addEventListener('change', toggleInputs);
            });
        });
    </script>
</x-admin-layout>
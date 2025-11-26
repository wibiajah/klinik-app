<x-admin-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Preview Section -->
                <div class="lg:col-span-1">
                    <div class="bg-white shadow-sm rounded-lg sticky top-8">
                        <div class="px-4 py-5 sm:p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Data Sebelumnya</h2>
                            
                            <div class="space-y-3 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700">NIK:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->nik }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Nama:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->nama }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Jenis Kelamin:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Tanggal Lahir:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->tgl_lahir->format('d/m/Y') }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">No HP:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->no_hp }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">No BPJS:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->no_bpjs ?: '-' }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Kontak Darurat:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->kontak_darurat }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Hubungan:</span>
                                    <span class="text-gray-900 block">{{ ucfirst($pendaftaran->hubungan_kontak) }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Layanan:</span>
                                    <span class="text-gray-900 block">
                                        @switch($pendaftaran->keluhan)
                                            @case('pemeriksaan_umum')
                                                Pemeriksaan Umum
                                                @break
                                            @case('lab')
                                                Laboratorium
                                                @break
                                            @case('radiologi')
                                                Radiologi
                                                @break
                                            @default
                                                {{ $pendaftaran->keluhan }}
                                        @endswitch
                                    </span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Tgl Pendaftaran:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->tgl_pendaftaran->format('d/m/Y') }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Alamat:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->alamat_lengkap }}</span>
                                </div>
                                
                                @if($pendaftaran->catatan)
                                <div>
                                    <span class="font-medium text-gray-700">Catatan:</span>
                                    <span class="text-gray-900 block">{{ $pendaftaran->catatan }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-sm rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h1 class="text-2xl font-bold text-gray-900">Edit Pendaftaran</h1>
                                <a href="{{ route('admin.pendaftaran.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Kembali
                                </a>
                            </div>

                            @if($errors->any())
                                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                                    <ul class="list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- NIK -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">NIK KTP</label>
                                        <input type="text" name="nik" value="{{ old('nik', $pendaftaran->nik) }}" required
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Nama -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <input type="text" name="nama" value="{{ old('nama', $pendaftaran->nama) }}" required
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $pendaftaran->tgl_lahir->format('Y-m-d')) }}" required
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- No HP -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                                        <input type="text" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" required
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- No BPJS -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nomor BPJS (Opsional)</label>
                                        <input type="text" name="no_bpjs" value="{{ old('no_bpjs', $pendaftaran->no_bpjs) }}"
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Kontak Darurat -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kontak Darurat</label>
                                        <input type="text" name="kontak_darurat" value="{{ old('kontak_darurat', $pendaftaran->kontak_darurat) }}" required
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <!-- Hubungan Kontak -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Hubungan Kontak</label>
                                        <select name="hubungan_kontak" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Hubungan</option>
                                            <option value="ayah" {{ old('hubungan_kontak', $pendaftaran->hubungan_kontak) == 'ayah' ? 'selected' : '' }}>Ayah</option>
                                            <option value="ibu" {{ old('hubungan_kontak', $pendaftaran->hubungan_kontak) == 'ibu' ? 'selected' : '' }}>Ibu</option>
                                            <option value="saudara" {{ old('hubungan_kontak', $pendaftaran->hubungan_kontak) == 'saudara' ? 'selected' : '' }}>Saudara</option>
                                        </select>
                                    </div>

                                    <!-- Keluhan -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                                        <select name="keluhan" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Layanan</option>
                                            <option value="pemeriksaan_umum" {{ old('keluhan', $pendaftaran->keluhan) == 'pemeriksaan_umum' ? 'selected' : '' }}>Pemeriksaan Umum</option>
                                            <option value="lab" {{ old('keluhan', $pendaftaran->keluhan) == 'lab' ? 'selected' : '' }}>Laboratorium</option>
                                            <option value="radiologi" {{ old('keluhan', $pendaftaran->keluhan) == 'radiologi' ? 'selected' : '' }}>Radiologi</option>
                                        </select>
                                    </div>

                                    <!-- Tanggal Pendaftaran -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal Pendaftaran</label>
                                        <input type="date" name="tgl_pendaftaran" value="{{ old('tgl_pendaftaran', $pendaftaran->tgl_pendaftaran->format('Y-m-d')) }}" required
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>

                                <!-- Alamat Lengkap -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                    <textarea name="alamat_lengkap" rows="3" required
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('alamat_lengkap', $pendaftaran->alamat_lengkap) }}</textarea>
                                </div>

                                <!-- Catatan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                                    <textarea name="catatan" rows="3"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('catatan', $pendaftaran->catatan) }}</textarea>
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('admin.pendaftaran.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                                        Batal
                                    </a>
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
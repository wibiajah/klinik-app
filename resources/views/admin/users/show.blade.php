<x-admin-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">
            {{ __('Detail User') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">User Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Detail User</li>
                    </ol>
                </nav>

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="h4 mb-1">{{ $user->name }}</h3>
                        <p class="text-muted mb-0">Informasi lengkap user dan hak akses</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit User
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="row">
                    <!-- Main Information -->
                    <div class="col-lg-8 mb-4">
                        <!-- User Profile Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user me-2"></i>Profil User
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">
                                                <i class="fas fa-user me-1"></i>Nama Lengkap
                                            </label>
                                            <p class="fs-5 mb-0">{{ $user->name }}</p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted">
                                                <i class="fas fa-envelope me-1"></i>Email
                                            </label>
                                            <p class="fs-6 mb-0">{{ $user->email }}</p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted">
                                                <i class="fas fa-user-tag me-1"></i>Role
                                            </label>
                                            <p class="mb-0">
                                                @switch($user->role)
                                                    @case('superadmin')
                                                        <span class="badge bg-danger fs-6">Super Admin</span>
                                                        @break
                                                    @case('admin')
                                                        <span class="badge bg-warning fs-6">Admin Klinik</span>
                                                        @break
                                                    @case('karyawan')
                                                        <span class="badge bg-info fs-6">Karyawan</span>
                                                        @break
                                                    @case('user')
                                                        <span class="badge bg-secondary fs-6">User</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-light text-dark fs-6">{{ ucfirst($user->role) }}</span>
                                                @endswitch
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">
                                                <i class="fas fa-calendar-plus me-1"></i>Tanggal Dibuat
                                            </label>
                                            <p class="mb-0">{{ $user->created_at->format('d F Y') }}</p>
                                            <small class="text-muted">{{ $user->created_at->format('H:i') }} WIB</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted">
                                                <i class="fas fa-calendar-edit me-1"></i>Terakhir Diupdate
                                            </label>
                                            <p class="mb-0">{{ $user->updated_at->format('d F Y') }}</p>
                                            <small class="text-muted">{{ $user->updated_at->format('H:i') }} WIB</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted">
                                                <i class="fas fa-toggle-on me-1"></i>Status
                                            </label>
                                            <p class="mb-0">
                                                @if($user->is_active)
                                                    <span class="badge bg-success fs-6">
                                                        <i class="fas fa-check me-1"></i>Aktif
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger fs-6">
                                                        <i class="fas fa-times me-1"></i>Nonaktif
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Permissions Card -->
                        @if($user->role !== 'user' && !empty($user->permissions))
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-key me-2"></i>Hak Akses (Permissions)
                                </h5>
                            </div>
                            <div class="card-body">
                                @if(!empty($user->permissions))
                                    <div class="row">
                                        @php
                                            $availablePermissions = \App\Models\User::getAvailablePermissions();
                                        @endphp
                                        @foreach($user->permissions as $permission)
                                            <div class="col-md-6 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span>{{ $availablePermissions[$permission] ?? ucfirst(str_replace('_', ' ', $permission)) }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-info-circle fa-3x mb-3 opacity-50"></i>
                                        <p class="mb-0">User ini belum memiliki permissions khusus</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @elseif($user->role === 'user')
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Role
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-user fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-0">User dengan role <strong>User</strong> memiliki akses terbatas dan tidak memerlukan permissions khusus.</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Hak Akses
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-key fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-0">User ini belum memiliki permissions yang ditetapkan</p>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm mt-2">
                                        <i class="fas fa-edit me-1"></i>Set Permissions
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Sidebar Actions -->
                    <div class="col-lg-4">
                        <!-- Quick Actions Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-bolt me-2"></i>Aksi Cepat
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Edit User
                                    </a>
                                    
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#passwordModal">
                                        <i class="fas fa-key me-2"></i>Ubah Password
                                    </button>
                                    <br>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                             <br>
                                          
                                            <button type="submit" 
                                                    class="btn {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} w-100"
                                                    onclick="return confirm('Apakah Anda yakin ingin {{ $user->is_active ? 'menonaktifkan' : 'mengaktifkan' }} user ini?')">
                                                @if($user->is_active)
                                                    <i class="fas fa-times me-2"></i>Nonaktifkan
                                                @else
                                                    <i class="fas fa-check me-2"></i>Aktifkan
                                                @endif
                                            </button>
                                        </form>
                                        
                                        
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- User Stats Card -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-chart-bar me-2"></i>Statistik User
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end pe-3">
                                            <h4 class="text-primary mb-1">{{ count($user->permissions ?? []) }}</h4>
                                            <small class="text-muted">Permissions</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="ps-3">
                                            <h4 class="text-success mb-1">{{ $user->created_at->diffInDays() }}</h4>
                                            <small class="text-muted">Hari Terdaftar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="small">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Account Age:</span>
                                        <span>{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Last Update:</span>
                                        <span>{{ $user->updated_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Status:</span>
                                        <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="passwordModalLabel">
                        <i class="fas fa-key me-2"></i>Ubah Password - {{ $user->name }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('admin.users.update-password', $user) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian!</strong> Anda akan mengubah password untuk user <strong>{{ $user->name }}</strong>.
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-1"></i>Password Baru <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   required
                                   minlength="8"
                                   placeholder="Masukkan password baru">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>Password minimal 8 karakter
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock me-1"></i>Konfirmasi Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   minlength="8"
                                   placeholder="Ulangi password baru">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save me-1"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password confirmation validation
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');
            
            function validatePassword() {
                if (passwordField.value !== confirmPasswordField.value) {
                    confirmPasswordField.setCustomValidity('Password tidak cocok');
                } else {
                    confirmPasswordField.setCustomValidity('');
                }
            }
            
            passwordField.addEventListener('input', validatePassword);
            confirmPasswordField.addEventListener('input', validatePassword);
        });
    </script>

</x-admin-layout>
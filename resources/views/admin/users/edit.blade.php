<x-admin-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">
            {{ __('Edit User') }}
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
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </nav>

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="h4 mb-1">Edit User: {{ $user->name }}</h3>
                        <p class="text-muted mb-0">Update informasi user dan pengaturan akses</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                <div class="row">
                    <!-- Main Form -->
                    <div class="col-lg-8 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-edit me-2"></i>Informasi User
                                </h5>
                            </div>
                            
                            <div class="card-body">
                                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Name Field -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email Field -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Role Field -->
                                    <div class="mb-3">
                                        <label for="role" class="form-label">
                                            <i class="fas fa-user-tag me-1"></i>Role <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('role') is-invalid @enderror" 
                                                id="role" 
                                                name="role" 
                                                required>
                                            <option value="">Pilih Role</option>
                                            @foreach($availableRoles as $roleValue => $roleLabel)
                                                <option value="{{ $roleValue }}" {{ old('role', $user->role) == $roleValue ? 'selected' : '' }}>
                                                    {{ $roleLabel }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Permissions Field -->
                                    <div class="mb-3" id="permissions-section">
                                        <label class="form-label">
                                            <i class="fas fa-key me-1"></i>Permissions
                                        </label>
                                        <div class="row">
                                            @foreach($availablePermissions as $permissionKey => $permissionLabel)
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" 
                                                               class="form-check-input" 
                                                               id="permission_{{ $permissionKey }}" 
                                                               name="permissions[]" 
                                                               value="{{ $permissionKey }}"
                                                               {{ in_array($permissionKey, old('permissions', $user->permissions ?? [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="permission_{{ $permissionKey }}">
                                                            {{ $permissionLabel }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('permissions')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status Field -->
                                    <div class="mb-4">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1"
                                                   {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                <i class="fas fa-toggle-on me-1"></i>User Aktif
                                            </label>
                                        </div>
                                        <small class="text-muted">Centang untuk mengaktifkan user ini</small>
                                        @error('is_active')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i>Update User
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- User Info Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informasi User
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong class="text-muted">Dibuat:</strong>
                                    <p class="mb-0">{{ $user->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong class="text-muted">Terakhir Update:</strong>
                                    <p class="mb-0">{{ $user->updated_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="mb-0">
                                    <strong class="text-muted">Status:</strong>
                                    <br>
                                    <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-key me-2"></i>Ubah Password
                                </h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-3">
                                    Ubah password untuk user ini dengan form terpisah demi keamanan.
                                </p>
                                <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#passwordModal">
                                    <i class="fas fa-lock me-1"></i>Ubah Password
                                </button>
                            </div>
                        </div>

                        <!-- Actions Card -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-cogs me-2"></i>Aksi Lainnya
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>Lihat Detail
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} w-100"
                                                    onclick="return confirm('Apakah Anda yakin ingin {{ $user->is_active ? 'menonaktifkan' : 'mengaktifkan' }} user ini?')">
                                                @if($user->is_active)
                                                    <i class="fas fa-times me-1"></i>Nonaktifkan User
                                                @else
                                                    <i class="fas fa-check me-1"></i>Aktifkan User
                                                @endif
                                            </button>
                                        </form>
                                    @endif
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
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="passwordModalLabel">
                        <i class="fas fa-key me-2"></i>Ubah Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('admin.users.update-password', $user) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password Baru <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   required
                                   minlength="8">
                            <div class="form-text">Minimum 8 karakter</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   minlength="8">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const permissionsSection = document.getElementById('permissions-section');
            
            function togglePermissions() {
                const selectedRole = roleSelect.value;
                const checkboxes = permissionsSection.querySelectorAll('input[type="checkbox"]');
                
                if (selectedRole === 'user') {
                    permissionsSection.style.display = 'none';
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                        checkbox.disabled = true;
                    });
                } else {
                    permissionsSection.style.display = 'block';
                    checkboxes.forEach(checkbox => {
                        checkbox.disabled = false;
                    });
                }
            }
            
            // Initialize on page load
            togglePermissions();
            
            // Handle role change
            roleSelect.addEventListener('change', togglePermissions);
        });
    </script>
 
</x-admin-layout>
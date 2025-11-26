{{-- resources/views/admin/users/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0 fw-semibold text-dark">
                {{ __('Tambah User Baru') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-plus me-2"></i>Form Tambah User
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            
                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="contoh@email.com"
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan password"
                                           required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">Password minimal 8 karakter</small>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role" class="form-label fw-semibold">
                                    Role <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user-tag text-muted"></i>
                                    </span>
                                    <select class="form-select @error('role') is-invalid @enderror" 
                                            id="role" 
                                            name="role" 
                                            required 
                                            onchange="togglePermissions()">
                                        <option value="">Pilih Role</option>
                                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="karyawan" {{ old('role') === 'karyawan' ? 'selected' : '' }}>
                                            Karyawan
                                        </option>
                                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>
                                            User
                                        </option>
                                    </select>
                                </div>
                                @error('role')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Permissions Section -->
                            <div class="mb-3" id="permissions-section" style="display: none;">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-key text-muted me-2"></i>Permissions
                                </label>
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($availablePermissions as $key => $label)
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" 
                                                           class="form-check-input" 
                                                           id="permission_{{ $key }}" 
                                                           name="permissions[]" 
                                                           value="{{ $key }}"
                                                           {{ in_array($key, old('permissions', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission_{{ $key }}">
                                                        {{ $label }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @error('permissions')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Status Aktif -->
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="is_active" 
                                           name="is_active" 
                                           value="1" 
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">
                                        <i class="fas fa-toggle-on text-success me-2"></i>User Aktif
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    Centang untuk mengaktifkan user ini
                                </small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-save me-2"></i>Simpan User
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });

    // Toggle permissions section
    function togglePermissions() {
        const role = document.getElementById('role').value;
        const permissionsSection = document.getElementById('permissions-section');
        
        if (role === 'admin' || role === 'karyawan') {
            permissionsSection.style.display = 'block';
            // Add smooth slide down animation
            permissionsSection.classList.add('animate__animated', 'animate__slideInDown');
        } else {
            permissionsSection.style.display = 'none';
            // Uncheck all permissions when hidden
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = false);
        }
    }

    // Form validation enhancement
    document.addEventListener('DOMContentLoaded', function() {
        togglePermissions();
        
        // Add real-time validation feedback
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input[required], select[required]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid') && this.value.trim() !== '') {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
        
        // Email validation
        const emailInput = document.getElementById('email');
        emailInput.addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.classList.add('is-invalid');
            } else if (this.value) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
        
        // Password strength indicator
        const passwordInput = document.getElementById('password');
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // You can add a strength indicator here if needed
        });
    });
    </script>

    <style>
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    
    .input-group-text {
        border-right: none;
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .animate__slideInDown {
        animation-duration: 0.5s;
    }
    
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate__slideInDown {
        animation-name: slideInDown;
    }
    </style>
</x-admin-layout>
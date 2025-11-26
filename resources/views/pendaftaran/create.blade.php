<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pasien - Klinik</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0, 188, 132, 0.1);
            border: none;
            border-radius: 15px;
            background: white;
        }
        .card-header {
            background: #00bc84;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 2rem;
            text-align: center;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #00bc84;
            box-shadow: 0 0 0 0.2rem rgba(0, 188, 132, 0.25);
        }
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        .btn-primary {
            background: #00bc84;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #00a374;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 188, 132, 0.3);
        }
        .btn-outline-light {
            border-color: #00bc84;
            color: #00bc84;
            border-radius: 8px;
        }
        .btn-outline-light:hover {
            background: #00bc84;
            border-color: #00bc84;
            color: white;
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
        .required {
            color: #dc3545;
        }
        .section-title {
            color: #00bc84;
            font-weight: bold;
            border-bottom: 2px solid #00bc84;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
            margin-top: 0.25rem;
        }
        .form-text {
            color: #6c757d;
            font-size: 0.875rem;
        }
        /* Modal styling for error popup */
        .modal-header {
            background-color: #dc3545;
            color: white;
            border-bottom: none;
        }
        .modal-header .btn-close {
            filter: invert(1);
        }
        .error-icon {
            color: #dc3545;
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }
        .validation-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            padding: 0.5rem;
            margin-top: 0.25rem;
            font-size: 0.875rem;
        }
        .input-counter {
            font-size: 0.75rem;
            color: #6c757d;
            float: right;
            margin-top: 0.25rem;
        }
        .input-counter.error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('logo.png') }}" alt="Logo Klinik" class="logo">
                        <h3 class="mb-0">
                            <i class="fas fa-hospital-user me-2"></i>
                            Pendaftaran Pasien Klinik
                        </h3>
                        <p class="mb-0 mt-2">Silakan lengkapi form di bawah ini untuk mendaftar</p>
                    </div>
                    <div class="card-body p-4">
                        <!-- Alert Error -->
                        @if($errors->any())
                        <div class="alert alert-danger" id="errorNotification">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="ms-3">
                                    <span class="badge bg-light text-dark" id="countdown">3</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form id="pendaftaranForm" method="POST" action="/pendaftaran" novalidate>
                            @csrf
                            
                            <!-- Data Pribadi -->
                            <h5 class="section-title">
                                <i class="fas fa-user me-2"></i>Data Pribadi
                            </h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nik" class="form-label">NIK KTP <span class="required">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nik') is-invalid @enderror" 
                                           id="nik" 
                                           name="nik" 
                                           maxlength="16" 
                                           value="{{ old('nik') }}" 
                                           required
                                           pattern="[0-9]{16}"
                                           data-validation="nik">
                                    <div class="form-text">Masukkan 16 digit NIK sesuai KTP</div>
                                    <div class="input-counter" id="nik-counter">0/16</div>
                                    <div class="invalid-feedback" id="nik-error"></div>
                                    @error('nik')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nama" 
                                           name="nama" 
                                           value="{{ old('nama') }}" 
                                           required
                                           minlength="2"
                                           maxlength="100"
                                           data-validation="nama">
                                    <div class="invalid-feedback" id="nama-error"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="required">*</span></label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required data-validation="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback" id="jenis_kelamin-error"></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir <span class="required">*</span></label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="tgl_lahir" 
                                           name="tgl_lahir" 
                                           value="{{ old('tgl_lahir') }}" 
                                           required
                                           data-validation="tgl_lahir">
                                    <div class="invalid-feedback" id="tgl_lahir-error"></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="no_hp" class="form-label">No. HP <span class="required">*</span></label>
                                    <input type="tel" 
                                           class="form-control" 
                                           id="no_hp" 
                                           name="no_hp" 
                                           value="{{ old('no_hp') }}" 
                                           required
                                           minlength="10"
                                           maxlength="15"
                                           pattern="[0-9]{10,15}"
                                           data-validation="no_hp">
                                    <div class="form-text">10-15 digit nomor HP (08xxx atau 628xxx)</div>
                                    <div class="input-counter" id="no_hp-counter">0/15</div>
                                    <div class="invalid-feedback" id="no_hp-error"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_bpjs" class="form-label">No. BPJS</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="no_bpjs" 
                                           name="no_bpjs" 
                                           maxlength="13" 
                                           value="{{ old('no_bpjs') }}"
                                           pattern="[0-9]{13}"
                                           data-validation="no_bpjs">
                                    <div class="form-text">Opsional, masukkan 13 digit nomor BPJS</div>
                                    <div class="input-counter" id="no_bpjs-counter">0/13</div>
                                    <div class="invalid-feedback" id="no_bpjs-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap <span class="required">*</span></label>
                                    <textarea class="form-control" 
                                              id="alamat_lengkap" 
                                              name="alamat_lengkap" 
                                              rows="3" 
                                              required
                                              minlength="10"
                                              maxlength="500"
                                              data-validation="alamat_lengkap">{{ old('alamat_lengkap') }}</textarea>
                                    <div class="form-text">Minimal 10 karakter, maksimal 500 karakter</div>
                                    <div class="invalid-feedback" id="alamat_lengkap-error"></div>
                                </div>
                            </div>

                            <!-- Kontak Darurat -->
                            <h5 class="section-title">
                                <i class="fas fa-phone-alt me-2"></i>Kontak Darurat
                            </h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="kontak_darurat" class="form-label">No. HP Kontak Darurat <span class="required">*</span></label>
                                    <input type="tel" 
                                           class="form-control" 
                                           id="kontak_darurat" 
                                           name="kontak_darurat" 
                                           value="{{ old('kontak_darurat') }}" 
                                           required
                                           minlength="10"
                                           maxlength="15"
                                           pattern="[0-9]{10,15}"
                                           data-validation="kontak_darurat">
                                    <div class="form-text">10-15 digit nomor HP (08xxx atau 628xxx)</div>
                                    <div class="input-counter" id="kontak_darurat-counter">0/15</div>
                                    <div class="invalid-feedback" id="kontak_darurat-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="hubungan_kontak" class="form-label">Hubungan <span class="required">*</span></label>
                                    <select class="form-select" id="hubungan_kontak" name="hubungan_kontak" required data-validation="hubungan_kontak">
                                        <option value="">Pilih Hubungan</option>
                                        <option value="ayah" {{ old('hubungan_kontak') == 'ayah' ? 'selected' : '' }}>Ayah</option>
                                        <option value="ibu" {{ old('hubungan_kontak') == 'ibu' ? 'selected' : '' }}>Ibu</option>
                                        <option value="saudara" {{ old('hubungan_kontak') == 'saudara' ? 'selected' : '' }}>Saudara</option>
                                    </select>
                                    <div class="invalid-feedback" id="hubungan_kontak-error"></div>
                                </div>
                            </div>

                            <!-- Layanan -->
                            <h5 class="section-title">
                                <i class="fas fa-stethoscope me-2"></i>Layanan yang Dibutuhkan
                            </h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="keluhan" class="form-label">Jenis Layanan <span class="required">*</span></label>
                                    <select class="form-select" id="keluhan" name="keluhan" required data-validation="keluhan">
                                        <option value="">Pilih Jenis Layanan</option>
                                        <option value="pemeriksaan_umum" {{ old('keluhan') == 'pemeriksaan_umum' ? 'selected' : '' }}>Pemeriksaan Umum</option>
                                        <option value="lab" {{ old('keluhan') == 'lab' ? 'selected' : '' }}>Laboratorium</option>
                                        <option value="radiologi" {{ old('keluhan') == 'radiologi' ? 'selected' : '' }}>Radiologi</option>
                                    </select>
                                    <div class="invalid-feedback" id="keluhan-error"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_pendaftaran" class="form-label">Tanggal Kunjungan <span class="required">*</span></label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="tgl_pendaftaran" 
                                           name="tgl_pendaftaran" 
                                           value="{{ old('tgl_pendaftaran') }}" 
                                           required
                                           data-validation="tgl_pendaftaran">
                                    <div class="invalid-feedback" id="tgl_pendaftaran-error"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="catatan" class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" 
                                          id="catatan" 
                                          name="catatan" 
                                          rows="3" 
                                          maxlength="1000"
                                          placeholder="Catatan atau keluhan tambahan (opsional)">{{ old('catatan') }}</textarea>
                                <div class="form-text">Maksimal 1000 karakter</div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Link Cek Status -->
                <div class="text-center mt-4">
                    <a href="/pendaftaran/check-status" class="btn btn-outline-light">
                        <i class="fas fa-search me-2"></i>
                        Cek Status Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Data Tidak Valid
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Harap perbaiki kesalahan berikut sebelum melanjutkan:</p>
                    <ul id="errorModalList" class="mb-0"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="fas fa-check me-2"></i>Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validation rules
        const validationRules = {
            nik: {
                required: true,
                minLength: 16,
                maxLength: 16,
                pattern: /^\d{16}$/,
                message: 'NIK harus terdiri dari 16 digit angka'
            },
            nama: {
                required: true,
                minLength: 2,
                maxLength: 100,
                pattern: /^[a-zA-Z\s]+$/,
                message: 'Nama harus berisi huruf dan spasi saja, minimal 2 karakter'
            },
            jenis_kelamin: {
                required: true,
                message: 'Jenis kelamin harus dipilih'
            },
            tgl_lahir: {
                required: true,
                message: 'Tanggal lahir harus diisi'
            },
            no_hp: {
                required: true,
                minLength: 10,
                maxLength: 15,
                pattern: /^(08|628)[0-9]{8,13}$/,
                message: 'Nomor HP harus 10-15 digit, dimulai dengan 08 atau 628'
            },
            no_bpjs: {
                required: false,
                minLength: 13,
                maxLength: 13,
                pattern: /^\d{13}$/,
                message: 'Nomor BPJS harus 13 digit angka (jika diisi)'
            },
            alamat_lengkap: {
                required: true,
                minLength: 10,
                maxLength: 500,
                message: 'Alamat harus berisi 10-500 karakter'
            },
            kontak_darurat: {
                required: true,
                minLength: 10,
                maxLength: 15,
                pattern: /^(08|628)[0-9]{8,13}$/,
                message: 'Kontak darurat harus 10-15 digit, dimulai dengan 08 atau 628'
            },
            hubungan_kontak: {
                required: true,
                message: 'Hubungan kontak darurat harus dipilih'
            },
            keluhan: {
                required: true,
                message: 'Jenis layanan harus dipilih'
            },
            tgl_pendaftaran: {
                required: true,
                message: 'Tanggal kunjungan harus diisi'
            }
        };

        // Initialize validation
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tgl_pendaftaran').setAttribute('min', today);
            
            // Set maximum date for birth date (today)
            document.getElementById('tgl_lahir').setAttribute('max', today);

            // Initialize counters
            updateCounter('nik');
            updateCounter('no_hp');
            updateCounter('kontak_darurat');
            updateCounter('no_bpjs');

            // Add event listeners for real-time validation
            document.querySelectorAll('[data-validation]').forEach(function(element) {
                const fieldName = element.getAttribute('data-validation');
                
                element.addEventListener('input', function() {
                    validateField(fieldName);
                    if (['nik', 'no_hp', 'kontak_darurat', 'no_bpjs'].includes(fieldName)) {
                        updateCounter(fieldName);
                    }
                });

                element.addEventListener('blur', function() {
                    validateField(fieldName);
                });
            });

            // Auto refresh after error notification
            const errorNotification = document.getElementById('errorNotification');
            const countdownElement = document.getElementById('countdown');
            
            if (errorNotification && countdownElement) {
                let countdown = 3;
                
                const countdownInterval = setInterval(function() {
                    countdown--;
                    countdownElement.textContent = countdown;
                    
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        errorNotification.style.transition = 'opacity 0.5s ease-out';
                        errorNotification.style.opacity = '0';
                        
                        setTimeout(function() {
                            document.getElementById('pendaftaranForm').reset();
                            window.location.reload();
                        }, 500);
                    }
                }, 1000);
            }
        });

        // Update character counters
        function updateCounter(fieldName) {
            const element = document.getElementById(fieldName);
            const counter = document.getElementById(fieldName + '-counter');
            if (element && counter) {
                const current = element.value.length;
                const max = validationRules[fieldName].maxLength;
                counter.textContent = current + '/' + max;
                
                if (current > max) {
                    counter.classList.add('error');
                } else {
                    counter.classList.remove('error');
                }
            }
        }

        // Validate individual field
        function validateField(fieldName) {
            const element = document.getElementById(fieldName);
            const errorElement = document.getElementById(fieldName + '-error');
            const rule = validationRules[fieldName];
            
            if (!element || !rule) return true;
            
            const value = element.value.trim();
            let isValid = true;
            let errorMessage = '';

            // Check if required
            if (rule.required && !value) {
                isValid = false;
                errorMessage = 'Field ini wajib diisi';
            }
            // Check pattern for non-empty values or required fields
            else if ((value || rule.required) && rule.pattern && !rule.pattern.test(value)) {
                isValid = false;
                errorMessage = rule.message;
            }
            // Check length for non-empty values or required fields
            else if ((value || rule.required)) {
                if (rule.minLength && value.length < rule.minLength) {
                    isValid = false;
                    errorMessage = rule.message;
                } else if (rule.maxLength && value.length > rule.maxLength) {
                    isValid = false;
                    errorMessage = rule.message;
                }
            }

            // Special validation for dates
            if (fieldName === 'tgl_lahir' && value) {
                const birthDate = new Date(value);
                const today = new Date();
                if (birthDate > today) {
                    isValid = false;
                    errorMessage = 'Tanggal lahir tidak boleh di masa depan';
                }
                const age = today.getFullYear() - birthDate.getFullYear();
                if (age > 120) {
                    isValid = false;
                    errorMessage = 'Tanggal lahir tidak valid (umur terlalu tua)';
                }
            }

            if (fieldName === 'tgl_pendaftaran' && value) {
                const visitDate = new Date(value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                visitDate.setHours(0, 0, 0, 0);
                if (visitDate < today) {
                    isValid = false;
                    errorMessage = 'Tanggal kunjungan tidak boleh di masa lalu';
                }
            }

            // Special validation: kontak darurat tidak boleh sama dengan no HP
            if (fieldName === 'kontak_darurat' && value) {
                const noHp = document.getElementById('no_hp').value.trim();
                if (value === noHp) {
                    isValid = false;
                    errorMessage = 'Kontak darurat tidak boleh sama dengan nomor HP pribadi';
                }
            }

            // Update UI
            if (isValid) {
                element.classList.remove('is-invalid');
                if (errorElement) {
                    errorElement.textContent = '';
                    errorElement.style.display = 'none';
                }
            } else {
                element.classList.add('is-invalid');
                if (errorElement) {
                    errorElement.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>' + errorMessage;
                    errorElement.style.display = 'block';
                }
            }

            return isValid;
        }

        // Form submission validation
        document.getElementById('pendaftaranForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isFormValid = true;
            let errors = [];

            // Validate all fields
            Object.keys(validationRules).forEach(function(fieldName) {
                if (!validateField(fieldName)) {
                    isFormValid = false;
                    const rule = validationRules[fieldName];
                    const fieldLabel = document.querySelector(`label[for="${fieldName}"]`).textContent.replace(' *', '');
                    errors.push(fieldLabel + ': ' + rule.message);
                }
            });

            if (!isFormValid) {
                showErrorModal(errors);
                // Scroll to first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
                return false;
            }

            // Additional cross-field validation
            const noHp = document.getElementById('no_hp').value.trim();
            const kontakDarurat = document.getElementById('kontak_darurat').value.trim();
            
            if (noHp === kontakDarurat) {
                errors.push('Nomor HP dan kontak darurat tidak boleh sama');
                isFormValid = false;
            }

            if (!isFormValid) {
                showErrorModal(errors);
                return false;
            }

            // If all validation passes, submit the form
            this.submit();
        });

        function showErrorModal(errors) {
            const errorModalList = document.getElementById('errorModalList');
            errorModalList.innerHTML = '';
            
            errors.forEach(function(error) {
                const li = document.createElement('li');
                li.innerHTML = '<i class="error-icon fas fa-times-circle"></i>' + error;
                errorModalList.appendChild(li);
            });

            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        }

        // Auto format phone numbers (keep existing logic)
        document.getElementById('no_hp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            }
            e.target.value = value;
            updateCounter('no_hp');
        });

        document.getElementById('kontak_darurat').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            }
            e.target.value = value;
            updateCounter('kontak_darurat');
        });

        // Format NIK and BPJS (numbers only)
        document.getElementById('nik').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
            updateCounter('nik');
        });

        document.getElementById('no_bpjs').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
            updateCounter('no_bpjs');
        });

        // Format nama (letters and spaces only)
        document.getElementById('nama').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '');
        });
    </script>
</body>
</html>
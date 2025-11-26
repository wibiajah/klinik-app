<x-guest-layout title="Login">
    @auth
        @if (auth()->user()->role === \App\Models\User::ROLES['Admin'])
            <script>
                window.location.href = "{{ route('admin.dashboard') }}";
            </script>
        @endif
        @if (auth()->user()->role === \App\Models\User::ROLES['User'])
            <script>
                window.location.href = "{{ route('user.dashboard') }}";
            </script>
        @endif
    @else
        <div class="min-vh-100 d-flex align-items-center position-relative bg-white">
            <!-- Enhanced Medical Background -->
            <div class="position-absolute top-0 start-0 w-100 h-100"></div>

            <!-- Main Container -->
            <div class="container position-relative py-4">
                <div class="row justify-content-center">
                    <div class="col-12" style="max-width: 1100px;">
                        <!-- Completely Redesigned Card Layout -->
                        <div class="login-container">
                            <!-- Top Section with Clinic Info -->
                            <div class="clinic-banner text-center mb-4">
                                <div class="logo-container d-inline-block position-relative">
                                    <div class="logo-background-medical"></div>
                                    <img src="{{ asset('logo.png') }}" alt="KLINIK MARCHSYA Logo" class="logo-animate" style="height: 130px;">
                                </div>
                                <h2 class="clinic-name mt-3">KLINIK MARCHSYA</h2>
                                <p class="clinic-address">
                                    Jl. Flores No.140, Rawapasung, Sidanegara, Kec. Cilacap Tengah<br>
                                    Kabupaten Cilacap, Jawa Tengah 53224
                                </p>
                                <div class="clinic-features mt-3">
                                    <span class="feature-badge"><i class="fas fa-user-md"></i> Dokter Berpengalaman</span>
                                    <span class="feature-badge"><i class="fas fa-clock"></i> Pelayanan 24 Jam</span>
                                    <span class="feature-badge"><i class="fas fa-shield-alt"></i> Fasilitas Lengkap</span>
                                </div>
                            </div>

                            <!-- Two Cards Side by Side -->
                            <div class="row g-0">
                                <!-- Left Card: Medical Illustration -->
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <div class="medical-illustration-card h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                        <div class="illustration-wrapper mb-4">
                                            <!-- Medical Illustration SVG -->
                                            <div class="medical-illustration">
                                                <svg width="280" height="280" viewBox="0 0 280 280" class="floating-illustration">
                                                    <!-- Doctor silhouette -->
                                                    <circle cx="140" cy="80" r="35" fill="#ffffff" opacity="0.9"/>
                                                    <path d="M105 115 C105 115, 120 110, 140 110 C160 110, 175 115, 175 115 L175 200 C175 210, 165 220, 155 220 L125 220 C115 220, 105 210, 105 200 Z" fill="#ffffff" opacity="0.9"/>
                                                    <!-- Stethoscope -->
                                                    <path d="M120 130 Q110 125, 100 130 Q95 135, 100 140 Q110 145, 120 140" stroke="#10b981" stroke-width="3" fill="none"/>
                                                    <path d="M160 130 Q170 125, 180 130 Q185 135, 180 140 Q170 145, 160 140" stroke="#10b981" stroke-width="3" fill="none"/>
                                                    <path d="M120 135 Q130 125, 140 130 Q150 125, 160 135" stroke="#10b981" stroke-width="3" fill="none"/>
                                                    <!-- Medical symbols around -->
                                                    <g opacity="0.7">
                                                        <rect x="50" y="50" width="15" height="40" fill="#ef4444" rx="2"/>
                                                        <rect x="35" y="65" width="45" height="10" fill="#ef4444" rx="2"/>
                                                        <rect x="200" y="50" width="15" height="40" fill="#ef4444" rx="2"/>
                                                        <rect x="185" y="65" width="45" height="10" fill="#ef4444" rx="2"/>
                                                    </g>
                                                    <!-- Heartbeat line -->
                                                    <path d="M20 240 L50 240 L60 220 L70 260 L80 200 L90 240 L260 240" stroke="#ef4444" stroke-width="3" fill="none" opacity="0.8"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="welcome-text text-center">
                                            <h3 class="fw-bold welcome-title">Selamat Datang!</h3>
                                            <p class="welcome-subtitle">Kesehatan Anda adalah prioritas kami</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Card: Login Form -->
                                <div class="col-lg-6">
                                    <div class="login-form-card h-100 p-4 p-lg-5">
                                        <div class="text-center mb-4">
                                            <h3 class="form-title">Masuk Sistem</h3>
                                            <br>
                                            <p class="form-subtitle">Silakan masukkan kredensial Anda</p>
                                        </div>

                                        <form action="{{ route('login') }}" method="POST" class="floating-labels">
                                            @csrf
                                            @method('POST')

                                            <div class="form-group mb-4">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </span>
                                                    <div class="form-floating flex-grow-1">
                                                        <input type="name"
                                                            class="form-control custom-input @error('name') is-invalid @enderror"
                                                            name="name" id="name" placeholder="Username"
                                                            value="{{ old('name') }}">
                                                        <label for="name">Username</label>
                                                    </div>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-lock text-primary"></i>
                                                    </span>
                                                    <div class="form-floating flex-grow-1">
                                                        <input type="password"
                                                            class="form-control custom-input @error('password') is-invalid @enderror"
                                                            name="password" id="password" placeholder="Password">
                                                        <label for="password">Password</label>
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-decoration-none password-toggle"
                                                        style="z-index: 5;" onclick="togglePassword()">
                                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                                    </button>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <div class="form-check custom-checkbox">
                                                    <input type="checkbox" class="form-check-input" name="remember"
                                                        id="remember">
                                                    <label class="form-check-label" for="remember">Ingat saya</label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary w-100 btn-lg mb-4 medical-button">
                                                Masuk <i class="fas fa-sign-in-alt ms-2"></i>
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Medical Color Scheme */
            :root {
                --primary-color: #2563eb;
                --primary-hover: #1d4ed8;
                --secondary-color: #10b981;
                --accent-color: #ef4444;
                --success-color: #22c55e;
                --background-color: #f8fafc;
                --card-background: #ffffff;
                --text-primary: #1e293b;
                --text-secondary: #64748b;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            /* White Solid Background */
            .bg-white {
                background-color: #ffffff;
            }

            /* Medical Container */
            .login-container {
                max-width: 1100px;
                margin: 0 auto;
            }

            /* Clinic Banner */
            .clinic-banner {
                padding: 2rem;
                border-radius: 24px;
                margin-bottom: 2rem;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
                backdrop-filter: blur(10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .logo-container {
                position: relative;
                z-index: 1;
            }

            .logo-background-medical {
                position: absolute;
                width: 180px;
                height: 180px;
                background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, rgba(16, 185, 129, 0.05) 50%, rgba(255, 255, 255, 0) 100%);
                border-radius: 50%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: -1;
                animation: pulseGlow 4s ease-in-out infinite;
            }

            .logo-animate {
                height: 130px;
                position: relative;
                z-index: 2;
                animation: logoFloat 6s ease-in-out infinite;
            }

            .clinic-name {
                font-weight: 800;
                font-size: 2.5rem;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                margin-bottom: 0.5rem;
                letter-spacing: -0.5px;
            }

            .clinic-address {
                color: var(--text-secondary);
                font-size: 1rem;
                line-height: 1.6;
                margin-bottom: 1rem;
            }

            .clinic-features {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .feature-badge {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 500;
                box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
            }

            .feature-badge i {
                margin-right: 0.5rem;
            }

            /* Two Cards Layout */
            .medical-illustration-card,
            .login-form-card {
                border-radius: 24px;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                height: 100%;
            }

            /* Left Card: Medical Illustration */
            .medical-illustration-card {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                padding: 2rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            .medical-illustration-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M30 30c0-11.046-8.954-20-20-20s-20 8.954-20 20 8.954 20 20 20 20-8.954 20-20zm0 0c0 11.046 8.954 20 20 20s20-8.954 20-20-8.954-20-20-20-20 8.954-20 20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.3;
            }

            .floating-illustration {
                animation: float 8s ease-in-out infinite;
                filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.2));
            }

            .welcome-text {
                color: white;
                text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
                position: relative;
                z-index: 2;
            }

            .welcome-title {
                font-size: 2.2rem;
                margin-bottom: 0.5rem;
                font-weight: 700;
            }

            .welcome-subtitle {
                font-size: 1.1rem;
                opacity: 0.9;
            }

            /* Right Card: Login Form */
            .login-form-card {
                background-color: white;
                padding: 2.5rem;
            }

            .form-title {
                color: var(--text-primary);
                font-weight: 700;
                font-size: 1.8rem;
                margin-bottom: 0.5rem;
                position: relative;
            }

            .form-subtitle {
                color: var(--text-secondary);
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .form-title:after {
                content: '';
                position: absolute;
                width: 60px;
                height: 4px;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 4px;
            }

            /* Enhanced Input Styling */
            .input-group-text {
                background-color: white;
                border-right: none;
                border-top-left-radius: 12px;
                border-bottom-left-radius: 12px;
                border: 2px solid #e2e8f0;
                border-right: none;
                padding-left: 1.25rem;
                padding-right: 0.75rem;
            }

            .custom-input {
                border-top-right-radius: 12px !important;
                border-bottom-right-radius: 12px !important;
                border-top-left-radius: 0 !important;
                border-bottom-left-radius: 0 !important;
                padding: 1.15rem 1rem;
                border: 2px solid #e2e8f0;
                border-left: none;
                font-size: 1rem;
                transition: all 0.3s ease;
                background-color: #ffffff;
            }

            .form-floating>label {
                padding-left: 0.75rem;
            }

            .custom-input:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
                border-left: none;
            }

            .custom-input:focus+label {
                color: var(--primary-color);
            }

            .input-group:focus-within .input-group-text {
                border-color: var(--primary-color);
            }

            /* Enhanced Button Styling */
            .medical-button {
                border-radius: 12px;
                padding: 1rem 1.5rem;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                border: none;
                font-weight: 600;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .medical-button:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.1);
                transform: translateX(-100%);
                transition: transform 0.6s ease-out;
            }

            .medical-button:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 30px rgba(37, 99, 235, 0.3);
            }

            .medical-button:hover:before {
                transform: translateX(100%);
            }

            /* Enhanced Checkbox Styling */
            .custom-checkbox .form-check-input {
                border-radius: 6px;
                border: 2px solid #e2e8f0;
            }

            .custom-checkbox .form-check-input:checked {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            /* Password Toggle */
            .password-toggle {
                color: var(--text-secondary);
                transition: color 0.3s ease;
                margin-right: 0.5rem;
                z-index: 10;
            }

            .password-toggle:hover {
                color: var(--primary-color);
            }

            /* Animations */
            @keyframes float {
                0%, 100% {
                    transform: translateY(0) scale(1);
                }
                50% {
                    transform: translateY(-15px) scale(1.02);
                }
            }

            @keyframes logoFloat {
                0%, 100% {
                    transform: translateY(0) scale(1);
                }
                50% {
                    transform: translateY(-10px) scale(1.05);
                }
            }

            @keyframes pulseGlow {
                0%, 100% {
                    transform: translate(-50%, -50%) scale(1);
                    opacity: 0.8;
                }
                50% {
                    transform: translate(-50%, -50%) scale(1.1);
                    opacity: 1;
                }
            }

            .logo-animate {
                animation: logoFloat 6s ease-in-out infinite;
            }

            /* Responsive Styles */
            @media (max-width: 991.98px) {
                .clinic-banner {
                    margin-bottom: 1.5rem;
                    padding: 1.5rem;
                }

                .clinic-name {
                    font-size: 2rem;
                }

                .clinic-address {
                    font-size: 0.9rem;
                }

                .clinic-features {
                    flex-direction: column;
                    align-items: center;
                }

                .medical-illustration-card {
                    margin-bottom: 1.5rem;
                    padding: 1.5rem;
                }

                .welcome-title {
                    font-size: 1.8rem;
                }

                .welcome-subtitle {
                    font-size: 1rem;
                }

                .login-form-card {
                    padding: 1.5rem;
                }

                .form-title {
                    font-size: 1.5rem;
                }
            }

            @media (max-width: 576px) {
                .clinic-features {
                    gap: 0.5rem;
                }

                .feature-badge {
                    font-size: 0.8rem;
                    padding: 0.4rem 0.8rem;
                }

                .medical-logo svg {
                    width: 100px;
                    height: 100px;
                }

                .floating-illustration {
                    width: 200px;
                    height: 200px;
                }
            }
        </style>

        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
        </script>
    @endauth
</x-guest-layout>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik MARCHSYA - Pelayanan Kesehatan Terpercaya</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #00bc84 0%, #00a374 100%);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 188, 132, 0.3);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 10px 20px;
            border-radius: 25px;
            position: relative;
            overflow: hidden;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .cta-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ffffff, #f0f9ff);
            color: #00bc84;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #00bc84;
            transform: translateY(-3px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #00bc84 0%, #00a374 50%, #008f63 100%);
            color: white;
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="a" patternUnits="userSpaceOnUse" width="20" height="20"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23a)"/></svg>');
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
            background: linear-gradient(45deg, #ffffff, #e0f7fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.95;
            line-height: 1.6;
        }

        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .hero-icons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .hero-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .hero-icon:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.3);
        }

        .hero-icon i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background: linear-gradient(to bottom, #f8fdfc, #ffffff);
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: #00bc84;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .section-title p {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 188, 132, 0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 188, 132, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .service-card:hover::before {
            left: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 188, 132, 0.2);
            border-color: #00bc84;
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #00bc84, #00a374);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 25px rgba(0, 188, 132, 0.3);
        }

        .service-card h3 {
            font-size: 1.4rem;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .service-card p {
            color: #666;
            line-height: 1.6;
        }

        /* About Section */
        .about {
            padding: 80px 0;
            background: #f8fdfc;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-text h2 {
            font-size: 2.5rem;
            color: #00bc84;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .about-text p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .stat-item {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 188, 132, 0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #00bc84;
            display: block;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #00bc84 0%, #00a374 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-content h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .cta-content p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        .cta-buttons-large {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-large {
            padding: 18px 35px;
            font-size: 1.1rem;
            border-radius: 30px;
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 50px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            color: #00bc84;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .footer-section p, .footer-section a {
            color: #ccc;
            text-decoration: none;
            line-height: 1.8;
        }

        .footer-section a:hover {
            color: #00bc84;
        }

        .footer-bottom {
            border-top: 1px solid #555;
            padding-top: 20px;
            text-align: center;
            color: #999;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .about-content {
                grid-template-columns: 1fr;
            }

            .cta-buttons-large {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            background: linear-gradient(135deg, #00bc84, #00a374);
            color: white;
            padding: 25px 30px;
            border-radius: 20px 20px 0 0;
            position: relative;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close:hover {
            opacity: 0.7;
            transform: translateY(-50%) scale(1.1);
        }

        .modal-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00bc84;
            box-shadow: 0 0 0 3px rgba(0, 188, 132, 0.1);
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(45deg, #00bc84, #00a374);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 188, 132, 0.3);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
            color: #666;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="container nav">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="Logo Klinik MARCHSYA">
                <span>Klinik MARCHSYA</span>
            </div>
            <div class="nav-links">
                <a href="#home">Beranda</a>
                <a href="#layanan">Layanan</a>
                <a href="#tentang">Tentang</a>
                <a href="#kontak">Kontak</a>
            </div>
            <div class="cta-buttons">
        <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
<a href="{{ route('pendaftaran.create') }}" class="btn btn-secondary">Daftar Pasien</a>

            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Pelayanan Kesehatan Terpercaya</h1>
                    <p>Klinik MARCHSYA hadir untuk memberikan layanan kesehatan berkualitas dengan teknologi modern dan tenaga medis profesional. Akses mudah, cepat, dan terjangkau untuk seluruh keluarga.</p>
                    <div class="cta-buttons">
                         <a href="{{ route('pendaftaran.create') }}" class="btn btn-large btn-primary">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </a>
                     <a href="{{ route('pendaftaran.check-status') }}" class="btn btn-large btn-secondary">
                            <i class="fas fa-search"></i> Cek Status Pendaftaran
                        </a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-card">
                        <div style="text-align: center; margin-bottom: 20px;">
                            <i class="fas fa-heartbeat" style="font-size: 3rem; color: white;"></i>
                            <h3 style="margin: 15px 0; color: white;">Layanan 24/7</h3>
                        </div>
                        <div class="hero-icons">
                            <div class="hero-icon">
                                <i class="fas fa-stethoscope"></i>
                                <p>Dokter Umum</p>
                            </div>
                            <div class="hero-icon">
                                <i class="fas fa-vial"></i>
                                <p>Laboratorium</p>
                            </div>
                            <div class="hero-icon">
                                <i class="fas fa-x-ray"></i>
                                <p>Radiologi</p>
                            </div>
                            <div class="hero-icon">
                                <i class="fas fa-user-md"></i>
                                <p>Konsultasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="layanan">
        <div class="container">
            <div class="section-title">
                <h2>Layanan Kami</h2>
                <p>Memberikan pelayanan kesehatan komprehensif dengan standar medis terbaik</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3>Pemeriksaan Dokter Umum</h3>
                    <p>Konsultasi dan pemeriksaan kesehatan umum dengan dokter berpengalaman untuk mendiagnosis dan menangani berbagai keluhan kesehatan.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-vial"></i>
                    </div>
                    <h3>Laboratorium</h3>
                    <p>Layanan pemeriksaan laboratorium lengkap termasuk tes darah, urine, dan pemeriksaan penunjang medis lainnya dengan hasil akurat.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-x-ray"></i>
                    </div>
                    <h3>Radiologi</h3>
                    <p>Fasilitas radiologi modern untuk pemeriksaan rontgen dan imaging medis guna mendukung diagnosis yang tepat dan akurat.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h3>Surat Keterangan Sehat</h3>
                    <p>Penerbitan surat keterangan sehat untuk berbagai keperluan seperti melamar kerja, sekolah, atau keperluan administrasi lainnya.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-pills"></i>
                    </div>
                    <h3>Farmasi</h3>
                    <p>Apotek lengkap dengan berbagai obat-obatan berkualitas dan konsultasi farmasi untuk penggunaan obat yang tepat.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h3>Pelayanan Darurat</h3>
                    <p>Layanan gawat darurat 24 jam dengan tim medis siaga untuk menangani kondisi medis yang memerlukan penanganan segera.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="tentang">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Tentang Klinik MARCHSYA</h2>
                    <p>Klinik MARCHSYA merupakan unit usaha di bidang kesehatan dari PT Sentosa Karya Aditama yang telah berpengalaman sejak 1999. Berlokasi strategis di Jl. Flores No.140, Kelurahan Rawapasung, Kecamatan Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah.</p>
                    <p>Kami berkomitmen memberikan akses layanan kesehatan yang lebih mudah, cepat, dan terjangkau bagi masyarakat di wilayah Cilacap dan sekitarnya. Dengan dukungan teknologi digital terkini, kami menghadirkan sistem pelayanan terintegrasi untuk kemudahan pasien.</p>
                    <p>Klinik MARCHSYA dilengkapi dengan fasilitas medis modern dan tenaga medis profesional yang siap melayani berbagai kebutuhan kesehatan Anda dan keluarga.</p>
                </div>
                <div class="about-stats">
                    <div class="stat-item">
                        <span class="stat-number">25+</span>
                        <span class="stat-label">Tahun Pengalaman</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">1000+</span>
                        <span class="stat-label">Pasien Terlayani</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Layanan Darurat</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Komitmen Kualitas</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Mulai Perjalanan Kesehatan Anda</h2>
                <p>Daftar sekarang dan rasakan kemudahan layanan kesehatan digital Klinik MARCHSYA</p>
                <div class="cta-buttons-large">
                   <a href="{{ route('pendaftaran.create') }}" class="btn btn-large btn-primary">
                        <i class="fas fa-user-plus"></i> Daftar Sebagai Pasien Baru
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-large btn-secondary">
                        <i class="fas fa-sign-in-alt"></i> Masuk ke Akun Anda
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Klinik MARCHSYA</h3>
                    <p>Pelayanan kesehatan terpercaya dengan teknologi modern untuk kemudahan dan kenyamanan pasien.</p>
                    <p><i class="fas fa-map-marker-alt"></i> Jl. Flores No.140, Rawapasung, Cilacap Tengah, Cilacap, Jawa Tengah</p>
                </div>
                <div class="footer-section">
                    <h3>Layanan</h3>
                    <p><a href="#">Dokter Umum</a></p>
                    <p><a href="#">Laboratorium</a></p>
                    <p><a href="#">Radiologi</a></p>
                    <p><a href="#">Farmasi</a></p>
                </div>
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p><i class="fas fa-phone"></i> (0282) 123-4567</p>
                    <p><i class="fas fa-envelope"></i> info@klinikmarchsya.com</p>
                    <p><i class="fas fa-clock"></i> Senin - Minggu: 24 Jam</p>
                </div>
                <div class="footer-section">
                    <h3>Jam Operasional</h3>
                    <p>Senin - Jumat: 08:00 - 20:00</p>
                    <p>Sabtu - Minggu: 08:00 - 18:00</p>
                    <p>Layanan Darurat: 24 Jam</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Klinik MARCHSYA. Semua hak dilindungi. PT Sentosa Karya Aditama.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    

    <!-- Register Modal -->
    

    <!-- Daftar Pasien Modal -->
    

    <!-- Status Modal -->
    

    <script>
        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'linear-gradient(135deg, rgba(0, 188, 132, 0.95) 0%, rgba(0, 163, 116, 0.95) 100%)';
            } else {
                header.style.background = 'linear-gradient(135deg, #00bc84 0%, #00a374 100%)';
            }
        });

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#e74c3c';
                        isValid = false;
                    } else {
                        field.style.borderColor = '#00bc84';
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang diperlukan');
                }
            });
        });

        // Input focus effects
        document.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#00bc84';
                this.style.boxShadow = '0 0 0 3px rgba(0, 188, 132, 0.1)';
            });
            
            input.addEventListener('blur', function() {
                if (this.value) {
                    this.style.borderColor = '#00bc84';
                } else {
                    this.style.borderColor = '#e0e0e0';
                }
                this.style.boxShadow = 'none';
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe service cards and other elements
        document.querySelectorAll('.service-card, .stat-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });

        // Mobile menu toggle (for future implementation)
        function toggleMobileMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('mobile-open');
        }

        // Loading animation for buttons
        document.querySelectorAll('.btn-submit').forEach(btn => {
            btn.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                this.disabled = true;
                
                // Re-enable button after form submission (in case of validation errors)
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 3000);
            });
        });
    </script>
</body>
</html>
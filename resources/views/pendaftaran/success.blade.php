<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - Klinik</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .success-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .success-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 188, 132, 0.15);
            padding: 3rem;
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin: 0 1rem;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #00bc84;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 2rem;
        }
        .success-title {
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .success-message {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .btn-primary {
            background: #00bc84;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #00a374;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 188, 132, 0.3);
        }
        .btn-outline-secondary {
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-color: #00bc84;
            color: #00bc84;
        }
        .btn-outline-secondary:hover {
            background: #00bc84;
            border-color: #00bc84;
            color: white;
        }
        .info-box {
            background: #f8f9fc;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
            border-left: 4px solid #00bc84;
        }
        .text-primary {
            color: #00bc84 !important;
        }
        .animation-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <img src="{{ asset('logo.png') }}" alt="Logo Klinik" class="logo">
            
            <div class="success-icon animation-float">
                <i class="fas fa-check"></i>
            </div>
            
            <h2 class="success-title">Pendaftaran Berhasil!</h2>
            
            <p class="success-message">
                Terima kasih telah mendaftar di klinik kami. Pendaftaran Anda telah berhasil dikirim dan sedang menunggu konfirmasi dari admin.
            </p>

            <div class="info-box">
                <h6 class="mb-2"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Penting:</h6>
                <ul class="list-unstyled mb-0 text-start">
                    <li class="mb-1">• Admin akan mengkonfirmasi pendaftaran Anda</li>
                    <li class="mb-1">• Anda akan mendapat nomor rekam medis setelah dikonfirmasi</li>
                    <li class="mb-1">• Silakan datang pada tanggal yang telah Anda pilih</li>
                    <li>• Bawa dokumen identitas dan BPJS (jika ada)</li>
                </ul>
            </div>

            <div class="d-grid gap-2">
                <a href="/pendaftaran/check-status" class="btn btn-primary">
                    <i class="fas fa-search me-2"></i>
                    Cek Status Pendaftaran
                </a>
                <a href="/pendaftaran" class="btn btn-outline-secondary">
                    <i class="fas fa-plus me-2"></i>
                    Daftar Lagi
                </a>
                <a href="/" class="btn btn-outline-secondary">
                    <i class="fas fa-home me-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
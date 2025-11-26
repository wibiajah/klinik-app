<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pendaftaran - Klinik</title>
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
        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #00bc84;
            box-shadow: 0 0 0 0.2rem rgba(0, 188, 132, 0.25);
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-text {
            color: #6c757d;
            font-size: 0.875rem;
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
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border-color: #00bc84;
            color: #00bc84;
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
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('logo.png') }}" alt="Logo Klinik" class="logo">
                        <h3 class="mb-0">
                            <i class="fas fa-search me-2"></i>
                            Cek Status Pendaftaran
                        </h3>
                        <p class="mb-0 mt-2">Masukkan NIK KTP untuk melihat status pendaftaran Anda</p>
                    </div>
                    <div class="card-body p-4">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('pendaftaran.status') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="nik" class="form-label">NIK KTP</label>
                                <input type="text" class="form-control" id="nik" name="nik" 
                                       maxlength="16" placeholder="Masukkan 16 digit NIK KTP" 
                                       value="{{ old('nik') }}" required>
                                <div class="form-text">Masukkan NIK sesuai dengan yang didaftarkan</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>
                                    Cek Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Link kembali -->
                <div class="text-center mt-4">
                    <a href="/pendaftaran" class="btn btn-outline-light me-2">
                        <i class="fas fa-plus me-2"></i>
                        Daftar Baru
                    </a>
                    <a href="/" class="btn btn-outline-light">
                        <i class="fas fa-home me-2"></i>
                        Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto format NIK input
        document.getElementById('nik').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });
    </script>
</body>
</html>
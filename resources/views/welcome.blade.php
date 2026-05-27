<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Kerusakan Hardware</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .hero {
            padding: 80px 0;
            color: white;
        }
        .btn-konsultasi {
            background: white;
            color: #667eea;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 18px;
        }
        .btn-konsultasi:hover {
            transform: scale(1.05);
            background: white;
            color: #667eea;
        }
        .card-fitur {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            height: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Sistem Pakar Hardware</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kontak') }}">
                            <i class="bi bi-envelope"></i> Kontak Pengembang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-shield-lock"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Diagnosa Kerusakan Hardware</h1>
            <p class="lead mt-3">Metode Forward Chaining + Certainty Factor</p>
            <a href="{{ route('konsultasi.create') }}" class="btn btn-konsultasi mt-4">
                <i class="bi bi-chat-dots"></i> Mulai Konsultasi
            </a>
        </div>
    </section>

    <footer class="text-center text-white py-4">
        <small>&copy; Sistem Pakar Diagnosa Kerusakan Hardware</small>
    </footer>
</body>
</html>
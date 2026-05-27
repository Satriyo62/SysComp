<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Hardware - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-dark text-white min-vh-100 p-0">
                <div class="text-center py-4 border-bottom border-secondary">
                    <h5>Sistem Pakar</h5>
                    <small>Diagnosa Hardware</small>
                </div>
                <nav class="nav flex-column mt-3">
                    <a class="nav-link text-white py-2 px-4 {{ request()->routeIs('dashboard') ? 'bg-primary' : '' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link text-white py-2 px-4 {{ request()->routeIs('kerusakan.*') ? 'bg-primary' : '' }}" 
                       href="{{ route('kerusakan.index') }}">
                        <i class="bi bi-pc-display"></i> Data Kerusakan
                    </a>
                    <a class="nav-link text-white py-2 px-4 {{ request()->routeIs('gejala.*') ? 'bg-primary' : '' }}" 
                       href="{{ route('gejala.index') }}">
                        <i class="bi bi-exclamation-triangle"></i> Data Gejala
                    </a>
                    <a class="nav-link text-white py-2 px-4 {{ request()->routeIs('rule.*') ? 'bg-primary' : '' }}" 
                       href="{{ route('rule.index') }}">
                        <i class="bi bi-diagram-3"></i> Basis Pengetahuan
                    </a>
                    <a class="nav-link text-white py-2 px-4 {{ request()->routeIs('riwayat.*') ? 'bg-primary' : '' }}" 
                       href="{{ route('riwayat.index') }}">
                        <i class="bi bi-clock-history"></i> Riwayat Konsultasi
                    </a>
                    <hr class="bg-secondary mx-3">
                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
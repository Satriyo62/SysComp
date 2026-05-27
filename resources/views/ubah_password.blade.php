@extends('layouts.master')

@section('title', 'Ubah Password')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Password</h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Ganti Password Administrator</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <form action="{{ route('ubah_password.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="konfirmasi_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-body">
                <div class="alert alert-info">
                    <small>
                        <strong>Informasi:</strong><br>
                        - Password default: admin123<br>
                        - Setelah mengubah password, gunakan password baru untuk login berikutnya
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.guest')

@section('title', 'Kontak Pengembang')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h5><i class="bi bi-envelope"></i> Kontak Pengembang</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('kontak.kirim') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-send"></i> Kirim Pesan
                        </button>
                    </form>
                    
                    <hr>
                    <div class="text-center">
                        <h6>Informasi Pengembang:</h6>
                        <p class="small">
                            <i class="bi bi-person"></i> Oka Saputra, Iskandar Fitri, Endah Tri Esti Handayani<br>
                            <i class="bi bi-building"></i> Program Studi Informatika, Fakultas Teknologi Komunikasi dan Informatika<br>
                            <i class="bi bi-university"></i> Universitas Nasional
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
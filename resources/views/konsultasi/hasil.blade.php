@extends('layouts.guest')

@section('title', 'Hasil Diagnosa')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h5>Hasil Diagnosa</h5>
                </div>
                <div class="card-body">
                    <!-- Biodata User -->
                    <div class="mb-4">
                        <h6>Data Pasien</h6>
                        <table class="table table-sm table-borderless">
                            <tr><th width="120">Nama</th><td>: {{ $konsultasi->nama }}</td></tr>
                            <tr><th>Jenis Kelamin</th><td>: {{ $konsultasi->jenis_kelamin }}</td></tr>
                            <tr><th>Umur</th><td>: {{ $konsultasi->umur }} tahun</td></tr>
                        </table>
                    </div>
                    
                    <!-- Gejala Dipilih -->
                    <div class="mb-4">
                        <h6>Gejala yang Dialami</h6>
                        <ul>
                            @foreach($gejalaDipilih as $g)
                            <li>{{ $g->kode_gejala }} - {{ $g->nama_gejala }} 
                                (Tingkat Keyakinan: {{ $g->pivot->cf_user * 100 }}%)
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <!-- Hasil Diagnosa -->
                    <div class="alert alert-info">
                        <h6 class="mb-2">Hasil Diagnosa:</h6>
                        <h4 class="mb-0">{{ $konsultasi->hasil_diagnosa ?? 'Tidak Terdeteksi' }}</h4>
                    </div>
                    
                    <!-- Tingkat Keyakinan CF -->
                    <div class="alert alert-success">
                        <h6 class="mb-2">Tingkat Keyakinan (Certainty Factor):</h6>
                        <h3 class="mb-0">{{ $konsultasi->cf_akhir ?? 0 }}%</h3>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('konsultasi.detail_perhitungan', $konsultasi) }}" class="btn btn-info">
                            <i class="bi bi-calculator"></i> Lihat Rumus Perhitungan
                        </a>
                        <a href="{{ route('konsultasi.cetak', $konsultasi) }}" class="btn btn-primary" target="_blank">
                            <i class="bi bi-printer"></i> Cetak Hasil
                        </a>
                        <a href="{{ route('konsultasi.create') }}" class="btn btn-secondary">
                            <i class="bi bi-chat-dots"></i> Konsultasi Lagi
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
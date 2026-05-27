@extends('layouts.guest')

@section('title', 'Hasil Diagnosa')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
                            <tr><th>Tanggal</th><td>: {{ $konsultasi->created_at->format('d/m/Y H:i') }}</td></tr>
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
                    
                    <!-- Hasil Diagnosa Tertinggi -->
                    <div class="alert alert-info">
                        <h6 class="mb-2">Hasil Diagnosa:</h6>
                        <h4 class="mb-0">{{ $konsultasi->hasil_diagnosa ?? 'Tidak Terdeteksi' }}</h4>
                        <h5 class="mt-2">Tingkat Keyakinan: {{ $konsultasi->cf_akhir ?? 0 }}%</h5>
                    </div>
                    
                    <!-- Tabel Ranking Semua Kemungkinan Kerusakan (Seperti di PDF) -->
                    <div class="mt-4">
                        <h6>Tabel Ranking Kemungkinan Kerusakan:</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Kode</th>
                                        <th>Jenis Kerusakan</th>
                                        <th width="120">Kepercayaan CF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($semuaHasil as $index => $item)
                                    <tr @if($index == 0) class="table-success" @endif>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item['kode_kerusakan'] ?? '-' }}</td>
                                        <td>{{ $item['nama_kerusakan'] ?? '-' }}</td>
                                        <td class="fw-bold">{{ $item['cf_persen'] ?? 0 }}%</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="d-flex gap-2 mt-4 flex-wrap">
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
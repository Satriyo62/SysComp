@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Data Kerusakan</h5>
                <h2 class="mb-0">{{ $totalKerusakan }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Data Gejala</h5>
                <h2 class="mb-0">{{ $totalGejala }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Basis Pengetahuan</h5>
                <h2 class="mb-0">{{ $totalRule }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Riwayat Konsultasi</h5>
                <h2 class="mb-0">{{ $totalKonsultasi }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Selamat Datang di Sistem Pakar</h5>
    </div>
    <div class="card-body">
        <p>Sistem pakar diagnosa kerusakan hardware komputer menggunakan metode <strong>Forward Chaining</strong> dan <strong>Certainty Factor</strong>.</p>
        <hr>
        <h6>Menu Admin:</h6>
        <ul>
            <li><strong>Data Kerusakan</strong> - Input/manage jenis kerusakan, penyebab, solusi</li>
            <li><strong>Data Gejala</strong> - Input/manage gejala kerusakan</li>
            <li><strong>Basis Pengetahuan</strong> - Buat relasi antara gejala dan kerusakan (rule)</li>
            <li><strong>Riwayat Konsultasi</strong> - Lihat hasil diagnosa user</li>
        </ul>
    </div>
</div>
@endsection
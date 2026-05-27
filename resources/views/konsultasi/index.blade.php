@extends('layouts.master')

@section('title', 'Riwayat Konsultasi')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Riwayat Konsultasi</h1>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr><th>No</th><th>Nama</th><th>JK</th><th>Umur</th><th>Hasil Diagnosa</th><th>CF</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            @forelse($konsultasis as $i => $k)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->jenis_kelamin }}</td>
                <td>{{ $k->umur }}</td>
                <td>{{ $k->hasil_diagnosa ?? '-' }}</td>
                <td>{{ $k->cf_akhir ? $k->cf_akhir.'%' : '-' }}</td>
                <td>{{ $k->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Belum ada riwayat konsultasi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
@extends('layouts.master')

@section('title', 'Data Kerusakan')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Kerusakan Hardware</h1>
    <a href="{{ route('kerusakan.create') }}" class="btn btn-primary">+ Tambah Kerusakan</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr><th>Kode</th><th>Nama Kerusakan</th><th>Penyebab</th><th>Solusi</th><th width="100">Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($kerusakans as $kerusakan)
            <tr>
                <td>{{ $kerusakan->kode_kerusakan }}</td>
                <td>{{ $kerusakan->nama_kerusakan }}</td>
                <td>{{ Str::limit($kerusakan->penyebab, 60) }}</td>
                <td>{{ Str::limit($kerusakan->solusi, 60) }}</td>
                <td>
                    <a href="{{ route('kerusakan.edit', $kerusakan) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kerusakan.destroy', $kerusakan) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
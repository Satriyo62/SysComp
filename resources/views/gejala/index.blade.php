@extends('layouts.master')

@section('title', 'Data Gejala')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Gejala Kerusakan</h1>
    <a href="{{ route('gejala.create') }}" class="btn btn-primary">+ Tambah Gejala</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr><th>Kode</th><th>Nama Gejala</th><th width="100">Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($gejalas as $gejala)
            <tr>
                <td>{{ $gejala->kode_gejala }}</td>
                <td>{{ $gejala->nama_gejala }}</td>
                <td>
                    <a href="{{ route('gejala.edit', $gejala) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('gejala.destroy', $gejala) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
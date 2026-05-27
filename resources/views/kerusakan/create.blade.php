@extends('layouts.master')

@section('title', 'Tambah Kerusakan')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Data Kerusakan</h1>
    <a href="{{ route('kerusakan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kerusakan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Kerusakan</label>
                <input type="text" name="kode_kerusakan" class="form-control" placeholder="Contoh: P001" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Kerusakan</label>
                <input type="text" name="nama_kerusakan" class="form-control" placeholder="Contoh: Kerusakan VGA Ringan" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Penyebab</label>
                <textarea name="penyebab" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Solusi</label>
                <textarea name="solusi" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('title', 'Tambah Gejala')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Data Gejala</h1>
    <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('gejala.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Gejala</label>
                <input type="text" name="kode_gejala" class="form-control" placeholder="Contoh: G01" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Gejala</label>
                <input type="text" name="nama_gejala" class="form-control" placeholder="Contoh: Blue Screen" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('title', 'Edit Kerusakan')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Kerusakan</h1>
    <a href="{{ route('kerusakan.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kerusakan.update', $kerusakan) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Kode Kerusakan</label>
                <input type="text" name="kode_kerusakan" class="form-control" value="{{ $kerusakan->kode_kerusakan }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Kerusakan</label>
                <input type="text" name="nama_kerusakan" class="form-control" value="{{ $kerusakan->nama_kerusakan }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Penyebab</label>
                <textarea name="penyebab" class="form-control" rows="3" required>{{ $kerusakan->penyebab }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Solusi</label>
                <textarea name="solusi" class="form-control" rows="3" required>{{ $kerusakan->solusi }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
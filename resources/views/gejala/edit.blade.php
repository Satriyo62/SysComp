@extends('layouts.master')

@section('title', 'Edit Gejala')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Gejala</h1>
    <a href="{{ route('gejala.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('gejala.update', $gejala) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Kode Gejala</label>
                <input type="text" name="kode_gejala" class="form-control" value="{{ $gejala->kode_gejala }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Gejala</label>
                <input type="text" name="nama_gejala" class="form-control" value="{{ $gejala->nama_gejala }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
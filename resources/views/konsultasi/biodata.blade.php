@extends('layouts.guest')

@section('title', 'Konsultasi - Biodata')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h5>Step 1: Isi Biodata</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('konsultasi.storeBiodata') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Umur</label>
                            <input type="number" name="umur" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lanjut ke Pilih Gejala</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
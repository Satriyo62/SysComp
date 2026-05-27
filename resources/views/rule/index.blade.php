@extends('layouts.master')

@section('title', 'Basis Pengetahuan')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Basis Pengetahuan (Relasi Gejala → Kerusakan)</h1>
</div>

<div class="row">
    <!-- Form Tambah Rule -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Tambah Relasi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('rule.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Kerusakan</label>
                        <select name="kerusakan_id" class="form-select" required>
                            <option value="">Pilih Kerusakan</option>
                            @foreach($kerusakans as $kerusakan)
                            <option value="{{ $kerusakan->id }}">{{ $kerusakan->kode_kerusakan }} - {{ $kerusakan->nama_kerusakan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gejala</label>
                        <select name="gejala_id" class="form-select" required>
                            <option value="">Pilih Gejala</option>
                            @foreach($gejalas as $gejala)
                            <option value="{{ $gejala->id }}">{{ $gejala->kode_gejala }} - {{ $gejala->nama_gejala }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">MB (Measure of Belief)</label>
                            <select name="mb" class="form-select" required>
                                <option value="1">1 - Sangat Yakin</option>
                                <option value="0.8">0.8 - Yakin</option>
                                <option value="0.6">0.6 - Cukup Yakin</option>
                                <option value="0.4">0.4 - Sedikit Yakin</option>
                                <option value="0.2">0.2 - Kurang Yakin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">MD (Measure of Disbelief)</label>
                            <select name="md" class="form-select" required>
                                <option value="0">0 - Tidak Ragu</option>
                                <option value="0.2">0.2 - Kurang Ragu</option>
                                <option value="0.4">0.4 - Sedikit Ragu</option>
                                <option value="0.6">0.6 - Cukup Ragu</option>
                                <option value="0.8">0.8 - Ragu</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 w-100">Simpan Relasi</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Tabel Rule -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5>Daftar Relasi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-dark">
                            <tr><th>Kerusakan</th><th>Gejala</th><th>MB</th><th>MD</th><th>CF</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            @forelse($rules as $rule)
                            <tr>
                                <td>{{ $rule->kerusakan->kode_kerusakan }} - {{ $rule->kerusakan->nama_kerusakan }}</td>
                                <td>{{ $rule->gejala->kode_gejala }} - {{ $rule->gejala->nama_gejala }}</td>
                                <td>{{ $rule->mb }}</td><td>{{ $rule->md }}</td>
                                <td>{{ $rule->mb - $rule->md }}</td>
                                <td>
                                    <form action="{{ route('rule.destroy', [$rule->kerusakan_id, $rule->gejala_id]) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus relasi?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center">Belum ada relasi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h6>Keterangan Nilai Keyakinan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <strong>MB (Measure of Belief) - Tingkat Kepercayaan:</strong>
                <ul>
                    <li>1 = Sangat Yakin</li>
                    <li>0.8 = Yakin</li>
                    <li>0.6 = Cukup Yakin</li>
                    <li>0.4 = Sedikit Yakin</li>
                    <li>0.2 = Kurang Yakin</li>
                </ul>
            </div>
            <div class="col-md-6">
                <strong>MD (Measure of Disbelief) - Tingkat Keraguan:</strong>
                <ul>
                    <li>0 = Tidak Ragu</li>
                    <li>0.2 = Kurang Ragu</li>
                    <li>0.4 = Sedikit Ragu</li>
                    <li>0.6 = Cukup Ragu</li>
                    <li>0.8 = Ragu</li>
                </ul>
            </div>
        </div>
        <hr>
        <strong>Rumus CF (Certainty Factor):</strong> CF = MB - MD
    </div>
</div>
@endsection
@extends('layouts.guest')

@section('title', 'Detail Perhitungan CF')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5>Detail Perhitungan Certainty Factor</h5>
                    <small>Nama: {{ $konsultasi->nama }}</small>
                </div>
                <div class="card-body">
                    <h6>Rumus yang digunakan:</h6>
                    <div class="alert alert-secondary">
                        <code>CF[h,e] = MB[h,e] - MD[h,e]</code><br>
                        <code>CF Combine = CF1 + CF2 × (1 - CF1)</code>
                    </div>
                    
                    <h6 class="mt-4">Detail Perhitungan per Gejala:</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Kerusakan</th>
                                    <th>Gejala</th>
                                    <th>MB</th>
                                    <th>MD</th>
                                    <th>CF Rule</th>
                                    <th>CF User</th>
                                    <th>CF Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailPerhitungan as $item)
                                <tr>
                                    <td>{{ $item['kerusakan'] }}</td>
                                    <td>{{ $item['gejala'] }}</td>
                                    <td>{{ $item['mb'] }}</td>
                                    <td>{{ $item['md'] }}</td>
                                    <td>{{ $item['cf_rule'] }}</td>
                                    <td>{{ $item['cf_user'] }}</td>
                                    <td class="fw-bold">{{ $item['cf_hasil'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <h6 class="mt-4">Perhitungan CF Gabungan:</h6>
                    <div class="alert alert-success">
                        <strong>Hasil Akhir CF = {{ $cfGabungan }}%</strong>
                        <br>
                        <small>Rumus: CF1 + CF2 × (1 - CF1) dan seterusnya</small>
                    </div>
                    
                    <div class="mt-3">
                        <a href="{{ route('konsultasi.hasil', $konsultasi) }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Hasil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.guest')

@section('title', 'Konsultasi - Pilih Gejala')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Step 2: Pilih Gejala yang Dialami</h5>
                    <small>Nama: {{ $konsultasi->nama }}</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('konsultasi.proses', $konsultasi) }}" method="POST">
                        @csrf
                        <p class="text-muted">Centang gejala yang Anda alami dan pilih tingkat keyakinan:</p>
                        
                        @foreach($gejalas as $index => $gejala)
                        <div class="card mb-2">
                            <div class="card-body py-2">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="gejala[{{ $index }}][id]" value="{{ $gejala->id }}" 
                                                   id="gejala{{ $gejala->id }}">
                                            <label class="form-check-label" for="gejala{{ $gejala->id }}">
                                                <strong>{{ $gejala->kode_gejala }}</strong> - {{ $gejala->nama_gejala }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <select name="gejala[{{ $index }}][cf]" class="form-select form-select-sm" disabled>
                                            <option value="1">Sangat Yakin (1.0)</option>
                                            <option value="0.8">Yakin (0.8)</option>
                                            <option value="0.6">Cukup Yakin (0.6)</option>
                                            <option value="0.4">Sedikit Yakin (0.4)</option>
                                            <option value="0.2">Kurang Yakin (0.2)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <button type="submit" class="btn btn-primary w-100 mt-3">Proses Diagnosa</button>
                        <a href="{{ route('konsultasi.create') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let select = this.closest('.row').querySelector('select');
            select.disabled = !this.checked;
        });
    });
</script>
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa - {{ $konsultasi->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
        .header { text-align: center; margin-bottom: 30px; }
        .hasil { background: #e8f4f8; padding: 15px; border-radius: 10px; }
        .ranking-table { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3>SISTEM PAKAR DIAGNOSA KERUSAKAN HARDWARE</h3>
            <p>Metode Forward Chaining & Certainty Factor</p>
            <hr>
        </div>
        
        <div class="row">
            <div class="col-12">
                <h5>HASIL KONSULTASI</h5>
                
                <!-- Tabel Biodata -->
                <table class="table table-bordered">
                    <tr><th width="150">Nama</th><td>{{ $konsultasi->nama }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>{{ $konsultasi->jenis_kelamin }}</td></tr>
                    <tr><th>Umur</th><td>{{ $konsultasi->umur }} tahun</td></tr>
                    <tr><th>Tanggal Konsultasi</th><td>{{ $konsultasi->created_at->format('d/m/Y H:i') }}</td></tr>
                </table>
                
                <!-- Gejala Terpilih -->
                <h5 class="mt-4">Gejala yang Dialami:</h5>
                <ul>
                    @foreach($gejalaDipilih as $g)
                    <li>{{ $g->kode_gejala }} - {{ $g->nama_gejala }} (Keyakinan: {{ $g->pivot->cf_user * 100 }}%)</li>
                    @endforeach
                </ul>
                
                <!-- Hasil Analisa -->
                <div class="hasil">
                    <h5>Hasil Analisa:</h5>
                    <h4>Terdiagnosa Sebagai: <strong>{{ $konsultasi->hasil_diagnosa ?? 'Tidak Terdeteksi' }}</strong> ({{ $konsultasi->cf_akhir ?? 0 }}%)</h4>
                    
                    @php
                        $tertinggi = $semuaHasil[0] ?? null;
                    @endphp
                    @if($tertinggi)
                        <h5 class="mt-3">Solusi:</h5>
                        <p>{{ $tertinggi['solusi'] ?? '-' }}</p>
                        
                        <h5>Penyebab:</h5>
                        <ul>
                            @foreach(explode("\n", $tertinggi['penyebab'] ?? '-') as $penyebab)
                                @if(trim($penyebab))
                                    <li>{{ trim($penyebab) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
                
                <!-- Tabel Ranking Kerusakan (Seperti di PDF Gambar 9) -->
                <div class="ranking-table">
                    <h5>Tabel Ranking Kemungkinan Kerusakan:</h5>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">No</th>
                                <th>Kerusakan</th>
                                <th width="150">Kepercayaan CF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($semuaHasil as $index => $item)
                            <tr @if($index == 0) style="background-color: #d4edda;" @endif>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['nama_kerusakan'] ?? '-' }}</td>
                                <td class="fw-bold">{{ $item['cf_persen'] ?? 0 }}%</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Tombol Cetak -->
                <div class="text-center mt-4 no-print">
                    <button onclick="window.print()" class="btn btn-primary">Cetak / Simpan PDF</button>
                    <a href="{{ route('konsultasi.hasil', $konsultasi) }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
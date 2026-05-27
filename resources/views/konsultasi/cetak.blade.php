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
                <table class="table table-bordered">
                    <tr><th width="150">Nama</th><td>{{ $konsultasi->nama }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>{{ $konsultasi->jenis_kelamin }}</td></tr>
                    <tr><th>Umur</th><td>{{ $konsultasi->umur }} tahun</td></tr>
                    <tr><th>Tanggal Konsultasi</th><td>{{ $konsultasi->created_at->format('d/m/Y H:i') }}</td></tr>
                </table>
                
                <h5>Gejala yang Dialami:</h5>
                <ul>
                    @foreach($gejalaDipilih as $g)
                    <li>{{ $g->kode_gejala }} - {{ $g->nama_gejala }} (Keyakinan: {{ $g->pivot->cf_user * 100 }}%)</li>
                    @endforeach
                </ul>
                
                <div class="hasil">
                    <h5>Hasil Diagnosa:</h5>
                    <h4>{{ $konsultasi->hasil_diagnosa ?? 'Tidak Terdeteksi' }}</h4>
                    
                    <h5 class="mt-3">Tingkat Keyakinan:</h5>
                    <h4>{{ $konsultasi->cf_akhir ?? 0 }}%</h4>
                </div>
                
                <div class="text-center mt-4 no-print">
                    <button onclick="window.print()" class="btn btn-primary">Cetak / Simpan PDF</button>
                    <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
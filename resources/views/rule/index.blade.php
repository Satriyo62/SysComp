@extends('layouts.master')

@section('title', 'Basis Pengetahuan')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Basis Pengetahuan (Relasi Gejala → Kerusakan)</h1>
</div>

<!-- Tab Navigation -->
<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#relasi" type="button" role="tab">
            📋 Daftar Relasi (MB/MD)
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#aturan" type="button" role="tab">
            🧠 Tabel Aturan IF-THEN
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- ==================== TAB 1: DAFTAR RELASI (MB/MD) ==================== -->
    <div class="tab-pane fade show active" id="relasi" role="tabpanel">
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
                                        <option value="1.0">1.0 - Sangat Yakin</option>
                                        <option value="0.8">0.8 - Yakin</option>
                                        <option value="0.6">0.6 - Cukup Yakin</option>
                                        <option value="0.4">0.4 - Sedikit Yakin</option>
                                        <option value="0.2">0.2 - Kurang Yakin</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">MD (Measure of Disbelief)</label>
                                    <select name="md" class="form-select" required>
                                        <option value="0">0.0 - Tidak Ragu</option>
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
            
            <!-- Tabel Relasi -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5>Daftar Relasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                            <table class="table table-bordered table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Kerusakan</th>
                                        <th>Gejala</th>
                                        <th>MB</th>
                                        <th>MD</th>
                                        <th>CF</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rules as $rule)
                                    <tr>
                                        <td>{{ $rule->kerusakan->kode_kerusakan }} - {{ Str::limit($rule->kerusakan->nama_kerusakan, 30) }}</td>
                                        <td>{{ $rule->gejala->kode_gejala }} - {{ Str::limit($rule->gejala->nama_gejala, 35) }}</td>
                                        <td>{{ $rule->mb }}</td>
                                        <td>{{ $rule->md }}</td>
                                        <td class="fw-bold">{{ number_format($rule->mb - $rule->md, 2) }}</td>
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
        
        <!-- Keterangan Nilai Keyakinan -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h6>Keterangan Nilai Keyakinan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>MB (Measure of Belief) - Tingkat Kepercayaan:</strong>
                        <ul>
                            <li>1.0 = Sangat Yakin</li>
                            <li>0.8 = Yakin</li>
                            <li>0.6 = Cukup Yakin</li>
                            <li>0.4 = Sedikit Yakin</li>
                            <li>0.2 = Kurang Yakin</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <strong>MD (Measure of Disbelief) - Tingkat Keraguan:</strong>
                        <ul>
                            <li>0.0 = Tidak Ragu</li>
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
    </div>

    <!-- ==================== TAB 2: TABEL ATURAN IF-THEN ==================== -->
    <div class="tab-pane fade" id="aturan" role="tabpanel">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📋 Tabel Aturan Forward Chaining (IF-THEN)</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-secondary">
                    <strong>Format Aturan:</strong> JIKA ... DAN ... DAN ... MAKA ...
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">No</th>
                                <th>Aturan (Rule)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rule 1: P001 - Kerusakan VGA Ringan -->
                            <tr>
                                <td class="text-center fw-bold">1</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G01</span> Lag saat menonton video dan bermain game<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G02</span> Warna yang muncul dilayar tidak sesuai<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G03</span> Tampilan layar tidak sesuai resolusi monitor<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P001</span> Kerusakan VGA Ringan
                                </td>
                            </tr>
                            
                            <!-- Rule 2: P002 - Kerusakan VGA Sedang -->
                            <tr>
                                <td class="text-center fw-bold">2</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G04</span> Blue Screen<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G05</span> Layar sering kali mengedip<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G06</span> PC terstart dengan sendirinya<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G07</span> Layar gelap beberapa saat setelah dinyalakan<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P002</span> Kerusakan VGA Sedang
                                </td>
                            </tr>
                            
                            <!-- Rule 3: P003 - Kerusakan VGA Berat -->
                            <tr>
                                <td class="text-center fw-bold">3</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G08</span> PC Mati dengan sendirinya<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G09</span> PC mengalami overheat (Panas berlebih)<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G10</span> Muncul artifak garis pada layar<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P003</span> Kerusakan VGA Berat
                                </td>
                            </tr>
                            
                            <!-- Rule 4: P004 - Kerusakan Harddisk Ringan -->
                            <tr>
                                <td class="text-center fw-bold">4</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G01</span> Lag saat menonton video dan bermain game<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G11</span> PC Melambat<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G12</span> Penyimpanan Penuh<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P004</span> Kerusakan Harddisk Ringan
                                </td>
                            </tr>
                            
                            <!-- Rule 5: P005 - Kerusakan Harddisk Sedang -->
                            <tr>
                                <td class="text-center fw-bold">5</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G04</span> Blue Screen<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G13</span> Data atau File mengalami kerusakan<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G14</span> Komputer tidak mau melakukan proses booting<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P005</span> Kerusakan Harddisk Sedang
                                </td>
                            </tr>
                            
                            <!-- Rule 6: P006 - Kerusakan Harddisk Berat -->
                            <tr>
                                <td class="text-center fw-bold">6</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G08</span> PC Mati dengan sendirinya<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G17</span> Tidak dapat menyimpan, menduplikasi, memindahkan file<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G18</span> Mendengar bunyi aneh dari harddisk<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P006</span> Kerusakan Harddisk Berat
                                </td>
                            </tr>
                            
                            <!-- Rule 7: P007 - Kerusakan Mainboard -->
                            <tr>
                                <td class="text-center fw-bold">7</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G08</span> PC Mati dengan sendirinya<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G15</span> Komputer tidak menyala sama sekali<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G19</span> Mendengar bunyi "beep" pada komputer<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G20</span> Stuck pada BIOS<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P007</span> Kerusakan Mainboard
                                </td>
                            </tr>
                            
                            <!-- Rule 8: P008 - Kerusakan Power Supply -->
                            <tr>
                                <td class="text-center fw-bold">8</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G11</span> PC Melambat<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G15</span> Komputer tidak menyala sama sekali<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G20</span> Stuck pada BIOS<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P008</span> Kerusakan Power Supply
                                </td>
                            </tr>
                            
                            <!-- Rule 9: P009 - Kerusakan RAM -->
                            <tr>
                                <td class="text-center fw-bold">9</td>
                                <td>
                                    <span class="fw-bold text-primary">JIKA</span> <span class="badge bg-primary">G04</span> Blue Screen<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G06</span> PC terstart dengan sendirinya<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G08</span> PC Mati dengan sendirinya<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G11</span> PC Melambat<br>
                                    <span class="fw-bold text-primary">DAN</span> <span class="badge bg-primary">G21</span> RAM tidak Terdeteksi atau Jumlah tidak Sesuai<br>
                                    <span class="fw-bold text-success">MAKA</span> <span class="badge bg-success">P009</span> Kerusakan RAM
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Ringkasan Aturan -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="text-primary">9</h3>
                                <p class="mb-0">Total Aturan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="text-primary">9</h3>
                                <p class="mb-0">Jenis Kerusakan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="text-primary">21</h3>
                                <p class="mb-0">Jenis Gejala</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="text-primary">{{ $rules->count() }}</h3>
                                <p class="mb-0">Total Relasi</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Keterangan Forward Chaining -->
                <div class="alert alert-warning mt-3">
                    <strong>📖 Keterangan Metode Forward Chaining:</strong>
                    <ul class="mb-0 mt-2">
                        <li><strong>Forward Chaining:</strong> Metode pelacakan maju dari fakta/gejala menuju kesimpulan/kerusakan</li>
                        <li><strong>Cara Kerja:</strong> Sistem akan mencocokkan gejala yang dipilih user dengan aturan yang tersedia</li>
                        <li><strong>Jika semua gejala dalam aturan terpenuhi:</strong> Maka kerusakan tersebut menjadi diagnosis</li>
                        <li><strong>Certainty Factor (CF):</strong> Menghitung tingkat keyakinan berdasarkan nilai MB dan MD</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
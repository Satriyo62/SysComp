<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Konsultasi;
use App\Models\Rule;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    // Step 1 - Form biodata
    public function create()
    {
        return view('konsultasi.biodata');
    }
    
    // Step 1 - Simpan biodata
    public function storeBiodata(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer|min:1',
        ]);
        
        $konsultasi = Konsultasi::create($request->only(['nama', 'jenis_kelamin', 'umur']));
        return redirect()->route('konsultasi.gejala', $konsultasi->id);
    }
    
    // Step 2 - Tampilkan daftar gejala
    public function pilihGejala(Konsultasi $konsultasi)
    {
        $gejalas = Gejala::all();
        return view('konsultasi.gejala', compact('konsultasi', 'gejalas'));
    }
    
    // Step 3 & 4 - Proses Forward Chaining & Certainty Factor
    public function prosesKonsultasi(Request $request, Konsultasi $konsultasi)
    {
        $request->validate([
            'gejala' => 'required|array',
            'gejala.*.id' => 'required',
            'gejala.*.cf' => 'required|numeric|min:0|max:1'
        ]);
        
        // Simpan gejala yang dipilih user
        foreach ($request->gejala as $gejala) {
            if (isset($gejala['id']) && isset($gejala['cf'])) {
                $konsultasi->gejalas()->attach($gejala['id'], ['cf_user' => $gejala['cf']]);
            }
        }
        
        // Proses diagnosa dengan Forward Chaining + Certainty Factor
        $hasil = $this->diagnosa($konsultasi);
        
        // Update hasil
        $konsultasi->update([
            'hasil_diagnosa' => $hasil['kerusakan']->nama_kerusakan ?? 'Tidak terdeteksi',
            'cf_akhir' => $hasil['cf_akhir']
        ]);
        
        return redirect()->route('konsultasi.hasil', $konsultasi->id);
    }
    
    // Proses diagnosa: Forward Chaining cari rule cocok, lalu hitung CF
    private function diagnosa($konsultasi)
    {
        $gejalaUser = $konsultasi->gejalas()->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->pivot->cf_user];
        });
        
        if ($gejalaUser->isEmpty()) {
            return ['kerusakan' => null, 'cf_akhir' => 0];
        }
        
        $kemungkinanKerusakan = [];
        
        foreach (Kerusakan::all() as $kerusakan) {
            $rules = Rule::where('kerusakan_id', $kerusakan->id)->get();
            
            if ($rules->isEmpty()) continue;
            
            // Forward Chaining: cek gejala user cocok dengan rule
            $gejalaDibutuhkan = $rules->pluck('gejala_id')->toArray();
            $gejalaTerpenuhi = array_intersect($gejalaUser->keys()->toArray(), $gejalaDibutuhkan);
            
            if (!empty($gejalaTerpenuhi)) {
                // Hitung Certainty Factor
                $cfValues = [];
                foreach ($rules as $rule) {
                    if ($gejalaUser->has($rule->gejala_id)) {
                        $cfRule = $rule->mb - $rule->md;
                        $cfGejalaUser = $gejalaUser[$rule->gejala_id];
                        $cfValues[] = $cfRule * $cfGejalaUser;
                    }
                }
                
                if (!empty($cfValues)) {
                    // Rumus CF Combine: CF1 + CF2 * (1 - CF1)
                    $cfGabungan = $cfValues[0];
                    for ($i = 1; $i < count($cfValues); $i++) {
                        $cfGabungan = $cfGabungan + $cfValues[$i] * (1 - $cfGabungan);
                    }
                    
                    $kemungkinanKerusakan[] = [
                        'kerusakan' => $kerusakan,
                        'cf' => $cfGabungan
                    ];
                }
            }
        }
        
        if (empty($kemungkinanKerusakan)) {
            return ['kerusakan' => null, 'cf_akhir' => 0];
        }
        
        // Ambil yang CF tertinggi
        usort($kemungkinanKerusakan, function ($a, $b) {
            return $b['cf'] <=> $a['cf'];
        });
        
        return [
            'kerusakan' => $kemungkinanKerusakan[0]['kerusakan'],
            'cf_akhir' => round($kemungkinanKerusakan[0]['cf'] * 100, 2)
        ];
    }
    
    // Step 5 - Tampilkan hasil diagnosa
    public function hasil(Konsultasi $konsultasi)
    {
        $gejalaDipilih = $konsultasi->gejalas;
        return view('konsultasi.hasil', compact('konsultasi', 'gejalaDipilih'));
    }
    
    // Cetak hasil diagnosa
    public function cetak(Konsultasi $konsultasi)
    {
        $gejalaDipilih = $konsultasi->gejalas;
        return view('konsultasi.cetak', compact('konsultasi', 'gejalaDipilih'));
    }
    
    // Admin lihat riwayat
    public function index()
    {
        $konsultasis = Konsultasi::latest()->get();
        return view('konsultasi.index', compact('konsultasis'));
    }

    // Method ini untuk menampilkan detail perhitungan CF
    public function detailPerhitungan(Konsultasi $konsultasi)
    {
        $gejalaDipilih = $konsultasi->gejalas;
        
        // Hitung detail perhitungan CF
        $detailPerhitungan = [];
        $cfValues = [];
        
        foreach ($gejalaDipilih as $g) {
            // Cari rule yang cocok
            $rules = Rule::where('gejala_id', $g->id)->get();
            
            foreach ($rules as $rule) {
                $kerusakan = $rule->kerusakan;
                $cfRule = $rule->mb - $rule->md;
                $cfUser = $g->pivot->cf_user;
                $cfHasil = $cfRule * $cfUser;
                
                $detailPerhitungan[] = [
                    'kerusakan' => $kerusakan->nama_kerusakan,
                    'gejala' => $g->nama_gejala,
                    'mb' => $rule->mb,
                    'md' => $rule->md,
                    'cf_rule' => $cfRule,
                    'cf_user' => $cfUser,
                    'cf_hasil' => $cfHasil
                ];
                
                $cfValues[] = $cfHasil;
            }
        }
        
        // Hitung CF gabungan
        $cfGabungan = 0;
        if (!empty($cfValues)) {
            $cfGabungan = $cfValues[0];
            for ($i = 1; $i < count($cfValues); $i++) {
                $cfGabungan = $cfGabungan + $cfValues[$i] * (1 - $cfGabungan);
            }
            $cfGabungan = round($cfGabungan * 100, 2);
        }
        
        return view('konsultasi.detail_perhitungan', compact('konsultasi', 'gejalaDipilih', 'detailPerhitungan', 'cfGabungan'));
    }
}
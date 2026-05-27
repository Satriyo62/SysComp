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
        $hasil = $this->diagnosaLengkap($konsultasi);
        
        // Update hasil
        $konsultasi->update([
            'hasil_diagnosa' => $hasil['tertinggi']['kerusakan']->nama_kerusakan ?? 'Tidak terdeteksi',
            'cf_akhir' => $hasil['tertinggi']['cf_persen'] ?? 0,
            'semua_hasil' => $hasil['semua']
        ]);
        
        return redirect()->route('konsultasi.hasil', $konsultasi->id);
    }
    
    // Proses diagnosa lengkap: hitung SEMUA kemungkinan kerusakan
    private function diagnosaLengkap($konsultasi)
    {
        $gejalaUser = $konsultasi->gejalas()->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->pivot->cf_user];
        });
        
        if ($gejalaUser->isEmpty()) {
            return [
                'tertinggi' => ['kerusakan' => null, 'cf' => 0, 'cf_persen' => 0],
                'semua' => []
            ];
        }
        
        $semuaKemungkinan = [];
        
        foreach (Kerusakan::all() as $kerusakan) {
            $rules = Rule::where('kerusakan_id', $kerusakan->id)->get();
            
            if ($rules->isEmpty()) continue;
            
            // Forward Chaining: cek gejala user cocok dengan rule
            $gejalaDibutuhkan = $rules->pluck('gejala_id')->toArray();
            $gejalaTerpenuhi = array_intersect($gejalaUser->keys()->toArray(), $gejalaDibutuhkan);
            
            $cfValues = [];
            $gejalaTerpakai = [];
            
            foreach ($rules as $rule) {
                if ($gejalaUser->has($rule->gejala_id)) {
                    $cfRule = $rule->mb - $rule->md;
                    $cfGejalaUser = $gejalaUser[$rule->gejala_id];
                    $cfValues[] = $cfRule * $cfGejalaUser;
                    $gejalaTerpakai[] = $rule->gejala->kode_gejala;
                }
            }
            
            if (!empty($cfValues)) {
                // Rumus CF Combine
                $cfGabungan = $cfValues[0];
                for ($i = 1; $i < count($cfValues); $i++) {
                    $cfGabungan = $cfGabungan + $cfValues[$i] * (1 - $cfGabungan);
                }
                
                $semuaKemungkinan[] = [
                    'kerusakan' => $kerusakan,
                    'kode_kerusakan' => $kerusakan->kode_kerusakan,
                    'nama_kerusakan' => $kerusakan->nama_kerusakan,
                    'penyebab' => $kerusakan->penyebab,
                    'solusi' => $kerusakan->solusi,
                    'cf' => $cfGabungan,
                    'cf_persen' => round($cfGabungan * 100, 2),
                    'gejala_terpakai' => $gejalaTerpakai
                ];
            } else {
                // Kerusakan yang tidak ada gejala terpenuhi tetap dimasukkan dengan CF 0
                $semuaKemungkinan[] = [
                    'kerusakan' => $kerusakan,
                    'kode_kerusakan' => $kerusakan->kode_kerusakan,
                    'nama_kerusakan' => $kerusakan->nama_kerusakan,
                    'penyebab' => $kerusakan->penyebab,
                    'solusi' => $kerusakan->solusi,
                    'cf' => 0,
                    'cf_persen' => 0,
                    'gejala_terpakai' => []
                ];
            }
        }
        
        // Urutkan dari CF tertinggi ke terendah
        usort($semuaKemungkinan, function ($a, $b) {
            return $b['cf'] <=> $a['cf'];
        });
        
        // Filter yang CF > 0 untuk ranking tertinggi
        $filtered = array_filter($semuaKemungkinan, function($item) {
            return $item['cf'] > 0;
        });
        
        $tertinggi = !empty($filtered) ? $filtered[0] : $semuaKemungkinan[0];
        
        return [
            'tertinggi' => $tertinggi,
            'semua' => $semuaKemungkinan
        ];
    }
    
    // Step 5 - Tampilkan hasil diagnosa dengan ranking tabel
    public function hasil(Konsultasi $konsultasi)
    {
        $gejalaDipilih = $konsultasi->gejalas;
        $semuaHasil = $konsultasi->semua_hasil ?? [];
        
        // Jika data ranking belum ada, hitung ulang
        if (empty($semuaHasil)) {
            $hasil = $this->diagnosaLengkap($konsultasi);
            $semuaHasil = $hasil['semua'];
            $konsultasi->update([
                'hasil_diagnosa' => $hasil['tertinggi']['nama_kerusakan'] ?? 'Tidak terdeteksi',
                'cf_akhir' => $hasil['tertinggi']['cf_persen'] ?? 0,
                'semua_hasil' => $semuaHasil
            ]);
        }
        
        return view('konsultasi.hasil', compact('konsultasi', 'gejalaDipilih', 'semuaHasil'));
    }
    
    // Cetak hasil diagnosa dengan tabel ranking
    public function cetak(Konsultasi $konsultasi)
    {
        $gejalaDipilih = $konsultasi->gejalas;
        $semuaHasil = $konsultasi->semua_hasil ?? [];
        
        if (empty($semuaHasil)) {
            $hasil = $this->diagnosaLengkap($konsultasi);
            $semuaHasil = $hasil['semua'];
        }
        
        return view('konsultasi.cetak', compact('konsultasi', 'gejalaDipilih', 'semuaHasil'));
    }
    
    // Admin lihat riwayat
    public function index()
    {
        $konsultasis = Konsultasi::latest()->get();
        return view('konsultasi.index', compact('konsultasis'));
    }

    // Method untuk menampilkan detail perhitungan CF
    public function detailPerhitungan(Konsultasi $konsultasi)
    {
        $gejalaDipilih = $konsultasi->gejalas;
        
        $detailPerhitungan = [];
        $cfValues = [];
        
        foreach ($gejalaDipilih as $g) {
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
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $fillable = ['nama', 'jenis_kelamin', 'umur', 'pekerjaan', 'hasil_diagnosa', 'cf_akhir', 'semua_hasil'];
    
    protected $casts = [
        'semua_hasil' => 'array', // untuk menyimpan array ranking kerusakan
    ];
    
    public function gejalas()
    {
        return $this->belongsToMany(Gejala::class, 'konsultasi_gejala')
                    ->withPivot('cf_user')
                    ->withTimestamps();
    }
    
    // Metode untuk menghitung CF gabungan
    public static function hitungCFCombine($cfValues)
    {
        if (empty($cfValues)) return 0;
        
        $result = $cfValues[0];
        for ($i = 1; $i < count($cfValues); $i++) {
            $result = $result + $cfValues[$i] * (1 - $result);
        }
        
        return $result;
    }
}
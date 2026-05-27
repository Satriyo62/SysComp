<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gejala extends Model
{
    protected $fillable = ['kode_gejala', 'nama_gejala'];
    
    public function kerusakans(): BelongsToMany
    {
        return $this->belongsToMany(Kerusakan::class, 'rules')
                    ->withPivot('mb', 'md')
                    ->withTimestamps();
    }
    
    public function konsultasis()
    {
        return $this->belongsToMany(Konsultasi::class, 'konsultasi_gejala')
                    ->withPivot('cf_user')
                    ->withTimestamps();
    }
}
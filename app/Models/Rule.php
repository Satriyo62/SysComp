<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['kerusakan_id', 'gejala_id', 'mb', 'md'];
    
    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class);
    }
    
    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
    
    // Hitung CF dari rule
    public function getCfAttribute()
    {
        return $this->mb - $this->md;
    }
}
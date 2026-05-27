<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kerusakan extends Model
{
    protected $fillable = ['kode_kerusakan', 'nama_kerusakan', 'penyebab', 'solusi'];
    
    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }
    
    public function gejalas(): BelongsToMany
    {
        return $this->belongsToMany(Gejala::class, 'rules')
                    ->withPivot('mb', 'md')
                    ->withTimestamps();
    }
}
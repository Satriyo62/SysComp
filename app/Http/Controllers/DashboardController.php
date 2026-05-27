<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Konsultasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKerusakan = Kerusakan::count();
        $totalGejala = Gejala::count();
        $totalRule = Rule::count();
        $totalKonsultasi = Konsultasi::count();
        
        return view('dashboard', compact('totalKerusakan', 'totalGejala', 'totalRule', 'totalKonsultasi'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }
    
    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required'
        ]);
        
        // Simpan ke session atau database (sesuai PDF)
        // Untuk sekarang, simpan ke session sebagai notifikasi
        session()->flash('success', 'Pesan Anda telah terkirim ke pengembang!');
        
        return redirect()->route('kontak');
    }
}
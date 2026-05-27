<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('ubah_password');
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6',
            'konfirmasi_password' => 'required|same:password_baru'
        ]);
        
        // Cek password lama
        if ($request->password_lama !== 'admin123') {
            return back()->with('error', 'Password lama salah!');
        }
        
        // Simpan password baru (di session untuk demo)
        // Dalam implementasi nyata, simpan di database
        session(['admin_password' => $request->password_baru]);
        
        return back()->with('success', 'Password berhasil diubah!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        // Sesuai jurnal: admin input basis pengetahuan
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['is_admin' => true]);
            return redirect()->route('dashboard');
        }
        
        return back()->with('error', 'Username atau password salah!');
    }
    
    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('login');
    }
}
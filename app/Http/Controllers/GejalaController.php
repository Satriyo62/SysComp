<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::orderBy('kode_gejala')->get();
        return view('gejala.index', compact('gejalas'));
    }
    
    public function create()
    {
        return view('gejala.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejalas',
            'nama_gejala' => 'required'
        ]);
        
        Gejala::create($request->all());
        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil ditambahkan');
    }
    
    public function edit(Gejala $gejala)
    {
        return view('gejala.edit', compact('gejala'));
    }
    
    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejalas,kode_gejala,' . $gejala->id,
            'nama_gejala' => 'required'
        ]);
        
        $gejala->update($request->all());
        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil diupdate');
    }
    
    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil dihapus');
    }
}
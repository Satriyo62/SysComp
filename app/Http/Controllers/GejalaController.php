<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function index()
    {
        $kerusakans = Kerusakan::orderBy('kode_kerusakan')->get();
        return view('kerusakan.index', compact('kerusakans'));
    }
    
    public function create()
    {
        return view('kerusakan.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kode_kerusakan' => 'required|unique:kerusakans',
            'nama_kerusakan' => 'required',
            'penyebab' => 'required',
            'solusi' => 'required'
        ]);
        
        Kerusakan::create($request->all());
        return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil ditambahkan');
    }
    
    public function edit(Kerusakan $kerusakan)
    {
        return view('kerusakan.edit', compact('kerusakan'));
    }
    
    public function update(Request $request, Kerusakan $kerusakan)
    {
        $request->validate([
            'kode_kerusakan' => 'required|unique:kerusakans,kode_kerusakan,' . $kerusakan->id,
            'nama_kerusakan' => 'required',
            'penyebab' => 'required',
            'solusi' => 'required'
        ]);
        
        $kerusakan->update($request->all());
        return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil diupdate');
    }
    
    public function destroy(Kerusakan $kerusakan)
    {
        $kerusakan->delete();
        return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil dihapus');
    }
}
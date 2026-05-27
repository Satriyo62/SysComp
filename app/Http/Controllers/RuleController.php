<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Gejala;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        $rules = Rule::with(['kerusakan', 'gejala'])->get();
        $kerusakans = Kerusakan::all();
        $gejalas = Gejala::all();
        return view('rule.index', compact('rules', 'kerusakans', 'gejalas'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kerusakan_id' => 'required',
            'gejala_id' => 'required',
            'mb' => 'required|numeric|min:0|max:1',
            'md' => 'required|numeric|min:0|max:1'
        ]);
        
        Rule::updateOrCreate(
            [
                'kerusakan_id' => $request->kerusakan_id,
                'gejala_id' => $request->gejala_id
            ],
            [
                'mb' => $request->mb,
                'md' => $request->md
            ]
        );
        
        return redirect()->route('rule.index')->with('success', 'Rule berhasil disimpan');
    }
    
    public function destroy($kerusakanId, $gejalaId)
    {
        $rule = Rule::where('kerusakan_id', $kerusakanId)
                    ->where('gejala_id', $gejalaId)
                    ->first();
        
        if ($rule) {
            $rule->delete();
        }
        
        return redirect()->route('rule.index')->with('success', 'Rule berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoperasiMember;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    public function index()
    {
        $members = KoperasiMember::get();
        // dd($members);
        return view('tabungan.index', compact('members'));
    }

    public function store(Request $request)
    {
        $user = Auth::user()->name;
        
        $request->validate([
            'member_id' => 'required|exists:koperasi_members,id',
            'saldo' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'status' => 'required|in:active,inactive'
        ]);
    
        // Create a new Tabungan record
        Tabungan::create([
            'member_id' => $request->member_id,
            'saldo' => $request->saldo,
            'start_date' => $request->start_date,
            'status' => $request->status,
            'created_by' => $user,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('tabungan.create')->with('success', 'Tabungan created successfully.');
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoperasiMember;
use App\Models\Tabungan;
use App\Models\TabunganTransaction;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    public function index()
    {
        $members = KoperasiMember::where('is_penabung',1)->get();
        $tabungans = Tabungan::with('membertabungan')->get();
        // dd($members);
        return view('tabungan.index', compact('members', 'tabungans'));
    }

    public function store(Request $request)
    {
        $user = Auth::user()->name;
        
        $request->validate([
            'member_id' => 'required|exists:koperasi_members,id',
            'saldo' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'status' => 'required'
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
        return redirect()->route('tabungan.index')->with('success', 'Tabungan created successfully.');
        
    }



    public function setortabungan()
    {
        $tabungans = Tabungan::with('membertabungan')->get();

        $statuses = $tabungans->pluck('status')->unique();
        
        return view('tabungan.setor', compact('tabungans','statuses'));
    }


    public function setorinsert(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'tabungan_id' => 'required',    
            'setor' => 'required|numeric|min:0',
            'setor_date' => 'required|date',
            'remark' => 'nullable|string|max:255',
        ]);

        // Insert data into TabunganTransaction
        $transaction = TabunganTransaction::create([
            'tabungan_id' => $validatedData['tabungan_id'],
            'setor' => $validatedData['setor'],
            'setor_date' => $validatedData['setor_date'],
            'remark' => $validatedData['remark'],
        ]);

        $tabungan = Tabungan::where('id', $validatedData['tabungan_id'])->firstOrFail();

        $tabungan->saldo += $validatedData['setor'];
        $tabungan->save();

        return redirect()->route('tabungan.index')->with('success', 'Setoran berhasil ditambahkan dan saldo diperbarui.');
    }

    public function listtransaction()
    {
        $datas = TabunganTransaction::with('Tabunganlist', 'Tabunganlist.membertabungan')->get();
        // dd($datas);    
        return view('tabungan.listtransaction', compact('datas'));
    }
}

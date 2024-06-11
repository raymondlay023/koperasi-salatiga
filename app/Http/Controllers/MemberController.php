<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoperasiMember;

class MemberController extends Controller
{
    public function index()
    {   
        return view('member.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'alamat_anggota' => 'required|string|max:255',
            'handphone' => 'required|string|max:20',
            'tipe_member' => 'required|string',
        ]);

        KoperasiMember::create([
            'nama_anggota' => $request->nama_anggota,
            'alamat_anggota' => $request->alamat_anggota,
            'handphone' => $request->handphone,
            'tipe_member' => $request->tipe_member,
            'is_penabung' => $request->has('is_penabung'),
            'is_peminjam' => $request->has('is_peminjam'),
        ]);

        return redirect()->route('member.index')->with('success', 'Member added successfully.');
    }

    public function listmember()
    {
        $members = KoperasiMember::get();

        return view('member.listmember', compact('members'));
    }
}

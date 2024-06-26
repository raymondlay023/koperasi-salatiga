<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoperasiMember;
use App\Models\Pinjaman;
use App\Models\PinjamanTransaction;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    public function index()
    {
        //member ini nanti harus ditambah logic untuk dicek di pinjaman dan dihilangkan dari $members
        $members = KoperasiMember::where('is_peminjam',1)->get();
        $pinjamans = Pinjaman::with('memberpinjaman')->get();
        return view('pinjaman.index', compact('members','pinjamans'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'member_id' => 'required|exists:koperasi_members,id',
            'jumlah_pinjaman' => 'required|string',
            'start_date' => 'required|date',
            'tenor' => 'required|integer|in:10,12',
            'total_bayar' => 'required|string',
            'bayar_perbulan' => 'required|string',
        ]);

        function parseRupiah($value) {
            // Remove "Rp", non-breaking space (UTF-8 encoded), and thousands separator, then parse as float
            $cleanedValue = str_replace(['Rp', "\xc2\xa0", '.', ' '], '', $value);

            return intval($cleanedValue);
        }

          // Remove currency formatting
        $jumlahPinjaman = parseRupiah($validated['jumlah_pinjaman']);
        $totalBayar = parseRupiah($validated['total_bayar']);
        $bayarPerbulan = parseRupiah($validated['bayar_perbulan']);

        Pinjaman::create([
            'member_id' => $validated['member_id'],
            'jumlah_pinjaman' => $jumlahPinjaman,
            'start_date' => $validated['start_date'],
            'tenor' => $validated['tenor'],
            'total_bayar' => $totalBayar,
            'bayar_perbulan' => $bayarPerbulan,
            'created_by' => Auth::user()->name, // assuming you want to store the name of the user who created the record
        ]);


        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman created successfully.');
    }

    public function bayarpinjaman()
    {
        $pinjamans = Pinjaman::with('memberpinjaman')->get();

        return view('pinjaman.bayar', compact('pinjamans'));
    }

    public function prosesbayar(Request $request)
    {
        dd($request->all());
    }
}

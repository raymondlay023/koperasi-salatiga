<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Pembelian;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function penjualanindex()
    {
        $datas = Inventory::all();
        $penjualan = Penjualan::with('inventory')->get();
        $types = Inventory::select('tipe_barang')->distinct()->get();
        $infos = Penjualan::get();
        return view('inventory.penjualanindex', compact('datas','infos','types','penjualan'));
    }

    public function inputpenjualan(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'item_id' => 'required|exists:inventories,id',
            'jumlah_jual' => 'required|integer|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'customer' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tanggal_jual' => 'required|date',
        ]);

        Penjualan::create($request->all());

        $inventory = Inventory::find($request->item_id);
        $inventory->stock -= $request->jumlah_jual;
        $inventory->save();

        return redirect()->route('inventory.penjualan.index')->with('success', 'Pembelian created successfully.');
    }
}

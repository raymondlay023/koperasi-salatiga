<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\ItemType;
use App\Models\Pembelian;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function penjualanindex()
    {
        $datas = Inventory::all();
        $penjualan = Penjualan::with('inventory')->get();
        // $types = Inventory::select('tipe_barang')->distinct()->get();
        $types = ItemType::all();
        $infos = Penjualan::get();
        return view('penjualan.index', compact('datas','infos','types','penjualan'));
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

        return redirect()->route('penjualan.index')->with('success', 'Penjualan created successfully!');
    }

    public function destroy($id)
    {
        Penjualan::find($id)->delete();
        return redirect()->back()->with('success', 'Penjualan deleted successfully!');
    }
}

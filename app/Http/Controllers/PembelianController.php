<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\ItemType;
use App\Models\Pembelian;
use App\Models\Penjualan;


class PembelianController extends Controller
{
    public function pembelianindex()
    {
        $datas = Inventory::get();
        $pembelian = Pembelian::with('inventory')->get();
        // $types = Inventory::select('item_type_id')->distinct()->get();
        $types = ItemType::all();
        $infos = Pembelian::get();
        return view('pembelian.index', compact('pembelian','infos','types','datas'));
    }

    public function inputpembelian(Request $request)
    {

        $request->validate([
            'item_id' => 'required|exists:inventories,id',
            'jumlah_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'supplier' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tanggal_beli' => 'required|date',
        ]);

        Pembelian::create($request->all());

        // Update inventory stock
        $inventory = Inventory::find($request->item_id);
        $inventory->stock += $request->jumlah_barang;
        $inventory->save();

        return redirect()->back()->with('success', 'Pembelian created successfully!');
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::find($id);

        // Revert inventory stock
        $inventory = $pembelian->inventory;
        $inventory->stock -= $pembelian->jumlah_barang;
        $inventory->save();

        $pembelian->delete();

        return redirect()->back()->with('success', 'Pembelian deleted successfully!');
    }

}

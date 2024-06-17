<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\ItemType;
use App\Models\Pembelian;
use App\Models\Penjualan;


class InventoryController extends Controller
{
    public function index()
    {
        $datas = Inventory::get();
        $types = ItemType::all();
        return view('inventory.index', compact('datas', 'types'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'item_name' => 'required|string',
            'item_type_id' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // Create a new inventory record
        Inventory::create($validatedData);

        // Redirect back to the index page or any other desired page
        return redirect()->back()->with('success', 'Inventory added successfully!');
    }

  
    // function ini return total transaksi peritem
    public function transaction($id)
    {
            $pembelian = Pembelian::where('item_id', $id)->get()->map(function ($item) {
                return [
                    'type' => 'Purchase',
                    'date' => $item->created_at->format('Y-m-d'),
                    'amount' => '+ ' . $item->jumlah_barang,
                    'status' => $item->status
                ];
            });


            $penjualan = Penjualan::where('item_id', $id)->get()->map(function ($item) {
                return [
                    'type' => 'Sale',
                    'date' => $item->created_at->format('Y-m-d'),
                    'amount' => '- ' . $item->jumlah_jual ,
                    'status' => $item->status
                ];
            });

            // Merge both collections
            $transactions = $pembelian->merge($penjualan);

            // Sort transactions by date (optional)
            $transactions = $transactions->sortBy('date');

            // Return as JSON response
            return response()->json($transactions);
    }
    // function ini return total transaksi peritem
  

}

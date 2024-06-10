<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Pembelian;
use App\Models\Penjualan;


class InventoryController extends Controller
{
    public function index()
    {
        $datas = Inventory::get();
        return view('inventory.index', compact('datas'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'item_name' => 'required|string',
            'tipe_barang' => 'required|string',
            'stock' => 'required|integer',
        ]);

        // Create a new inventory record
        Inventory::create($validatedData);

        // Redirect back to the index page or any other desired page
        return redirect()->back()->with('success', 'Inventory added successfully!');
    }

  


  
}

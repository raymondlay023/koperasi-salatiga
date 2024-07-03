<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\ItemType;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pinjaman;
use App\Models\PinjamanTransaction;
use App\Models\Tabungan;
use App\Models\TabunganTransaction;


class DashboardController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::get();
        $penjualans = Penjualan::get();
        $userpinjamans = Pinjaman::get();
        $usertabungans = Tabungan::get();

        $pembeliansCount = $pembelians->count();
        $penjualansCount = $penjualans->count();
        $userpinjamansCount = $userpinjamans->count();
        $usertabungansCount = $usertabungans->count();

        $chart1 = Inventory::with('type')->get();

        $chartData = $chart1->groupBy('type.name')->map(function ($items, $typeName) {
            return [
                'type_name' => $typeName,
                'items' => $items->map(function ($item) {
                    return [
                        'item_name' => $item->item_name,
                        'stock' => $item->stock,
                    ];
                })->values()->toArray()
            ];
        })->values()->toArray();
    
        $pinjamantransaction = PinjamanTransaction::get();
        $tabungantransaction = TabunganTransaction::get();

        $totalpinjamantransaction = $pinjamantransaction->count();
        $totaltabungantransaction = $tabungantransaction->count();

        $transactionCounts = [
            'total_pinjaman_transaction' => $totalpinjamantransaction,
            'total_tabungan_transaction' => $totaltabungantransaction,
        ];
    
        // Display or return the array for debugging

        // dd($transactionCounts);
       
        return view('dashboard', compact('pembeliansCount', 'penjualansCount', 'userpinjamansCount', 'usertabungansCount', 'chartData', 'transactionCounts'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\ItemType;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Rules\UniqueIgnoringCaseAndSubstring;


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
            'item_name' => ['required', 'string', 'max:255', new UniqueIgnoringCaseAndSubstring],
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

    public function update(Request $request, $id)
    {
        Inventory::find($id)->update($request->all());
        return redirect()->back()->with('success', 'Inventory successfully updated!');
    }

    public function destroy($id)
    {
        Inventory::find($id)->delete();
        return redirect()->back()->with('success', 'Inventory successfully deleted!');
    }

    public function laporan()
    {
        $types = ItemType::all();
        return view('inventory.laporan', compact('types'));
    }

    public function laporanResult(Request $request)
    {

        $request->validate([
            'category' => 'required|in:1,2,3',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $itemtypeid = $request->category;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        switch ($itemtypeid) {
            case 1:
                return redirect()->route('laporan.sembako')
                                 ->with(['itemtypeid' => $itemtypeid,'start_date' => $startDate, 'end_date' => $endDate]);
            case 2:
                return redirect()->route('laporan.kedelai')
                                 ->with(['itemtypeid' => $itemtypeid,'start_date' => $startDate, 'end_date' => $endDate]);
            case 3:
                return redirect()->route('laporan.tahu_tempe')
                                 ->with(['itemtypeid' => $itemtypeid,'start_date' => $startDate, 'end_date' => $endDate]);
            default:
                return redirect()->back()->withErrors(['category' => 'Invalid category selected.']);
        }
    }

    public function laporansembako(Request $request)
    {
        $itemtypeid = $request->session()->get('itemtypeid');
        $startDate = $request->session()->get('start_date');
        $endDate = $request->session()->get('end_date');
        $data = Inventory::where('item_type_id', $itemtypeid)
            ->with(['pembelian' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_beli', [$startDate, $endDate]);
            }, 'penjualan' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_jual', [$startDate, $endDate]);
            }])
            ->get();

    // dd($data);

    $result = [];

    foreach ($data as $inventory) {
        $item = [
            'category' => $inventory->item_name,
            'pembelian' => [
                'totalquantity' => $inventory->pembelian->sum('jumlah_barang'),
                'totalprice' => $inventory->pembelian->sum(function ($pembelian) {
                    return $pembelian->harga_beli * $pembelian->jumlah_barang;
                })
            ],
            'penjualan' => [
                'totalquantity' => $inventory->penjualan->sum('jumlah_jual'),
                'totalprice' => $inventory->penjualan->sum(function ($penjualan) {
                    return $penjualan->harga_jual * $penjualan->jumlah_jual;
                })
            ]
        ];
        $result[] = $item;
    }

    return view('inventory.laporansembako', compact('result', 'startDate', 'endDate'));

    }

    public function laporankedelai(Request $request)
    {
        $itemtypeid = $request->session()->get('itemtypeid');
        $startDate = $request->session()->get('start_date');
        $endDate = $request->session()->get('end_date');

        $data = Inventory::where('item_type_id', $itemtypeid)
        ->with(['pembelian' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal_beli', [$startDate, $endDate]);
        }, 'penjualan' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal_jual', [$startDate, $endDate]);
        }])
        ->get();

        $result = [];

        foreach ($data as $inventory) {
            $item = [
                'category' => $inventory->item_name,
                'pembelian' => [
                    'totalquantity' => $inventory->pembelian->sum('jumlah_barang'),
                    'totalprice' => $inventory->pembelian->sum(function ($pembelian) {
                        return $pembelian->harga_beli * $pembelian->jumlah_barang;
                    })
                ],
                'penjualan' => [
                    'totalquantity' => $inventory->penjualan->sum('jumlah_jual'),
                    'totalprice' => $inventory->penjualan->sum(function ($penjualan) {
                        return $penjualan->harga_jual * $penjualan->jumlah_jual;
                    })
                ]
            ];
            $result[] = $item;
        }

        return view('inventory.laporankedelai', compact('result', 'startDate', 'endDate'));

    }

    public function laporantahutempe(Request $request)
    {
        $itemtypeid = $request->session()->get('itemtypeid');
        $startDate = $request->session()->get('start_date');
        $endDate = $request->session()->get('end_date');

        $data = Inventory::where('item_type_id', $itemtypeid)
        ->with(['pembelian' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal_beli', [$startDate, $endDate]);
        }, 'penjualan' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal_jual', [$startDate, $endDate]);
        }])
        ->get();

        $result = [];

        foreach ($data as $inventory) {
            $item = [
                'category' => $inventory->item_name,
                'pembelian' => [
                    'totalquantity' => $inventory->pembelian->sum('jumlah_barang'),
                    'totalprice' => $inventory->pembelian->sum(function ($pembelian) {
                        return $pembelian->harga_beli * $pembelian->jumlah_barang;
                    })
                ],
                'penjualan' => [
                    'totalquantity' => $inventory->penjualan->sum('jumlah_jual'),
                    'totalprice' => $inventory->penjualan->sum(function ($penjualan) {
                        return $penjualan->harga_jual * $penjualan->jumlah_jual;
                    })
                ]
            ];
            $result[] = $item;
        }

        return view('inventory.laporantahutempe', compact('result', 'startDate', 'endDate'));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoperasiMember;
use App\Models\Pinjaman;
use App\Models\PinjamanTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

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

    public function prosesbayar(Request $request)
    {
        $request->validate([
            'pinjaman_id' => 'required|exists:pinjamans,id',
            'bayar' => 'required|string',
            'remark' => 'nullable|string',
        ]);

        // Remove "Rp" prefix and formatting from 'bayar' value
        $bayar = str_replace(['Rp', '.', ' '], '', $request->input('bayar'));

        PinjamanTransaction::create([
            'pinjaman_id' => $request->input('pinjaman_id'),
            'bayar' => $bayar,
            'remark' => $request->input('remark'),
        ]);

        $pinjaman = Pinjaman::find($request->input('pinjaman_id'));
        $pinjaman->tenor_counter += 1;

        if($pinjaman->tenor_counter === $pinjaman->tenor)
        {
            $pinjaman->is_lunas = true;
        }

        $pinjaman->save();

        return redirect()->back()->with('success', 'Payment processed successfully.');
    }

    public function transactionlist()
    {
        $pinjamans = Pinjaman::with('memberpinjaman')->get();
        $datas = PinjamanTransaction::with('Pinjamanlist', 'Pinjamanlist.memberpinjaman')->get();
        // dd($datas);
        return view('pinjaman.listtransaction', compact('datas', 'pinjamans'));

    }

    public function destroy($id)
    {
        try {
            $pinjaman = Pinjaman::findOrFail($id);

            try {
                $pinjamanTransactions = PinjamanTransaction::where('pinjaman_id', $pinjaman->id);
                $pinjamanTransactions->delete();
            } catch (\Exception $e) {
                Log::error('Error deleting Pinjaman transactions: ' . $e->getMessage());
                abort(500, 'An error occurred while deleting the Pinjaman transactions');
            }

            $pinjaman->delete();
            return redirect()->back()->with('success', 'Pinjaman deleted sucessfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Pinjaman not found!');
        } catch (\Exception $e) {
            Log::error('Error deleting record: '.$e->getMessage());
            abort(500, 'An error occurred while deleting the record');
        }
    }

    public function destroyPinjamanTransaction($id)
    {
        try {
            $pinjamanTransaction = PinjamanTransaction::findOrFail($id);
            $pinjamanTransaction->delete();

            return redirect()->back()->with('success', '');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Pinjaman Transaction not found!');
        } catch (\Exception $e) {
            Log::error('Error deleting record: '.$e->getMessage());
            abort(500, 'An error occurred while deleting the record');
        }
    }

    public function indexlaporan()
    {
        return view('pinjaman.laporanindex');
    }

    public function laporanpinjaman(Request $request)
    {
        // dd($request->all());
        $startdate = $request->start_date;
        $enddate = $request->end_date;

        $transactions = PinjamanTransaction::whereBetween(DB::raw('DATE(created_at)'), [$startdate, $enddate])->get();

        // Mengambil pinjaman yang memiliki start_date antara startdate dan enddate
        $pinjaman = Pinjaman::whereBetween('start_date', [$startdate, $enddate])->get();


         // Menginisialisasi array untuk menyimpan hasil
         $combinedSummary = [];

         // Mengelompokkan transaksi berdasarkan tanggal dan menghitung total bayar
         foreach ($transactions as $transaction) {
             $date = $transaction->created_at->format('Y-m-d');
             if (!isset($combinedSummary[$date])) {
                 $combinedSummary[$date] = ['bayar' => 0, 'jumlah_pinjaman' => 0];
             }
             $combinedSummary[$date]['bayar'] += $transaction->bayar;
         }
 
         // Mengelompokkan pinjaman berdasarkan tanggal dan menghitung total jumlah_pinjaman
         foreach ($pinjaman as $item) {
             $date = $item->start_date;
             if (!isset($combinedSummary[$date])) {
                 $combinedSummary[$date] = ['bayar' => 0, 'jumlah_pinjaman' => 0];
             }
             $combinedSummary[$date]['jumlah_pinjaman'] += $item->jumlah_pinjaman;
         }
 
         // Menampilkan hasil untuk debug
        
        return view('pinjaman.laporanpinjaman', compact('combinedSummary', 'startdate', 'enddate'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoperasiMember;
use App\Models\Tabungan;
use App\Models\TabunganTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TabunganController extends Controller
{
    public function index()
    {
        $members = KoperasiMember::where('is_penabung',1)->get();
        $tabungans = Tabungan::with('membertabungan')->get();
        // dd($members);
        return view('tabungan.index', compact('members', 'tabungans'));
    }

    public function store(Request $request)
    {
        $user = Auth::user()->name;

        $request->validate([
            'member_id' => 'required|exists:koperasi_members,id',
            'saldo' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'status' => 'required'
        ]);

        $existingStatusTabungan = Tabungan::where('member_id', $request->member_id)
        ->where('status', $request->status)
        ->exists();

        if ($existingStatusTabungan) {
            return redirect()->back()->withErrors(['status' => 'Tabungan with the same status already exists for this member.'])->withInput();
        }

        // Create a new Tabungan record
        Tabungan::create([
            'member_id' => $request->member_id,
            'saldo' => $request->saldo,
            'start_date' => $request->start_date,
            'status' => $request->status,
            'created_by' => $user,
        ]);

        // Redirect back with a success message
        return redirect()->route('tabungan.index')->with('success', 'Tabungan created successfully.');

    }



    public function setortabungan()
    {
        $tabungans = Tabungan::with('membertabungan')->get();

        $statuses = $tabungans->pluck('status')->unique();

        return view('tabungan.setor', compact('tabungans','statuses'));
    }


    public function setorinsert(Request $request)
    {
          // Validate the incoming request
    $validatedData = $request->validate([
        'tabungan_id' => 'required',
        'setor' => 'nullable|numeric|min:0|exclude_if:tarikan,0',
        'tarikan' => 'nullable|numeric|min:0|exclude_if:setor,0',
        'setor_date' => 'required|date',
        'remark' => 'nullable|string|max:255',
    ]);

    // Determine whether the request is for "setor" or "tarikan"
    $isSetor = isset($validatedData['setor']) && $validatedData['setor'] > 0;
    $isTarikan = isset($validatedData['tarikan']) && $validatedData['tarikan'] > 0;

    // Ensure either "setor" or "tarikan" is provided
    if (!$isSetor && !$isTarikan) {
        return back()->withErrors(['message' => 'Either Setor or Tarikan must be provided.']);
    }

    // Insert data into TabunganTransaction
    $transaction = TabunganTransaction::create([
        'tabungan_id' => $validatedData['tabungan_id'],
        'setor' => $isSetor ? $validatedData['setor'] : null,
        'tarikan' => $isTarikan ? $validatedData['tarikan'] : null,
        'setor_date' => $validatedData['setor_date'],
        'remark' => $validatedData['remark'],
    ]);

    // Retrieve the related Tabungan record
    $tabungan = Tabungan::where('id', $validatedData['tabungan_id'])->firstOrFail();

    // Update the saldo based on the transaction type
    if ($isSetor) {
        $tabungan->saldo += $validatedData['setor'];
    } else if ($isTarikan) {
        $tabungan->saldo -= $validatedData['tarikan'];
    }
    $tabungan->save();

    return redirect()->route('list.transaksi.tabungan')->with('success', 'Transaksi berhasil ditambahkan dan saldo diperbarui.');
    }

    public function listtransaction()
    {
        $datas = TabunganTransaction::with('Tabunganlist', 'Tabunganlist.membertabungan')->get();
        $tabungans = Tabungan::with('membertabungan')->get();
        $statuses = $tabungans->pluck('status')->unique();
        // dd($datas);
        return view('tabungan.listtransaction', compact('datas', 'tabungans', 'statuses'));
    }

    public function indexlaporan()
    {
        return view('tabungan.laporanindex');
    }

    public function laporantabungan(Request $request)
    {

        $startdate = $request->start_date;
        $enddate = $request->end_date;
        $datas = TabunganTransaction::whereBetween('setor_date', [$startdate, $enddate])->get();
        // dd($datas);

        $result = [];

        foreach ($datas as $data) {
            $date = $data->setor_date;

            // Initialize the array structure if not already done
            if (!isset($result[$date])) {
                $result[$date] = [
                    'setor' => 0,
                    'tarikan' => 0,
                ];
            }

            // Add the setor and tarikan amounts to the respective date
            $result[$date]['setor'] += $data->setor ?? 0;
            $result[$date]['tarikan'] += $data->tarikan ?? 0;
        }

        return view('tabungan.laporantabungan', compact('result', 'startdate', 'enddate'));

    }

    public function destroy($id)
    {
        try {
            $tabungan = Tabungan::findOrFail($id);

            try {
                $tabunganTransactions = TabunganTransaction::where('tabungan_id', $tabungan->id);
                $tabunganTransactions->delete();
            } catch (\Exception $e) {
                Log::error('Error deleting Tabungan transactions: ' + $e->getMessage());
                abort(500, 'An error occurred while deleting the Tabungan transactions');
            }

            $tabungan->delete();
            return redirect()->back()->with('success', 'Tabungan deleted successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Tabungan not found!');
        } catch (\Exception $e) {
            Log::error('Error deleting record: '.$e->getMessage());
            abort(500, 'An error occurred while deleting the record');
        }
    }

    public function destroyTabunganTransaction($id)
    {
        try {
            $pinjamanTransaction = TabunganTransaction::findOrFail($id);

            try {
                // Revert tabungan saldo
                $tabungan = $pinjamanTransaction->tabunganlist;

                if (!$tabungan) {
                    throw new \Exception('Tabungan related to this transaction not found.');
                }

                if ($pinjamanTransaction->setor) {
                    $amount = $pinjamanTransaction->setor;
                    $tabungan->saldo -= $amount;
                } elseif ($pinjamanTransaction->tarikan) {
                    $amount = $pinjamanTransaction->tarikan;
                    $tabungan->saldo += $amount;
                } else {
                    throw new \Exception('Both setor and tarikan are null, unable to revert saldo.');
                }

                $tabungan->save();
            } catch (\Exception $e) {
                Log::error('Error reverting tabungan saldo: ' . $e->getMessage());
                abort(500, 'An error occurred while reverting the tabungan saldo.');
            }

            $pinjamanTransaction->delete();

            return redirect()->back()->with('success', 'Tabungan transaction deleted successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Tabungan Transaction not found!');
        } catch (\Exception $e) {
            Log::error('Error deleting record: '.$e->getMessage());
            abort(500, 'An error occurred while deleting the record');
        }
    }
}

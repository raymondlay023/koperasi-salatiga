<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;
use App\Models\KoperasiMember;
use App\Models\MemberType;

class KoperasiMemberController extends Controller
{
    public function index()
    {
        $members = KoperasiMember::get();
        $types = MemberType::all();
        return view('member.index', compact('members', 'types'));
    }

    public function create()
    {
        $types = MemberType::all();
        return view('member.create', compact('types'));
    }

    public function store(StoreMemberRequest $request)
    {
        // The validated data is available via $request->validated()
        $validated = $request->validated();

        // Process the validated data
        try {
            KoperasiMember::create([
                'nama_anggota' => $validated['nama_anggota'],
                'alamat_anggota' => $validated['alamat_anggota'],
                'handphone' => $validated['handphone'],
                'type_id' => $validated['type_id'],
                'is_penabung' => in_array('on', $validated['keanggotaan']) ? 1 : 0,
                'is_peminjam' => in_array('on', $validated['keanggotaan']) ? 1 : 0,
            ]);

            return redirect()->route('member.index')->with('success', 'Member added successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions or errors if needed
            return back()->withErrors([$e->getMessage()])->withInput();
        }
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        $validated = $request->validated();
        // dd($validated);

        try {
            $member = KoperasiMember::findOrFail($id);

            $member->nama_anggota = $validated['nama_anggota'];
            $member->alamat_anggota = $validated['alamat_anggota'];
            $member->handphone = $validated['handphone'];
            $member->type_id = $validated['type_id'];
            $member->is_penabung = isset($validated['keanggotaan']['is_penabung']) ? 1 : 0;
            $member->is_peminjam = isset($validated['keanggotaan']['is_peminjam']) ? 1 : 0;

            $member->save();

            return redirect()->route('member.index')->with('success', 'Member updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $member = KoperasiMember::findOrFail($id);
            $member->delete();

            return redirect()->route('member.index')->with('success', 'Member deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use App\Models\Tpsuara;
use Illuminate\Http\Request;

class TpsuaraController extends Controller
{
    public function index()
    {
        $tpsuaras = Tpsuara::with('kelurahans')->latest()->when(request()->q, function ($query) {
            $query->whereHas('kelurahans', function ($subQuery) {
                $subQuery->where('nama_kel', 'like', '%' . request()->q . '%');
            });
        })->paginate(10);

        return view("admin.tpsuara.index", compact("tpsuaras"));
    }

    public function create()
    {
        $kelurahans = Kelurahan::all();
        return view('admin.tpsuara.create', compact('kelurahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kel' => 'required|exists:kelurahans,id_kel'
        ]);

        $tpsuara = Tpsuara::create([
            'id_kel' => $request->id_kel
        ]);

        if ($tpsuara) {
            return redirect()->route('admin.tpsuara.index')->with(['success' => 'Data berhasil ditambahkan ke dalam tabel kategori']);
        } else {
            return redirect()->route('admin.tpsuara.index')->with(['error' => 'Data Gagal ditambahkan ke dalam tabel kategori']);
        }
    }

    public function edit(Tpsuara $tpsuara)
    {
        $kelurahans = Kelurahan::all();
        return view('admin.tpsuara.edit', compact('tpsuara', 'kelurahans'));
    }

    public function update(Request $request, Tpsuara $tpsuara)
    {
        $request->validate([
            'id_kel' => 'required|exists:kelurahans,id_kel',
        ]);

        $updated = $tpsuara->update([
            'id_kel' => $request->id_kel,
        ]);

        if ($updated) {
            return redirect()->route('admin.tpsuara.index')->with(['success' => 'Data berhasil diubah ke dalam tabel kategori']);
        } else {
            return redirect()->route('admin.tpsuara.index')->with(['error' => 'Data Gagal diubah ke dalam tabel kategori']);
        }
    }

    public function destroy($id)
    {
        $tpsuara = Tpsuara::findOrFail($id);
        $tpsuara->delete();

        if ($tpsuara) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}

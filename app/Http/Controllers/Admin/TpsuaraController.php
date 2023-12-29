<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kelurahan;
use App\Models\Tpsuara;
use Illuminate\Http\Request;

class TpsuaraController extends Controller
{
    public function index()
    {
        $tpsuaras = Tpsuara::with('desas')->latest()->when(request()->q, function ($query) {
            $query->whereHas('desas', function ($subQuery) {
                $subQuery->where('nama_desa', 'like', '%' . request()->q . '%');
            });
        })->paginate(10);

        return view("admin.tpsuara.index", compact("tpsuaras"));
    }

    public function create()
    {
        $desas = Desa::all();
        return view('admin.tpsuara.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_tps' => 'required|:tpsuaras,no_tps',
            'id_desa' => 'required|exists:desas,id_desa'
        ]);

        $tpsuara = Tpsuara::create([
            'no_tps'=> $request->no_tps,
            'id_desa' => $request->id_desa
        ]);

        if ($tpsuara) {
            return redirect()->route('admin.tpsuara.index')->with(['success' => 'Data berhasil ditambahkan ke dalam tabel kategori']);
        } else {
            return redirect()->route('admin.tpsuara.index')->with(['error' => 'Data Gagal ditambahkan ke dalam tabel kategori']);
        }
    }

    public function edit(Tpsuara $tpsuara)
    {
        $desas = Desa::all();
        return view('admin.tpsuara.edit', compact('tpsuara', 'desas'));
    }

    public function update(Request $request, Tpsuara $tpsuara)
    {
        $request->validate([
            'no_tps' => 'required|:tpsuaras,no_tps',
            'id_desa' => 'required|exists:desas,id_desa',
        ]);

        $updated = $tpsuara->update([
            'no_tps'=> $request->no_tps,
            'id_desa' => $request->id_desa,
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

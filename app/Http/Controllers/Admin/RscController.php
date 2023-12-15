<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caleg;
use App\Models\Rekap_suara_caleg;
use App\Models\Tpsuara;
use Illuminate\Http\Request;

class RscController extends Controller
{
    // Menampilkan daftar rekap_suara_caleg
   public function index(){
    $rekap_suara_calegs = Rekap_suara_caleg::latest()->when(request()->q, function($rekap_suara_calegs){
        $rekap_suara_calegs = $rekap_suara_calegs->where ("nama_caleg", "like", "%". request()->q ."%");
   })->paginate(10);
   $rekap_suara_calegs = Rekap_suara_caleg::with(['tpsuaras','calegs'])->paginate(10);
   return view("admin.rekap_suara_caleg.index", compact('rekap_suara_calegs'));
}

// Menampilkan form untuk membuat rekap_suara_caleg baru
public function create()
{
    $calegs = Caleg::all();
    $tpsuaras = Tpsuara::all();

    return view('admin.rekap_suara_caleg.create', compact('calegs','tpsuaras'));
}

// Menyimpan data rekap_suara_caleg baru
public function store(Request $request)
{
    $request->validate([
        'id_caleg' => 'required|exists:calegs,id_caleg',
        'id_tps' => 'required|exists:tpsuaras,id_tps',
        "jumlah"=> "required|:jumlah",
    ]);


    $rekap_suara_caleg = Rekap_suara_caleg::create([
        'id_caleg' => $request->id_caleg,
        'id_tps' => $request->id_tps,
        'jumlah' => $request->jumlah,
    ]);
    if($rekap_suara_caleg){
        return redirect()->route('admin.rekap_suara_caleg.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.rekap_suara_caleg.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
    
}

// Menampilkan form untuk mengedit rekap_suara_caleg
public function edit(Rekap_suara_caleg $rekap_suara_caleg)
{
    $rekap_suara_caleg = Rekap_suara_caleg::findOrFail($rekap_suara_caleg->id_rsc);
    $calegs = Caleg::all();
    $tpsuaras = Tpsuara::all();

    return view('admin.rekap_suara_caleg.edit', compact('rekap_suara_caleg', 'calegs', 'tpsuaras'));

}

// Menyimpan data rekap_suara_caleg yang sudah diubah
public function update(Request $request, Rekap_suara_caleg $rekap_suara_caleg)
{
    $request->validate([
        'id_caleg' => 'required|exists:calegs,id_caleg',
        'id_tps' => 'required|exists:tpsuaras,id_tps',
        'jumlah' => 'required|:rekap_suara_calegs,jumlah',
    ]);

    $rekap_suara_caleg = Rekap_suara_caleg::findOrFail($rekap_suara_caleg->id_rsc);

    // Update data rekap_suara_caleg
    $rekap_suara_caleg->update([
        'id_caleg' => $request->id_caleg,
        'id_tps' => $request->id_tps,
        'jumlah' => $request->jumlah,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    if($rekap_suara_caleg){
        return redirect()->route('admin.rekap_suara_caleg.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.rekap_suara_caleg.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
}

public function destroy($id){
    $rekap_suara_caleg = Rekap_suara_caleg::findOrFail($id);
    $rekap_suara_caleg->delete();

    //kondisi dalam hapus
    if($rekap_suara_caleg){
        return response()->json(['status'=> 'success']);
    }else{
        return response()->json(['status'=> 'error']);
    }
}

// Tambahkan metode lainnya sesuai kebutuhan
}


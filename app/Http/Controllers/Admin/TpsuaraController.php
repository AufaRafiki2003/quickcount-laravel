<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use App\Models\Tpsuara;
use Illuminate\Http\Request;

class TpsuaraController extends Controller
{
    // Menampilkan daftar tpsuara
   public function index(){
    $tpsuaras = Tpsuara::latest()->when(request()->q, function($tpsuaras){
        $tpsuaras = $tpsuaras->where ("nama_kel", "like", "%". request()->q ."%");
   })->paginate(10);
   $tpsuaras = Tpsuara::with(['kelurahans'])->paginate(10);
   return view("admin.tpsuara.index", compact("tpsuaras"));
}

// Menampilkan form untuk membuat tpsuara baru
public function create()
{
    $kelurahans = Kelurahan::all();

    return view('admin.tpsuara.create', compact('kelurahans'));
}

// Menyimpan data tpsuara baru
public function store(Request $request)
{
    $request->validate([
        'id_kel' => 'required|exists:kelurahans,id_kel'
        
    ]);


    $tpsuara = Tpsuara::create([
        'id_kel' => $request->id_kel
    ]);
    if($tpsuara){
        return redirect()->route('admin.tpsuara.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.tpsuara.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
    
}

// Menampilkan form untuk mengedit tpsuara
public function edit(Tpsuara $tpsuara)
{
    $tpsuaras = Tpsuara::findOrFail($tpsuara->id_kel);
    $kelurahans = Kelurahan::all();

    return view('admin.tpsuara.edit', compact('tpsuaras', 'kelurahans'));

}

// Menyimpan data tpsuara yang sudah diubah
public function update(Request $request, tpsuara $tpsuara)
{
    $request->validate([
        'id_kel' => 'required|exists:kelurahans,id_kel',
    ]);

    $tpsuara = Tpsuara::findOrFail($tpsuara->id_kel);

    // Update data tpsuara
    $tpsuara->update([
        'id_kel' => $request->id_kel,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    if($tpsuara){
        return redirect()->route('admin.tpsuara.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.tpsuara.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
}

public function destroy($id){
    $tpsuara = Tpsuara::findOrFail($id);
    $tpsuara->delete();

    //kondisi dalam hapus
    if($tpsuara){
        return response()->json(['status'=> 'success']);
    }else{
        return response()->json(['status'=> 'error']);
    }
}

}

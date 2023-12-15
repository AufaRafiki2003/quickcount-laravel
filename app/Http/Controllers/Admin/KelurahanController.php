<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
   // Menampilkan daftar kelurahan
   public function index(){
    $kelurahans = Kelurahan::latest()->when(request()->q, function($kelurahans){
        $kelurahans = $kelurahans->where ("nama_kel", "like", "%". request()->q ."%");
   })->paginate(10);
   $kelurahans = Kelurahan::with(['kecamatans'])->paginate(10);
   return view("admin.kelurahan.index", compact("kelurahans"));
}

// Menampilkan form untuk membuat kelurahan baru
public function create()
{
    $kecamatans = Kecamatan::all();

    return view('admin.kelurahan.create', compact('kecamatans'));
}

// Menyimpan data kelurahan baru
public function store(Request $request)
{
    $request->validate([
        'nama_kel' => 'required|:kelurahans,nama_kel',
        'id_kec' => 'required|exists:kecamatans,id_kec',
        
    ]);


    $kelurahan = Kelurahan::create([
        'nama_kel' => $request->nama_kel,
        'id_kec' => $request->id_kec,
    ]);
    if($kelurahan){
        return redirect()->route('admin.kelurahan.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.kelurahan.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
    
}

// Menampilkan form untuk mengedit kelurahan
public function edit(Kelurahan $kelurahan)
{
    $kelurahan = Kelurahan::findOrFail($kelurahan->id_kec);
    $kecamatans = Kecamatan::all();

    return view('admin.kelurahan.edit', compact('kelurahan', 'kecamatans'));

}

// Menyimpan data kelurahan yang sudah diubah
public function update(Request $request, Kelurahan $kelurahan)
{
    $request->validate([
        'nama_kel' => 'required|:kelurahans,nama_kel',
        'id_kec' => 'required|exists:kecamatans,id_kec',
    ]);

    $kelurahan = Kelurahan::findOrFail($kelurahan->id_kec);

    // Update data kelurahan
    $kelurahan->update([
        'nama_kel' => $request->nama_kel,
        'id_kec' => $request->id_kec,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    if($kelurahan){
        return redirect()->route('admin.kelurahan.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.kelurahan.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
}

public function destroy($id){
    $kelurahan = Kelurahan::findOrFail($id);
    $kelurahan->delete();

    //kondisi dalam hapus
    if($kelurahan){
        return response()->json(['status'=> 'success']);
    }else{
        return response()->json(['status'=> 'error']);
    }
}

// Tambahkan metode lainnya sesuai kebutuhan
}

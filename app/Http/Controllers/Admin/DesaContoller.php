<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DesaContoller extends Controller
{
    // Menampilkan daftar desa
   public function index(){
    $desas = Desa::latest()->when(request()->q, function($desas){
        $desas = $desas->where ("nama_desa", "like", "%". request()->q ."%");
   })->paginate(10);
   $desas = Desa::with(['kecamatans'])->paginate(10);
   return view("admin.desa.index", compact("desas"));
}

// Menampilkan form untuk membuat desa baru
public function create()
{
    $kecamatans = Kecamatan::all();

    return view('admin.desa.create', compact('kecamatans'));
}

// Menyimpan data desa baru
public function store(Request $request)
{
    $request->validate([
        'nama_desa' => 'required|:desas,nama_desa',
        'id_kec' => 'required|exists:kecamatans,id_kec',
        
    ]);


    $desa = Desa::create([
        'nama_desa' => $request->nama_desa,
        'id_kec' => $request->id_kec,
    ]);
    if($desa){
        return redirect()->route('admin.desa.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.desa.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
    
}

// Menampilkan form untuk mengedit desa
public function edit(Desa $desa)
{
    $desa = Desa::findOrFail($desa->id_kec);
    $kecamatans = Kecamatan::all();

    return view('admin.desa.edit', compact('desa', 'kecamatans'));

}

// Menyimpan data desa yang sudah diubah
public function update(Request $request, Desa $desa)
{
    $request->validate([
        'nama_desa' => 'required|:desas,nama_desa',
        'id_kec' => 'required|exists:kecamatans,id_kec',
    ]);

    $desa = Desa::findOrFail($desa->id_kec);

    // Update data desa
    $desa->update([
        'nama_desa' => $request->nama_desa,
        'id_kec' => $request->id_kec,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    if($desa){
        return redirect()->route('admin.desa.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
    }else{
        return redirect()->route('admin.desa.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
    }
}

public function destroy($id){
    $desa = Desa::findOrFail($id);
    $desa->delete();

    //kondisi dalam hapus
    if($desa){
        return response()->json(['status'=> 'success']);
    }else{
        return response()->json(['status'=> 'error']);
    }
}
}

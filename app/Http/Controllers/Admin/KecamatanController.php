<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dapil;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    // Menampilkan daftar kecamatan
    public function index(){
        $kecamatans = Kecamatan::latest()->when(request()->q, function($kecamatans){
            $kecamatans = $kecamatans->where ("nama_kec", "like", "%". request()->q ."%");
       })->paginate(10);
       $kecamatans = Kecamatan::with(['dapils'])->paginate(10);
       return view("admin.kecamatan.index", compact("kecamatans"));
    }

    // Menampilkan form untuk membuat kecamatan baru
    public function create()
    {
        $dapils = Dapil::all();

        return view('admin.kecamatan.create', compact('dapils'));
    }

    // Menyimpan data kecamatan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kec' => 'required|:kecamatans,nama_kec',
            'id_dapil' => 'required|exists:dapils,id_dapil',
            
        ]);
    

        $kecamatan = Kecamatan::create([
            'nama_kec' => $request->nama_kec,
            'id_dapil' => $request->id_dapil,
        ]);
        if($kecamatan){
            return redirect()->route('admin.kecamatan.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.kecamatan.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
        
    }

    // Menampilkan form untuk mengedit kecamatan
    public function edit(Kecamatan $kecamatan)
    {
        $kecamatan = Kecamatan::findOrFail($kecamatan->id_kec);
        $dapils = Dapil::all();

        return view('admin.kecamatan.edit', compact('kecamatan', 'dapils'));

    }

    // Menyimpan data kecamatan yang sudah diubah
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama_kec' => 'required|:kecamatans,nama_kec',
            'id_dapil' => 'required|exists:dapils,id_dapil',
        ]);
    
        $kecamatan = Kecamatan::findOrFail($kecamatan->id_kec);
    
        // Update data kecamatan
        $kecamatan->update([
            'nama_kec' => $request->nama_kec,
            'id_dapil' => $request->id_dapil,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        if($kecamatan){
            return redirect()->route('admin.kecamatan.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.kecamatan.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
    }

    public function destroy($id){
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        //kondisi dalam hapus
        if($kecamatan){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }

    // Tambahkan metode lainnya sesuai kebutuhan
}

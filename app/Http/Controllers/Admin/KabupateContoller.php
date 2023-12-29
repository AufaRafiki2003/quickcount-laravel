<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupateContoller extends Controller
{
    //method untuk tampilkan data kategori
    public function index(){
        $kabupatens = Kabupaten::latest()->when(request()->q, function($kabupatens){
             $kabupatens = $kabupatens->where ("nama_kab", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.kabupaten.index", compact("kabupatens"));
    }

    // method untuk membuat input kategori
    public function create(){
        return view("admin.kabupaten.create");
    }

    //  method store untuk tambah data pada kategory
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            "nama_kab"=> "required|:kabupatens",
            
        ]);

        // data inputan simpan ke dalam table
        $kabupaten = Kabupaten::create([
            'nama_kab'=> $request->nama_kab,
        ]);

        // kondisi
        if($kabupaten){
            return redirect()->route('admin.kabupaten.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.kabupaten.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
    }


     // membuat tampilan ubah, method ini untuk menampilkan data nya
     public function edit(Kabupaten $kabupaten){
        return view('admin.kabupaten.edit', compact('kabupaten'));
    }

    //method untuk mengirimkan data yang di ubah ke dalam table kabupatens
    public function update(Request $request, Kabupaten $kabupaten){
        //validasi data
        $this->validate($request, [
            'nama_kab'=> 'required|:kabupatens,nama_kab,' .$kabupaten->id,
        ]);

            //upload data di table kategori dengan data baru
            $kabupaten = Kabupaten::findOrFail($kabupaten->id_kabupaten);
            $kabupaten->update([
                'nama_kab' => $request->nama_kab,
            ]);
        
        //kondisi untuk penanda berhasil atau tidak dengan memberikan pop up
        if($kabupaten){
            return redirect()->route('admin.kabupaten.index')->with(['success'=> 'Data Berhasil Di Ubah Ke Dalam Table Kategori']);
        }else {
            return redirect()->route('admin.kabupaten.index')->with(['error'=> 'Data Gagal Di Ubah Ke Dalam Table Kategori']);
        }
    }
    //membuat method hapus data pada kabupaten
    public function destroy($id){
        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->delete();

        //kondisi dalam hapus
        if($kabupaten){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}

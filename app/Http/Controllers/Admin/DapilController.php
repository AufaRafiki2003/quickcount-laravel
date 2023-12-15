<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dapil;
use Illuminate\Http\Request;

class DapilController extends Controller
{
    //method untuk tampilkan data kategori
    public function index(){
        $dapils = Dapil::latest()->when(request()->q, function($dapils){
             $dapils = $dapils->where ("nama_dapil", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.dapil.index", compact("dapils"));
    }

    // method untuk membuat input kategori
    public function create(){
        return view("admin.dapil.create");
    }

    //  method store untuk tambah data pada kategory
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            "nama_dapil"=> "required|:dapils",
            
        ]);

        // data inputan simpan ke dalam table
        $dapil = Dapil::create([
            'nama_dapil'=> $request->nama_dapil,
        ]);

        // kondisi
        if($dapil){
            return redirect()->route('admin.dapil.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
        }else{
            return redirect()->route('admin.dapil.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
        }
    }


     // membuat tampilan ubah, method ini untuk menampilkan data nya
     public function edit(Dapil $dapil){
        return view('admin.dapil.edit', compact('dapil'));
    }

    //method untuk mengirimkan data yang di ubah ke dalam table dapils
    public function update(Request $request, Dapil $dapil){
        //validasi data
        $this->validate($request, [
            'nama_dapil'=> 'required|:dapils,nama_dapil,' .$dapil->id,
        ]);

            //upload data di table kategori dengan data baru
            $dapil = Dapil::findOrFail($dapil->id_dapil);
            $dapil->update([
                'nama_dapil' => $request->nama_dapil,
            ]);
        
        //kondisi untuk penanda berhasil atau tidak dengan memberikan pop up
        if($dapil){
            return redirect()->route('admin.dapil.index')->with(['success'=> 'Data Berhasil Di Ubah Ke Dalam Table Kategori']);
        }else {
            return redirect()->route('admin.dapil.index')->with(['error'=> 'Data Gagal Di Ubah Ke Dalam Table Kategori']);
        }
    }
    //membuat method hapus data pada dapil
    public function destroy($id){
        $dapil = Dapil::findOrFail($id);
        $dapil->delete();

        //kondisi dalam hapus
        if($dapil){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caleg;
use App\Models\Dapil;
use App\Models\Partai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class CalegController extends Controller
{
     //method untuk tampilkan data caleg
     public function index(){
        $calegs = Caleg::latest()->when(request()->q, function($calegs){
             $calegs = $calegs->where ("nama_caleg", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.caleg.index", compact("calegs"));
    }

    // method untuk membuat input caleg
   public function create()
    {
        $dapils = Dapil::all();
        $partais= Partai::all();

        return view('admin.caleg.create', compact('dapils','partais'));
    }
   

    //  method store untuk tambah data pada caleg
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            'id_partai' => 'required|exists:partais,id_partai',
            'nama_caleg'=> 'required|:calegs',
            'no_urut_caleg'=> 'required|:calegs',
            'id_dapil' => 'required|exists:dapils,id_dapil',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',

            
        ]);

        // kode untuk upload dan ubah nama gambar
        $foto = $request->file('foto');
        $foto->storeAs('public/gambar', $foto->hashName()); //gambar adalah nama folder di storgae unutk simpan gambar
    

        // data inputan simpan ke dalam table
        $caleg = Caleg::create([
            'id_partai' => $request->id_partai,
            'nama_caleg'=> $request->nama_caleg,
            'no_urut_caleg'=> $request->no_urut_caleg,
            'id_dapil' => $request->id_dapil,
            'foto' => $foto->hashName()
        ]);

        // kondisi
        if($caleg){
            return redirect()->route('admin.caleg.index')->with(['success'=>'data berhasil di tambah ke dalam table caleg']);
        }else{
            return redirect()->route('admin.caleg.index')->with(['error'=>'data Gagal di tambah ke dalam table caleg']);
        }
    }


     // membuat tampilan ubah, method ini untuk menampilkan data nya
     public function edit(Caleg $caleg){
        return view('admin.caleg.edit', compact('caleg'));
    }

    //method untuk mengirimkan data yang di ubah ke dalam table calegs
          public function update(Request $request, Caleg $caleg){
            // Validasi data
            $this->validate($request, [
                'id_partai' => 'required|exists:partais,id_partai',
                'nama_caleg'=> 'required',
                'no_urut_caleg'=> 'required',
                'id_dapil' => 'required|exists:dapils,id_dapil',
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',           
            ]);
        
            // Periksa apakah foto baru diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $foto->storeAs('public/gambar', $foto->hashName());
                Storage::delete('public/gambar/'.$caleg->foto);
        
                // Perbarui data dengan foto baru
                $caleg->update([
                    'id_partai' => $request->id_partai,
                    'nama_caleg'=> $request->nama_caleg,
                    'no_urut_caleg'=> $request->no_urut_caleg,
                    'id_dapil' => $request->id_dapil,
                    'foto' => $foto->hashName()
                ]);
            } else {
                // Perbarui data tanpa mengubah foto
                $caleg->update([
                    'id_partai' => $request->id_partai,
                    'nama_caleg'=> $request->nama_caleg,
                    'no_urut_caleg'=> $request->no_urut_caleg,
                    'id_dapil' => $request->id_dapil,
                ]);
            }
        
            // Periksa apakah perubahan berhasil
            if($caleg){
                return redirect()->route('admin.caleg.index')->with(['success'=> 'Data Berhasil Diubah Ke Dalam Table Caleg']);
            } else {
                return redirect()->route('admin.caleg.index')->with(['error'=> 'Data Gagal Diubah Ke Dalam Table Caleg']);
            }
        }
        
    //membuat method hapus data pada dapil
    public function destroy($id){
        $caleg = Caleg::findOrFail($id);
        $caleg->delete();

        //kondisi dalam hapus
        if($caleg){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paslon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaslonContoller extends Controller
{
    //method untuk tampilkan data paslon
    public function index(){
        $paslons = Paslon::latest()->when(request()->q, function($paslons){
             $paslons = $paslons->where ("nama_ketua", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.paslon.index", compact("paslons"));
    }

    // method untuk membuat input paslon
   public function create()
    {
        return view('admin.paslon.create');
    }
   

    //  method store untuk tambah data pada paslon
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [          
            'no_urut'=> 'required|:paslons',
            'nama_ketua'=> 'required|:paslons',
            'nama_wakil'=> 'required|:paslons',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',

            
        ]);

        // kode untuk upload dan ubah nama gambar
        $foto = $request->file('foto');
        $foto->storeAs('public/gambar', $foto->hashName()); //gambar adalah nama folder di storgae unutk simpan gambar
    

        // data inputan simpan ke dalam table
        $paslon = Paslon::create([
            'no_urut'=> $request->no_urut,
            'nama_ketua'=> $request->nama_ketua,
            'nama_wakil'=> $request->nama_wakil,
            'foto' => $foto->hashName()
        ]);

        // kondisi
        if($paslon){
            return redirect()->route('admin.paslon.index')->with(['success'=>'data berhasil di tambah ke dalam table paslon']);
        }else{
            return redirect()->route('admin.paslon.index')->with(['error'=>'data Gagal di tambah ke dalam table paslon']);
        }
    }


   
    // Di dalam fungsi edit pada controller
    public function edit(Paslon $paslon){
        return view('admin.paslon.edit', compact('paslon'));
    }

    //method untuk mengirimkan data yang di ubah ke dalam table paslons
          public function update(Request $request, Paslon $paslon){
            // Validasi data
            $this->validate($request, [
                'no_urut'=> 'required',
                'nama_ketua'=> 'required',
                'nama_Wakil'=> 'required',
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',           
            ]);
        
            // Periksa apakah foto baru diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $foto->storeAs('public/gambar', $foto->hashName());
                Storage::delete('public/gambar/'.$paslon->foto);
        
                // Perbarui data dengan foto baru
                $paslon->update([
                    'no_urut'=> $request->no_urut,
                    'nama_ketua'=> $request->nama_ketua,
                    'nama_wakil' => $request->nama_wakil,
                    'foto' => $foto->hashName()
                ]);
            } else {
                // Perbarui data tanpa mengubah foto
                $paslon->update([
                    'no_urut'=> $request->no_urut,
                    'nama_ketua'=> $request->nama_ketua,
                    'nama_wakil'=> $request->nama_wakil,
                ]);
            }
        
            // Periksa apakah perubahan berhasil
            if($paslon){
                return redirect()->route('admin.paslon.index')->with(['success'=> 'Data Berhasil Diubah Ke Dalam Table paslon']);
            } else {
                return redirect()->route('admin.paslon.index')->with(['error'=> 'Data Gagal Diubah Ke Dalam Table paslon']);
            }
        }
        
    //membuat method hapus data pada dapil
    public function destroy($id){
        $paslon = Paslon::findOrFail($id);
        $paslon->delete();

        //kondisi dalam hapus
        if($paslon){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }
    }
}

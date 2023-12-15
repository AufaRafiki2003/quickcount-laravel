<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partai;
use Illuminate\Support\Facades\Storage;

class PartaiController extends Controller
{
    public function index(){
        $partais = Partai::latest()->when(request()->q, function($partais){
             $partais = $partais->where("nama_partai", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.partai.index", compact("partais"));
    }

    public function create(){
        return view("admin.partai.create");
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'nama_partai'=> 'required',
            'no_urut_partai'=> 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $foto = $request->file('foto');
        $fotoPath = $foto->store('public/gambar');

        $partai = Partai::create([
            'nama_partai'=> $request->nama_partai,
            'no_urut_partai'=> $request->no_urut_partai,
            'foto' => str_replace('public/gambar', '', $fotoPath),
        ]);

        if($partai){
            return redirect()->route('admin.partai.index')->with(['success'=>'Data berhasil ditambahkan ke dalam tabel partai']);
        } else {
            return redirect()->route('admin.partai.index')->with(['error'=>'Data gagal ditambahkan ke dalam tabel partai']);
        }
    }

    public function edit(Partai $partai){
        return view('admin.partai.edit', compact('partai'));
    }

    public function update(Request $request, Partai $partai){
        $this->validate($request, [
            'nama_partai'=> 'required',
            'no_urut_partai'=> 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Ubah 'required' menjadi 'nullable' untuk mengizinkan foto kosong
        ]);
    
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/gambar');
            Storage::delete('public/gambar' . $partai->foto);
    
            $partai->update([
                'nama_partai'=> $request->nama_partai,
                'no_urut_partai'=> $request->no_urut_partai,
                'foto' => str_replace('public/gambar', '', $fotoPath), // Tidak perlu pemotongan 'public/gambar' di sini
            ]);
        } else {
            $partai->update([
                'nama_partai'=> $request->nama_partai,
                'no_urut_partai'=> $request->no_urut_partai,
                // Hapus baris kode yang memotong substring 'public/gambar'
            ]);
        }
    
        if($partai){
            return redirect()->route('admin.partai.index')->with(['success'=> 'Data berhasil diubah ke dalam tabel partai']);
        } else {
            return redirect()->route('admin.partai.index')->with(['error'=> 'Data gagal diubah ke dalam tabel partai']);
        }
    }
    

    public function destroy($id){
        $partai = Partai::findOrFail($id);
        $partai->delete();

        if($partai){
            return response()->json(['status'=> 'success']);
        } else {
            return response()->json(['status'=> 'error']);
        }
    }
}

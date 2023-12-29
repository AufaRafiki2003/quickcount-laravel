<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paslon;
use App\Models\Rekap_suara;
use App\Models\Tpsuara;
use Illuminate\Http\Request;

class Rekap_suaraContoller extends Controller
{
    ////
    public function index(){
        $rekap_suaras = Rekap_suara::latest()->when(request()->q, function($rekap_suaras){
            $rekap_suaras = $rekap_suaras->where ("nama_ketua", "like", "%". request()->q ."%");
       })->paginate(10);
       $rekap_suaras = Rekap_suara::with(['paslons', 'tpsuaras'])->paginate(10);
       return view("admin.rekap_suara.index", compact("rekap_suaras"));
    }

    // Menampilkan form untuk membuat kelurahan baru
    public function create()
    {
       
        $tpsuaras = Tpsuara::all();
        $paslons = Paslon::all();
        return view('admin.rekap_suara.create', compact('tpsuaras', 'paslons'));  
    }

    public function store(Request $request)
    {
    $request->validate([
        'id_paslon' => 'required|exists:paslons,id_paslon',
        'id_tps' => 'required|exists:tpsuaras,id_tps',
        'jumlah' => 'required|:rekap_suaras,jumlah'
        
    ]);


    $rekap_suara = Rekap_suara::create([
        'id_paslon' => $request->id_paslon,
        'id_tps' => $request->id_tps,
        'jumlah' => $request->jumlah
    ]);
    if($rekap_suara){
        return redirect()->route('admin.rekap_suara.index')->with(['success'=>'data berhasil di tambah ke dalam table rekap_suaras']);
    }else{
        return redirect()->route('admin.rekap_suara.index')->with(['error'=>'data Gagal di tambah ke dalam table rekap_suaras']);
    }
    
    }

    // Menampilkan form untuk mengedit kecamatan
    public function edit(Rekap_suara $rekap_suara)
{
    // Menghapus baris yang memuat rekap_suara::findOrFail() karena sudah menggunakan Route Model Binding
   
    $tpsuaras = Tpsuara::all();
    $paslons = Paslon::all();
    // Mengirimkan variabel $rekap_suara ke view
    return view('admin.rekap_suara.edit', compact('rekap_suara','paslons','tpsuaras'));
}


        // Menyimpan data kecamatan yang sudah diubah
        public function update(Request $request, Rekap_suara $rekap_suara)
        {
            $request->validate([
                'id_paslon' => 'required|exists:paslons,id_paslon',
                'id_tps' => 'required|exists:tpsuaras,id_tps',
                'jumlah' => 'required|:rekap_suaras,jumlah'
            ]);
        
            $rekap_suara = Rekap_suara::findOrFail($rekap_suara->id_rekap);
        
            // Update data kecamatan
            $rekap_suara->update([
                'id_paslon' => $request->id_paslon,
                'id_tps' => $request->id_tps,
                'jumlah' => $request->jumlah
            ]);
    
            // Redirect ke halaman index dengan pesan sukses
            if($rekap_suara){
                return redirect()->route('admin.rekap_suara.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
            }else{
                return redirect()->route('admin.rekap_suara.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
            }
        }
        public function destroy($id){
            $rekap_suara = Rekap_suara::findOrFail($id);
            $rekap_suara->delete();
    
            //kondisi dalam hapus
            if($rekap_suara){
                return response()->json(['status'=> 'success']);
            }else{
                return response()->json(['status'=> 'error']);
            }
    
        }
}

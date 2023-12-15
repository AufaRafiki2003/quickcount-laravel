<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekap_suara_partai;
use App\Models\Partai;
use App\Models\Tpsuara;

class RekapsuarapartaiController extends Controller
{
    //
    public function index(){
        $rekap_suara_partais = Rekap_suara_partai::latest()->when(request()->q, function($rekap_suara_partais){
            $rekap_suara_partais = $rekap_suara_partais->where ("id_rsp", "like", "%". request()->q ."%");
       })->paginate(10);
       $rekap_suara_partais = Rekap_suara_partai::with(['partais'])->paginate(10);
       return view("admin.rekap_suara_partai.index", compact("rekap_suara_partais"));
    }

    // Menampilkan form untuk membuat kelurahan baru
    public function create()
    {
        $partais = Partai::all();
        $tpsuaras = Tpsuara::all();
        return view('admin.rekap_suara_partai.create', compact('partais','tpsuaras'));  
    }

    public function store(Request $request)
    {
    $request->validate([
        'id_partai' => 'required|:partais,id_partai',
        'id_tps' => 'required|exists:tpsuaras,id_tps',
        'jumlah' => 'required|:rekap_suara_partais,jumlah',
        
    ]);


    $rekap_suara_partai = Rekap_suara_partai::create([
        'id_partai' => $request->id_partai,
        'id_tps' => $request->id_tps,
        'jumlah' => $request->jumlah,
    ]);
    if($rekap_suara_partai){
        return redirect()->route('admin.rekap_suara_partai.index')->with(['success'=>'data berhasil di tambah ke dalam table rekap_suara_partais']);
    }else{
        return redirect()->route('admin.rekap_suara_partai.index')->with(['error'=>'data Gagal di tambah ke dalam table rekap_suara_partais']);
    }
    
    }

    // Menampilkan form untuk mengedit kecamatan
    public function edit(Rekap_suara_partai $rekap_suara_partai)
    {
        $rekap_suara_partai = Rekap_suara_partai::findOrFail($rekap_suara_partai->id_rsp);
        $partais = Partai::all();
        $tpsuaras = Tpsuara::all();

        return view('admin.rekap_suara_partai.edit', compact('partais', 'tpsuaras'));

    }

        // Menyimpan data kecamatan yang sudah diubah
        public function update(Request $request, Rekap_suara_partai $rekap_suara_partai)
        {
            $request->validate([
                'id_partai' => 'required|:partais,id_partai',
                'id_tps' => 'required|exists:tpsuaras,id_tps',
                'jumlah' => 'required|exists:rekap_suara_partais,jumlah',
            ]);
        
            $rekap_suara_partai = Rekap_suara_partai::findOrFail($rekap_suara_partai->id_rsp);
        
            // Update data kecamatan
            $rekap_suara_partai->update([
                'id_partai' => $request->id_partai,
                'id_tps' => $request->id_tps,
                'jumlah' => $request->jumlah,
            ]);
    
            // Redirect ke halaman index dengan pesan sukses
            if($rekap_suara_partai){
                return redirect()->route('admin.rekap_suara_partai.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
            }else{
                return redirect()->route('admin.rekap_suara_partai.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
            }
        }

}

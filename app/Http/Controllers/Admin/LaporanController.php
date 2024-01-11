<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Rekap_suara;
use App\Models\Paslon;


class LaporanController extends Controller
{
    public function index()
    {
        $rekap_suaras1 = Rekap_suara::where('id_paslon', 1)->get();
        $rekap_suaras2 = Rekap_suara::where('id_paslon', 2)->get(); // Replace with your logic to fetch data for PASLON 02
        $rekap_suaras3 = Rekap_suara::where('id_paslon', 3)->get(); // Replace with your logic to fetch data for PASLON 02      
               
        // Mengambil data dari tabel kabupaten
        $kabupatens = Kabupaten::all();

        // Mengambil data dari tabel kecamatan
        $kecamatans = Kecamatan::all();

        // Mengambil data dari tabel Desa
        $desas = Desa::all();

        $rekap_suaras = Rekap_suara::all();

        return view('admin.laporan.index', compact('kabupatens', 'kecamatans', 'desas','rekap_suaras','rekap_suaras1', 'rekap_suaras2', 'rekap_suaras3'));
    }
}


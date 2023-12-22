<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dapil;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Partai;
use App\Models\Caleg;
use App\Models\Rekap_suara_caleg;
use App\Models\Rekap_suara_partai;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel dapil
        $dapils = Dapil::all();

        // Mengambil data dari tabel kecamatan
        $kecamatans = Kecamatan::all();

        // Mengambil data dari tabel kelurahan
        $kelurahans = Kelurahan::all();

        $partais = Partai::all();

        $calegs = Caleg::all();

        $rekap_suara_calegs = Rekap_suara_caleg::all();

        $rekap_suara_partais = Rekap_suara_partai::all();

        return view('admin.laporan.index', compact('dapils', 'kecamatans', 'kelurahans', 'partais', 'calegs', 'rekap_suara_calegs', 'rekap_suara_partais'));
    }
}


@extends('layouts.app', ['title' => 'Dashboard - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">USER</h4>
                            <div class="text-gray-500"><?php  echo Auth::user()->name; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-body">
                    <label for="kecamatan">Kecamatan</label>
                    <select class="form-select" id="kecamatan" onchange="changeKecamatan()">
                        <option value="" class="bg-primary">Pilih Kecamatan</option>
                        <!-- Add more options here -->
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-body">
                    <label for="kelurahan">Kelurahan</label>
                    <select class="form-select" id="kelurahan" onchange="changeKelurahan()">
                        <option value="" class="bg-primary">Pilih Kelurahan</option>
                        <!-- Add more options here -->
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-body">
                    <label for="tpsuara">TPS</label>
                    <select class="form-select" id="tpsuara" onchange="changeTpsuara()">
                        <option value="" class="bg-primary">Pilih TPS</option>
                        <!-- Add more options here -->
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi jumlah data dan persentase -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <h5>Jumlah Data Masuk</h5>
                    <p id="jumlahData">0</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5>Persentase</h5>
                    <p id="persentase">0%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel rekap suara partai dan caleg -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Rekap Suara Partai</h2>
                <table class="table table-striped" id="RekapSuaraPartai">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Partai</th>
                            <th>Total Suara</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isi tabel rekap suara partai -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Rekap Suara Caleg</h2>
                <table class="table table-striped" id="RekapSuaraCaleg">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Caleg</th>
                            <th>Total Suara</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isi tabel rekap suara caleg -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Data rekap suara partai (contoh)
        const dataSuaraPartai = [
            { nomor: 1, nama: 'Partai A', suara: 500 },
            { nomor: 2, nama: 'Partai B', suara: 350 },
            // ...
        ];
        
        // Data rekap suara caleg (contoh)
        const dataSuaraCaleg = [
            { nomor: 1, nama: 'Caleg 1', suara: 150 },
            { nomor: 2, nama: 'Caleg 2', suara: 120 },
            // ...
        ];
        
        // Fungsi untuk mengisi tabel rekap suara partai
        function isiTabelRekapSuaraPartai() {
            const tabelRekapSuaraPartai = $('#rekapSuaraPartai');
            tabelRekapPartai.empty();
        
            dataSuaraPartai.forEach((partai, index) => {
                tabelRekapPartai.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${partai.nama}</td>
                        <td>${partai.suara}</td>
                    </tr>
                `);
            });
        }
        
        // Fungsi untuk mengisi tabel rekap suara caleg
        function isiTabelRekapSuaraCaleg() {
            const tabelRekapCaleg = $('#rekapSuaraCaleg');
            tabelRekapCaleg.empty();
        
            dataSuaraCaleg.forEach((caleg, index) => {
                tabelRekapCaleg.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${caleg.nama}</td>
                        <td>${caleg.suara}</td>
                    </tr>
                `);
            });
        }
        
        // Panggil fungsi untuk mengisi tabel
        isiTabelRekapSuaraPartai();
        isiTabelRekapSuaraCaleg();
    </script>
</body>
</html>

@extends('layouts.app', ['title' => 'Laporan'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75 mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
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
                    </div>
                </div>
                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-green-600 bg-opacity-75 mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
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
                    </div>
                </div>
                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-pink-600 bg-opacity-75 mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
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
            </div>

            <div class="flex justify-between mt-4">
                <div class="w-1/2">
                    <div class="card-body">
                        <h5 class="font-bold mb-2">Jumlah Data Masuk</h5>
                        <p id="jumlahData">0</p>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="card-body">
                        <h5 class="font-bold mb-2">Persentase</h5>
                        <p id="persentase">0%</p>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="font-bold mb-4">Rekap Suara Partai</h1>
            <div class="table-responsive">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="bg-gray-600 w-full">

                            <th class="px-16 py-2 text-left">
                                <span class="text-white">No.</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Nama Partai</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Total Suara</span>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <h1 class="font-bold mb-4">Rekap Suara Caleg</h1>
            <div class="table-responsive">
            <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="bg-gray-600 w-full">

                            <th class="px-16 py-2 text-left">
                                <span class="text-white">No.</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Nama Caleg</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Total Suara</span>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
</main>
@endsection

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

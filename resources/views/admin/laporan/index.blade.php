@extends('layouts.app', ['title' => 'Laporan - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-9 py-6">
        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                            <img src="{{ asset('storage/gambar/amin.jpg') }}" alt="Amin" class="w-10 h-10">
                        </div>
                        
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">PASLON 1</h4>
                            <div class="text-gray-500">
                                @foreach($rekap_suaras1 as $Rekap_suara)
                                    <h1 class="text-2xl font-semibold" value="{{ $Rekap_suara->id_paslon }}">{{ $Rekap_suara->jumlah }} Suara</h1> 
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-green-600 bg-opacity-75">
                            <img src="{{ asset('storage/gambar/gemoy.jpg') }}" alt="Gemoy" class="w-10 h-10">
                        </div>
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">PASLON 2</h4>
                            <div class="text-gray-500">
                            @foreach($rekap_suaras2 as $Rekap_suara)
                                <h1 class="text-2xl font-semibold" value="{{ $Rekap_suara->id_paslon }}">{{ $Rekap_suara->jumlah }} Suara</h1> 
                            @endforeach</div>
                        </div>
                    </div>
                </div>
                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                            <img src="{{ asset('storage/gambar/banteng.jpg') }}" alt="Banteng" class="w-10 h-10">
                        </div>
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">PASLON 2</h4>
                            <div class="text-gray-500">
                            @foreach($rekap_suaras3 as $Rekap_suara)
                                <h1 class="text-2xl font-semibold" value="{{ $Rekap_suara->id_paslon }}">{{ $Rekap_suara->jumlah }} Suara</h1> 
                            @endforeach</div>
                        </div>
                    </div>
                </div>

                <div class="container mt-5 mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Select Menus -->
                        <div class="w-full p-2">
                            <select id="kabupatenSelect" class="w-full p-2 border border-gray-400 rounded-md">
                                <option value="">Pilih Kabupaten</option>
                                @foreach($kabupatens as $Kabupaten)
                                    <option value="{{ $Kabupaten->id_kab }}">{{ $Kabupaten->nama_kab }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <select id="kecamatanSelect" class="w-full p-2 border border-gray-400 rounded-md">
                                <option value="">Pilih Kecamatan</option>
                                @foreach($kecamatans as $Kecamatan)
                                    <option value="{{ $Kecamatan->id_kec }}">{{ $Kecamatan->nama_kec }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <select id="desaSelect" class="w-full p-2 border border-gray-400 rounded-md">
                                <option value="">Pilih Desa</option>
                                @foreach($desas as $Desa)
                                    <option value="{{ $Desa->id_desa }}">{{ $Desa->nama_desa }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="w-full p-2">
                            <button onclick="cariData()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Cari
                            </button>
                        </div>                       
                        <!-- End Select Menus -->

                        <!-- Chart container with horizontal scroll -->
                        <div class="w-full col-span-2 p-2 overflow-x-auto">
                            <canvas id="candidateChart" class="chartjs" style="width: 100%; height: 500px;"></canvas>
                        </div>
                    </div>
                    
                    <!-- Include Chart.js library -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const kabupatenSelect = document.getElementById('kabupatenSelect');
                        const kecamatanSelect = document.getElementById('kecamatanSelect');
                        const desaSelect = document.getElementById('desaSelect');
                        // Data kecamatan yang sudah ditarik sebelumnya dari controller
                        const kecamatansData = {!! $kecamatans !!}; // Pastikan format data sudah sesuai
                        const desasData = {!! $desas !!}; // Pastikan format data sudah sesuai
                        console.log(kecamatansData);
                        
                        // Event listener untuk perubahan pada dropdown kabupaten
                        kabupatenSelect.addEventListener('change', function() {
                            const selectedKabupaten = this.value;
                            console.log(selectedKabupaten);

                            // Disable kecamatan select untuk sementara
                            kecamatanSelect.disabled = false;

                            // Bersihkan opsi sebelumnya pada dropdown kecamatan
                            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

                            // Jika Kabupaten dipilih
                            if (selectedKabupaten) {
                                // Filter data kecamatan berdasarkan id_Kabupaten yang dipilih
                                console.log(selectedKabupaten);
                                const filteredKecamatans = kecamatansData.filter(kecamatan => kecamatan.id_kabupaten == selectedKabupaten);

                                // Tampilkan kecamatan yang sudah difilter
                                filteredKecamatans.forEach(kecamatan => {
                                    const option = document.createElement('option');
                                    option.value = kecamatan.id_kec;
                                    option.textContent = kecamatan.nama_kec;
                                    kecamatanSelect.appendChild(option);
                                });

                                // Aktifkan kembali dropdown kecamatan
                                kecamatanSelect.disabled = false;
                            }
                        });

                        kecamatanSelect.addEventListener('change', function() {
                            const selectedKecamatan = this.value;
                            console.log(selectedKecamatan);

                            // Disable kecamatan select untuk sementara
                            desaSelect.disabled = false;

                            // Bersihkan opsi sebelumnya pada dropdown kecamatan
                            desaSelect.innerHTML = '<option value="">Pilih desa</option>';

                            // Jika kabupaten dipilih
                            if (selectedKecamatan) {
                                // Filter data kecamatan berdasarkan id_kabupaten yang dipilih
                                console.log(selectedKecamatan);
                                const filteredDesa = desasData.filter(desa => desa.id_kec == selectedKecamatan);

                                // Tampilkan kecamatan yang sudah difilter
                                filteredDesas.forEach(desa => {
                                    const option = document.createElement('option');
                                    option.value = desa.id_kel;
                                    option.textContent = desa.nama_desa;
                                    desaSelect.appendChild(option);
                                });

                                // Aktifkan kembali dropdown kecamatan
                                desaSelect.disabled = false;
                            }
                        });
                    </script>
                    <!-- Script to generate the chart -->
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

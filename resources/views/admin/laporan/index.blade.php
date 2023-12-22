@extends('layouts.app', ['title' => 'LAPORAN - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto">
        <div class="flex items-center">

            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Analytics</h1>
                    </div>
                </div>

                <div class="container mt-5 mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Select Menus -->
                        <div class="w-full p-2">
                            <select id="dapilSelect" class="w-full p-2 border border-gray-400 rounded-md">
                                <option value="">Pilih Dapil</option>
                                @foreach($dapils as $dapil)
                                    <option value="{{ $dapil->id_dapil }}">{{ $dapil->nama_dapil }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <select id="kecamatanSelect" class="w-full p-2 border border-gray-400 rounded-md" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <select id="kelurahanSelect" class="w-full p-2 border border-gray-400 rounded-md" disabled>
                                <option value="">Pilih Kelurahan</option>
                            </select>
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
                        const dapilSelect = document.getElementById('dapilSelect');
                        const kecamatanSelect = document.getElementById('kecamatanSelect');
                        const kelurahanSelect = document.getElementById('kelurahanSelect');
                        // Data kecamatan yang sudah ditarik sebelumnya dari controller
                        const kecamatansData = {!! $kecamatans !!}; // Pastikan format data sudah sesuai
                        const kelurahansData = {!! $kelurahans !!}; // Pastikan format data sudah sesuai
                        console.log(kecamatansData);
                        
                        // Event listener untuk perubahan pada dropdown dapil
                        dapilSelect.addEventListener('change', function() {
                            const selectedDapil = this.value;
                            console.log(selectedDapil);

                            // Disable kecamatan select untuk sementara
                            kecamatanSelect.disabled = false;

                            // Bersihkan opsi sebelumnya pada dropdown kecamatan
                            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

                            // Jika dapil dipilih
                            if (selectedDapil) {
                                // Filter data kecamatan berdasarkan id_dapil yang dipilih
                                console.log(selectedDapil);
                                const filteredKecamatans = kecamatansData.filter(kecamatan => kecamatan.id_dapil == selectedDapil);

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
                            kelurahanSelect.disabled = false;

                            // Bersihkan opsi sebelumnya pada dropdown kecamatan
                            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

                            // Jika dapil dipilih
                            if (selectedKecamatan) {
                                // Filter data kecamatan berdasarkan id_dapil yang dipilih
                                console.log(selectedKecamatan);
                                const filteredKelurahans = kelurahansData.filter(kelurahan => kelurahan.id_kec == selectedKecamatan);

                                // Tampilkan kecamatan yang sudah difilter
                                filteredKelurahans.forEach(kelurahan => {
                                    const option = document.createElement('option');
                                    option.value = kelurahan.id_kel;
                                    option.textContent = kelurahan.nama_kel;
                                    kelurahanSelect.appendChild(option);
                                });

                                // Aktifkan kembali dropdown kecamatan
                                kelurahanSelect.disabled = false;
                            }
                        });
                    </script>
                    <!-- Script to generate the chart -->
                    <script>
                        const partaisData = {!! $partais !!};
                        const calegsData = {!! $calegs !!};
                        const suaraPartaiData = {!! $rekap_suara_partais !!};
                        const suaraCalegData = {!! $rekap_suara_calegs !!};
                        const filteredPartais = partaisData.map(partai => partai.nama_partai);
                        const filteredIdPartais = partaisData.map(partai => partai.id_partai);

                        const jumlahSuaraPerPartai = [];

                        // Lakukan loop untuk setiap id_partai yang telah difilter
                        filteredIdPartais.forEach(idPartai => {
                            // Filter data rekap_suara_partai berdasarkan id_partai yang sedang dilooping
                            const suaraPartai = suaraPartaiData.filter(item => item.id_partai === idPartai);
                            const calegPartai = calegsData.filter(item => item.id_partai === idPartai);
                            const suaraCalegPartai = suaraCalegData.filter(item => calegPartai.map(caleg => caleg.id_caleg).includes(item.id_caleg));


                            console.log('suaraPartai')
                            console.log(suaraCalegPartai)

                            const totalSuaraCalegPartai = suaraCalegPartai.reduce((total, item) => total + item.jumlah, 0);
                            // Hitung jumlah suara untuk id_partai tersebut
                            const totalSuaraPartai = suaraPartai.reduce((total, item) => total + item.jumlah, 0);

                            // Simpan jumlah suara per partai ke dalam objek
                            jumlahSuaraPerPartai.push(totalSuaraPartai+totalSuaraCalegPartai);
                        });
                        console.log(jumlahSuaraPerPartai);
                        // Sample data for candidates
                        const candidateData = {
                            labels: filteredPartais,
                            datasets: [{
                                label: "Votes",
                                data: jumlahSuaraPerPartai,
                                backgroundColor: ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)"],
                                borderColor: ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)"],
                                borderWidth: 1
                            }]
                        };

                        // Get the chart canvas element
                        const candidateChartCanvas = document.getElementById('candidateChart');

                        // Create the chart
                        const candidateChart = new Chart(candidateChartCanvas, {
                            type: 'bar',
                            data: candidateData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false, // Disable aspect ratio maintenance
                                scales: {
                                    x: {
                                        beginAtZero: true
                                    },
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

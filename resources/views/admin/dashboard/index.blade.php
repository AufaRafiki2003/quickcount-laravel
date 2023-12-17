<!DOCTYPE html>
<html lang="en">
<head?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <title>Dashboard</title>

    <!-- Custom styles for the page -->
    <style>
          body {
        /* Background dengan gradien dari biru ke ungu */
        background-color: #f0f0f0; /* Ganti dengan warna latar belakang yang diinginkan */
        /* Anda bisa mengubah warna atau arah gradien sesuai keinginan */
        /* Untuk gradien yang berbeda, ubah nilai warna pada linear-gradient */
    }

    .header {
        background-color: #007bff; /* Blue header background color */
        color: #fff; /* White text color */
        padding: 10px;
        text-align: center;
        font-size: 24px;
    }
    </style>
</head>
    <div class="header bg-primary text-white text-center py-3">
        Dashboard
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card-body">
                    <label for="dapil">Dapil</label>
                    <select class="form-select" id="dapil" onchange="changeDapil()">
                        <option value="" class="bg-primary">Pilih Dapil</option>
                        <!-- Add more options here -->
                    </select>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kamar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
        /* Optional: Customize the datepicker here */
        .datepicker {
            z-index: 1050 !important; /* Fixes datepicker overlapping issue */
        }
        .form-container {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="text"], 
        .form-group input[type="number"], 
        .form-group select {
            border-radius: 5px;
        }
        .form-group .form-check-label {
            margin-left: 0.5rem;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }
        .btn-container .btn {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <?php include 'navigasi.php'; ?>

    <div class="container mt-4">
        <div class="form-container">
            <h1>Pesan Kamar</h1>
            <form action="submit.php" method="post" onsubmit="return validateForm();">
                <div class="form-group">
                    <label for="nama_pemesan">Nama Pemesan:</label>
                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">Jenis Kelamin:</label> 
                    <div class="col-sm-12">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="laki" name="jenis_kelamin" value="Laki" required>
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="perempuan" name="jenis_kelamin" value="Perempuan" required>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nomor_identitas">Nomor Identitas:</label>
                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" maxlength="16" required>
                </div>
                <div class="form-group">
                    <label for="tipe_kamar">Tipe Kamar:</label>
                    <select id="tipe_kamar" name="tipe_kamar" class="form-control" onchange="calculateTotal()" required>
                        <option value="">Pilih Kamar</option>
                        <option value="Standar">Standar</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Executif">Executif</option>
                    </select>
                </div>
             
                <div class="form-group">
                    <label for="durasi">Durasi Menginap (hari):</label>
                    <input type="text" class="form-control" id="durasi" name="durasi" required oninput="validateNumericInput(this); calculateTotal();">
                </div>
                <div class="form-group">
                    <label for="harga_kamar">Harga Kamar:</label>
                    <input type="text" class="form-control" id="harga_kamar" name="harga_kamar" readonly>
                </div>
                <div class="form-group">
                    <label for="tanggal_pesan">Tanggal Pesan:</label>
                    <input type="text" class="form-control" id="tanggal_pesan" name="tanggal_pesan" required>
                </div>
              
                <div class="form-group">
                    <label for="breakfast">Termasuk Breakfast</label>
                    <input type="checkbox" id="breakfast" name="breakfast">
                    <label for="breakfast">Ya</label>
                </div>
                <div class="form-group mt-4">
                    <label for="total_bayar">Total Bayar:</label>
                    <input type="text" class="form-control" id="total_bayar" name="total_bayar" readonly>
                    <hr class="my-3"> <!-- Separator -->
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-primary" onclick="calculateTotal()">Hitung Total Bayar</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="products.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
    
    <script>
        function formatNumber(number) {
            return number.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function calculateTotal() {
            const hargaStandar = 500000;
            const hargaDeluxe = 750000;
            const hargaExecutif = 1000000;
            const breakfastCost = 80000;

            const tipeKamar = document.getElementById('tipe_kamar').value;
            const durasi = parseInt(document.getElementById('durasi').value) || 0;
            const breakfastCheckbox = document.getElementById('breakfast');
            const termasukBreakfast = breakfastCheckbox ? breakfastCheckbox.checked : false;

            let harga = 0;

            switch (tipeKamar) { //percabangan
                case 'Standar':
                    harga = hargaStandar;
                    break;
                case 'Deluxe':
                    harga = hargaDeluxe;
                    break;
                case 'Executif':
                    harga = hargaExecutif;
                    break;
            }

            let total = harga * durasi;
            if (durasi > 3) {
                total *= 0.9; // Diskon 10%
            }
            if (termasukBreakfast) {
                total += breakfastCost;
            }

            document.getElementById('harga_kamar').value = formatNumber(harga);
            document.getElementById('total_bayar').value = formatNumber(total);
        }

        function validateNumericInput(input) {
            const value = input.value;

            // Hapus karakter yang bukan angka
            const cleanedValue = value.replace(/[^0-9]/g, '');
            if (cleanedValue !== value) {
                alert('Input durasi hanya boleh angka.');
                input.value = cleanedValue;
            }
        }

        function validateForm() {
            let valid = true;

            // Validasi Nama Pemesan
            const namaPemesan = document.getElementById('nama_pemesan').value;
            if (namaPemesan.trim() === '') {
                alert('Nama Pemesan harus diisi.');
                valid = false;
            }

            // Validasi Nomor Identitas
            const nomorIdentitas = document.getElementById('nomor_identitas').value;
            if (!/^\d{16}$/.test(nomorIdentitas)) {
                alert('Isian salah..data harus 16 digit.');
                valid = false;
            }

            // Validasi Durasi Menginap
            const durasi = document.getElementById('durasi').value;
            if (isNaN(durasi) || durasi === '') {
                alert('Durasi Menginap harus diisi dengan angka.');
                valid = false;
            }

            return valid;
        }

        $(document).ready(function () {
            $('#tanggal_pesan').datepicker({
                format: 'dd-mm-yyyy',
                language: 'id',
                startDate: '+1d',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
</body>
</html>

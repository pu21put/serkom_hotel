<?php
include 'db.php';

// Ambil ID pemesanan dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data pemesanan dari database
$sql = "SELECT * FROM bookings WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $nama_pemesan = $row['nama_pemesan'];
    $jenis_kelamin = $row['jenis_kelamin'] == 'Laki' ? 'Laki-laki' : 'Perempuan'; 
    $nomor_identitas = $row['nomor_identitas'];
    $tipe_kamar = $row['tipe_kamar'];
    $harga = $row['harga'];
    $tanggal_pesan = DateTime::createFromFormat('Y-m-d', $row['tanggal_pesan']);
    $tanggal_pesan = $tanggal_pesan ? $tanggal_pesan->format('d/m/Y') : '';
    $durasi = $row['durasi'];
    $termasuk_breakfast = $row['termasuk_breakfast'] ? 'Ya' : 'Tidak';
    $total_bayar = $row['total_bayar'];

    // Diskon
    $diskon = ($durasi > 3) ? '10%' : 'Tidak ada diskon';
} else {
    echo "Data pemesanan tidak ditemukan.";
    exit();  //ini juga termasuk
}

// Ambil semua data bookings untuk grafik
$grafikData = []; //array
$sqlGrafik = "SELECT tipe_kamar, COUNT(*) AS jumlah FROM bookings GROUP BY tipe_kamar";
$resultGrafik = $conn->query($sqlGrafik);

if ($resultGrafik->num_rows > 0) {
    while($rowGrafik = $resultGrafik->fetch_assoc()) {
        $grafikData[] = $rowGrafik; //array
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pemesanan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .info-box {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
       @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .no-print {
                display: none;
            }
            
            .info-box {
                border: none;
                box-shadow: none;
            }
            
            header, footer, .no-print {
                display: none !important;
            }
            @page {
            margin: 0;
        }
        }
    </style>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-4">
        <!-- Pesan sukses -->
        <div class="alert alert-success no-print" role="alert">
            Pemesanan Anda telah berhasil dilakukan!
        </div>
        <div class="info-box">
            <h2>Informasi Pemesanan</h2>
            <p><strong>Tanggal Pemesan:</strong> <?php echo htmlspecialchars($tanggal_pesan); ?></p>
            <p><strong>Nama Pemesan:</strong> <?php echo htmlspecialchars($nama_pemesan); ?></p>
            <p><strong>Nomor Identitas:</strong> <?php echo htmlspecialchars($nomor_identitas); ?></p>
            <p><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($jenis_kelamin); ?></p>
            <p><strong>Tipe Kamar:</strong> <?php echo htmlspecialchars($tipe_kamar); ?></p>
            <p><strong>Durasi Penginapan:</strong> <?php echo htmlspecialchars($durasi); ?> hari</p>
            <p><strong>Diskon:</strong> <?php echo htmlspecialchars($diskon); ?></p>
            <p><strong>Total Bayar:</strong> Rp <?php echo number_format($total_bayar, 2, ',', '.'); ?></p>
            <a href="index.php" class="btn btn-primary no-print">Kembali Pesan</a>
            <button onclick="window.print()" class="btn btn-secondary no-print">Cetak</button>
            <button id="toggleGrafik" class="btn btn-info no-print">Lihat Grafik Pemesanan</button>
        </div>

        <!-- Grafik Container -->
        <div class="info-box" id="grafikContainer" style="display:none;">
            <h2>Grafik Pemesanan Kamar</h2>
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script>
        document.getElementById('toggleGrafik').addEventListener('click', function() {
            var grafikContainer = document.getElementById('grafikContainer');
            if (grafikContainer.style.display === 'none') {
                grafikContainer.style.display = 'block';
            } else {
                grafikContainer.style.display = 'none';
            }
        });

        // Data Grafik
        var ctx = document.getElementById('myChart').getContext('2d');
        
        // Warna-warna untuk setiap tipe kamar
        var colors = [
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];
        
        var borderColors = [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ];

        var labels = <?php echo json_encode(array_column($grafikData, 'tipe_kamar')); ?>;
        var data = <?php echo json_encode(array_column($grafikData, 'jumlah')); ?>;

        // Mengatur warna berdasarkan indeks tipe kamar
        var backgroundColors = labels.map((label, index) => colors[index % colors.length]);
        var borderColors = labels.map((label, index) => borderColors[index % borderColors.length]);

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

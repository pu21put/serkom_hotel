<?php
    include 'db.php';

    // Ambil data dari form
    $nama_pemesan = $_POST['nama_pemesan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_identitas = $_POST['nomor_identitas'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga_kamar'];
    $tanggal_pesan = $_POST['tanggal_pesan'];
    $durasi = $_POST['durasi'];
    $termasuk_breakfast = isset($_POST['breakfast']) ? 1 : 0;
    $total_bayar = $total_bayar = preg_replace('/,\d{2}$/', '', $_POST['total_bayar']);

    // Hapus separator ribuan dari harga dan total bayar
    $harga = preg_replace('/\D/', '', $harga); // Hapus semua karakter non-digit
    $total_bayar1 = preg_replace('/\D/', '', $total_bayar); // Hapus semua karakter non-digit

    // Konversi format tanggal
    $tanggal_pesan = DateTime::createFromFormat('d/m/Y', $tanggal_pesan);
    $tanggal_pesan = $tanggal_pesan ? $tanggal_pesan->format('Y-m-d') : '';

    // SQL Query untuk memasukkan data ke database, akses file
    $sql = "INSERT INTO bookings (nama_pemesan, jenis_kelamin, nomor_identitas, tipe_kamar, harga, tanggal_pesan, durasi, termasuk_breakfast, total_bayar)
    VALUES ('$nama_pemesan', '$jenis_kelamin', '$nomor_identitas', '$tipe_kamar', '$harga', '$tanggal_pesan', '$durasi', '$termasuk_breakfast', '$total_bayar1')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

	    // Redirect ke halaman detail pemesanan dengan ID pemesanan
	    header("Location: nota.php?id=$last_id");
	    exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
?>

<?php
	$servername = "localhost";
	$username = "root"; // Ganti dengan username MySQL Anda
	$password = ""; // Ganti dengan password MySQL Anda
	$dbname = "serkom_hotel";

	// Buat koneksi
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Cek koneksi, koreksi kesalahan program
	if ($conn->connect_error) {
	    die("Koneksi gagal: " . $conn->connect_error);
	}
?>
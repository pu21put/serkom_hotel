<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kamar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
            border: 3px solid #ddd; /* Border color */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for 3D effect */
        }
        .video-container iframe, 
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .video-header {
            margin-top: 30px;
            padding: 10px;
            background-color: #f8f9fa; /* Background color */
            border-bottom: 2px solid #ddd; /* Border color */
            border-radius: 5px 5px 0 0; /* Rounded corners for top */
        }
        .video-box {
            padding: 20px;
            background-color: #fff; /* Background color */
            border-radius: 5px; /* Rounded corners */
            border: 1px solid #ddd; /* Border color */
        }
        .btn-container {
            display: flex;
            gap: 10px; /* Space between buttons */
        }
    </style>
</head>
<body>
    <?php include 'navigasi.php'; ?>

    <div class="container mt-4">
        <?php
        // Ambil parameter type dari URL
        $type = isset($_GET['type']) ? $_GET['type'] : 'standar';

        // Definisikan informasi kamar
        $rooms = [
            'standar' => [
                'title' => 'Kamar Standar',
                'image' => 'images/standar.jpg',
                'description' => 'Kamar Standar menawarkan kenyamanan dasar dengan fasilitas yang lengkap untuk kebutuhan dasar Anda.',
                'facilities' => 'Fasilitas tambahan termasuk: TV, Wi-Fi gratis, dan minibar.',
                'video' => 'https://www.youtube.com/embed/4Bhe72Y6xLA' // Video YouTube
            ],
            'deluxe' => [
                'title' => 'Kamar Deluxe',
                'image' => 'images/deluxe.jpg',
                'description' => 'Kamar Deluxe memberikan pengalaman menginap yang lebih mewah dengan fasilitas tambahan dan desain yang lebih baik.',
                'facilities' => 'Fasilitas tambahan termasuk: TV layar datar, Wi-Fi gratis, dan akses ke lounge eksekutif.',
                'video' => 'https://www.youtube.com/embed/4Bhe72Y6xLA' // Video YouTube
            ],
            'executif' => [
                'title' => 'Kamar Executif',
                'image' => 'images/executif.jpg',
                'description' => 'Kamar Executif adalah pilihan terbaik untuk Anda yang menginginkan kenyamanan dan layanan premium.',
                'facilities' => 'Fasilitas tambahan termasuk: Ruang tamu terpisah, layanan butler, dan sarapan eksklusif.',
                'video' => 'https://www.youtube.com/embed/4Bhe72Y6xLA' // Video YouTube
            ]
        ];

        // Cek apakah type ada di array, jika tidak, gunakan default 'standar'
        $room = isset($rooms[$type]) ? $rooms[$type] : $rooms['standar'];
        ?>

        <h1><?php echo $room['title']; ?></h1>
        <img src="<?php echo $room['image']; ?>" class="product-image" alt="<?php echo $room['title']; ?>">
        <p><?php echo $room['description']; ?></p>
        <p><?php echo $room['facilities']; ?></p>

        <!-- Video -->
        <div class="video-box mt-4">
            <div class="video-header">
                <h2>Video Kamar</h2>
            </div>
            <div class="video-container mt-3">
                <iframe src="<?php echo $room['video']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <!-- Tombol Kembali dan Pesan Kamar -->
        <div class="btn-container mt-4">
            <a href="products.php" class="btn btn-primary">Kembali ke Daftar Produk</a>
            <a href="booking.php" class="btn btn-success">Pesan Kamar</a>
          
        </div>  <br/> <br/>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include 'navigasi.php'; ?>

    <div class="container mt-4">
        <h1>Produk Kamar</h1>
        <div class="row">
            <div class="col-md-4">
                <a href="detail.php?type=standar">
                    <img src="images/standar.jpg" class="product-image" alt="Kamar Standar">
                    <h3 class="text-center">Kamar Standar</h3>
                </a>
                <p>Kamar Standar menawarkan kenyamanan dasar dengan fasilitas yang lengkap untuk kebutuhan dasar Anda.</p>
            </div>
            <div class="col-md-4">
                <a href="detail.php?type=deluxe">
                    <img src="images/deluxe.jpg" class="product-image" alt="Kamar Deluxe">
                    <h3 class="text-center">Kamar Deluxe</h3>
                </a>
                <p>Kamar Deluxe memberikan pengalaman menginap yang lebih mewah dengan fasilitas tambahan dan desain yang lebih baik.</p>
            </div>
            <div class="col-md-4">
                <a href="detail.php?type=executif">
                    <img src="images/executif.jpg" class="product-image" alt="Kamar Executif">
                    <h3 class="text-center">Kamar Executif</h3>
                </a>
                <p>Kamar Executif adalah pilihan terbaik untuk Anda yang menginginkan kenyamanan dan layanan premium.</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

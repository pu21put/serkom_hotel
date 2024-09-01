<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav {
            margin-left: auto;
        }
        .carousel-item img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include 'navigasi.php'; ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/standar.jpg" class="d-block w-100" alt="Kamar Standar">
            </div>
            <div class="carousel-item">
                <img src="images/deluxe.jpg" class="d-block w-100" alt="Kamar Deluxe">
            </div>
            <div class="carousel-item">
                <img src="images/executif.jpg" class="d-block w-100" alt="Kamar Executif">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container mt-4">
        <h1>Selamat Datang di Hotel Kami!</h1>
        <p>Temukan kamar yang sesuai dengan kebutuhan Anda dan lakukan pemesanan secara online.</p>
    </div>

    <!-- Daftar Produk -->
    <div class="container mt-4">
        <h2>Daftar Kamar Kami</h2>
        <div class="row">
            <!-- Kamar Standar -->
            <div class="col-md-4">
                <div class="card product-card mb-4">
                    <img src="images/standar.jpg" class="card-img-top" alt="Kamar Standar">
                    <div class="card-body">
                        <h5 class="card-title">Kamar Standar</h5>
                        <p class="card-text">Kamar Standar menawarkan kenyamanan dasar dengan fasilitas yang lengkap untuk kebutuhan dasar Anda.</p>
                        <a href="detail.php?type=standar" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <!-- Kamar Deluxe -->
            <div class="col-md-4">
                <div class="card product-card mb-4">
                    <img src="images/deluxe.jpg" class="card-img-top" alt="Kamar Deluxe">
                    <div class="card-body">
                        <h5 class="card-title">Kamar Deluxe</h5>
                        <p class="card-text">Kamar Deluxe memberikan pengalaman menginap yang lebih mewah dengan fasilitas tambahan dan desain yang lebih baik.</p>
                        <a href="detail.php?type=deluxe" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <!-- Kamar Executif -->
            <div class="col-md-4">
                <div class="card product-card mb-4">
                    <img src="images/executif.jpg" class="card-img-top" alt="Kamar Executif">
                    <div class="card-body">
                        <h5 class="card-title">Kamar Executif</h5>
                        <p class="card-text">Kamar Executif adalah pilihan terbaik untuk Anda yang menginginkan kenyamanan dan layanan premium.</p>
                        <a href="detail.php?type=executif" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

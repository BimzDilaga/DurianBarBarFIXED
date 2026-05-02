<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Durian Bar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f3f3f3;
        }

        .navbar {
            background: #fff;
        }

        .slider-box {
            background: #2ecc71;
            border-radius: 20px;
            padding: 30px;
            color: white;
        }

        .card-menu {
            border-radius: 20px;
            padding: 15px;
            text-align: center;
        }

        .promo {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-5">
    <a class="navbar-brand fw-bold" href="#">DurianBar</a>

    <div class="ms-auto">
        @guest
            <a href="{{ route('login') }}" class="btn btn-success">Login</a>
        @else
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </div>
</nav>

<div class="container mt-4">

    <!-- SLIDER -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner slider-box">

            <!-- SLIDE 1 -->
            <div class="carousel-item active">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="/images/durian1.png" class="img-fluid">
                    </div>
                    <div class="col-md-5">
                        <h3>Es Teler Durian</h3>
                        <p>Minuman segar durian lezat dan creamy.</p>
                    </div>
                    <div class="col-md-3 text-end">
                        <p class="promo">Rp. 20.000</p>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2 -->
            <div class="carousel-item">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="/images/mie.png" class="img-fluid">
                    </div>
                    <div class="col-md-5">
                        <h3>Mie Ayam Jamur</h3>
                        <p>Mie lembut dengan ayam gurih.</p>
                    </div>
                    <div class="col-md-3 text-end">
                        <p class="promo">Rp. 12.000</p>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3 -->
            <div class="carousel-item">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="/images/durian2.png" class="img-fluid">
                    </div>
                    <div class="col-md-5">
                        <h3>Es Durian Original</h3>
                        <p>Durian asli tanpa campuran.</p>
                    </div>
                    <div class="col-md-3 text-end">
                        <p class="promo">Rp. 10.000</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- BUTTON -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- RECOMMENDATION -->
    <h4 class="mt-5 text-center">Recommendation</h4>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card-menu bg-white">
                <img src="/images/udang.jpg" class="img-fluid">
                <h5>Udang Keju</h5>
                <a href="#">details</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-menu bg-white">
                <img src="/images/dawet.jpg" class="img-fluid">
                <h5>Es Dawet Durian</h5>
                <a href="#">details</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-menu bg-white">
                <img src="/images/miebakso.jpg" class="img-fluid">
                <h5>Mie Ayam Bakso</h5>
                <a href="#">details</a>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Bar Es Duren - Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* CSS RESET & BASE */
        body {
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Nunito', sans-serif; background-color: #ffffff; color: #333;
        }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }
        main { flex: 1; }

        /* HEADER & NAVBAR */
        .top-line {
            width: 100%; height: 45px;
            background: linear-gradient(to bottom, #39AE1F, #8CFF00);
            position: relative; z-index: 99;
        }
        header { padding: 15px 0; background: white; border-bottom: 1px solid #eee; }
        .navbar { display: flex; justify-content: space-between; align-items: center; }
        .logo-area img { height: 70px; }
        nav ul { display: flex; list-style: none; gap: 25px; margin: 0; padding: 0; }
        nav ul li a { text-decoration: none; color: #555; font-weight: 800; font-size: 14px; text-transform: uppercase; }
        nav ul li a.active, nav ul li a:hover { color: #44AD24; border-bottom: 3px solid #44AD24; }
        .user-profile i { font-size: 35px; color: #4CAF50; }

        /* HERO SLIDER */
        .hero { margin-top: 30px; position: relative; }
        .promo-banner { 
            border-radius: 50px; display: flex; padding: 40px; color: white; 
            align-items: center; position: relative; overflow: hidden;
            min-height: 350px;
        }
        .promo-slide { display: none; width: 100%; }
        .promo-slide.active { display: flex; animation: fadeIn 0.5s; }

        .promo-img-wrapper { 
            background: white; padding: 25px; border-radius: 40px; 
            flex: 0 0 300px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); position: relative;
        }
        .promo-img-wrapper img { width: 100%; transform: rotate(2deg); }
        
        /* Badge Diskon Merah */
        .discount-badge {
            position: absolute; top: -10px; left: -10px;
            background: #ef4444; color: white; width: 50px; height: 50px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 900; border: 3px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .promo-text { padding: 0 50px; flex: 1; }
        .promo-text h1 { font-size: 40px; font-weight: 900; color: #ffeb3b; margin: 0 0 15px 0; text-transform: uppercase; font-style: italic; }
        .promo-text p { font-size: 14px; line-height: 1.6; opacity: 0.9; }

        .right-box { text-align: right; flex: 0 0 220px; }
        .old-price { text-decoration: line-through; color: #fecaca; font-size: 24px; font-weight: bold; display: block; }
        .new-price { font-size: 36px; font-weight: 900; color: #ffeb3b; display: block; }

        .slide-arrow { 
            position: absolute; top: 50%; transform: translateY(-50%); 
            background: white; width: 45px; height: 45px; border-radius: 50%; 
            border: none; cursor: pointer; z-index: 101; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .arrow-left { left: -15px; }
        .arrow-right { right: -15px; }

        /* RECOMMENDATION */
        .recommendation { padding: 60px 0; }
        .recommendation h2 { font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #666; margin-bottom: 40px; }
        .card-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .card { 
            border: 2px solid #f3f4f6; border-radius: 40px; padding: 30px; 
            transition: 0.3s; background: white;
        }
        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        .card img { width: 100%; height: 200px; object-fit: contain; margin-bottom: 20px; }
        .card h3 { font-weight: 800; font-size: 20px; margin: 10px 0; }
        .card a { color: #4CAF50; text-decoration: none; font-weight: 800; text-transform: lowercase; font-style: italic; }

        /* FOOTER */
        footer { padding: 50px 0 0 0; background: white; margin-top: 50px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; align-items: start; }
        .footer-links h4, .footer-social h4 { font-weight: 900; margin-bottom: 20px; }
        .footer-links a { color: #333; text-decoration: none; display: block; margin-bottom: 10px; font-weight: bold; }
        .footer-links a:hover { color: #44AD24; }
        .footer-logo img { height: 90px; opacity: 0.4; filter: grayscale(1); }
        .social-icons { display: flex; justify-content: flex-start; gap: 20px; font-size: 30px; }
        .pattern-bg { 
            height: 100px; margin-top: 30px;
            background-color: #fffbeb; 
            background-image: radial-gradient(#fde047 20%, transparent 20%); 
            background-size: 30px 30px; 
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body>

<div class="top-line"></div>

<header>
    <div class="container navbar">
        <div class="logo-area">
            <img src="{{ asset('image/Logo.png') }}" alt="Logo Barbar">
        </div>
        <nav>
            <ul>
                <li><a href="/" class="active">Home</a></li>
                <li><a href="/menu">Menu</a></li>
                <li><a href="/outlet">Outlet</a></li>
                <!-- HURUF A SUDAH DIJADIKAN KECIL -->
                <li><a href="/about">About Us</a></li>
                <li><a href="/contact">Contact Us</a></li>
            </ul>
        </nav>
        <div class="user-profile">
            <a href="/profile">
                <i class="fas fa-circle-user text-green-500 hover:scale-110 transition duration-300 cursor-pointer"></i>
            </a>
        </div>
    </div>
</header>

<main>
    <section class="hero container">
        <div class="promo-slider-container">
            {{-- Loop data dari tabel 'products' --}}
            @foreach($products as $index => $item)
            <div class="promo-slide js-slide {{ $index == 0 ? 'active' : '' }}">
                <div class="promo-banner" style="background-color: {{ $item->warna_bg }};">
                    <div class="promo-img-wrapper">
                        <div class="discount-badge text-center"><i class="fas fa-percent"></i></div>
                        <img src="{{ asset('image/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    </div>
                    <div class="promo-text">
                        <h1>{{ $item->nama }}</h1>
                        <p>{{ $item->deskripsi }}</p>
                    </div>
                    <div class="right-box">
                        <span class="old-price">Rp. {{ number_format($item->harga_lama, 0, ',', '.') }}</span>
                        <span class="new-price">Rp. {{ number_format($item->harga_baru, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endforeach

            <button class="slide-arrow arrow-left" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
            <button class="slide-arrow arrow-right" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <section class="recommendation container">
        <h2>Recommendation</h2>
        <div class="card-container">
            {{-- Loop data dari tabel 'recommendations' --}}
            @foreach($recommendations as $rec)
            <div class="card">
                <img src="{{ asset('image/' . $rec->gambar) }}" alt="{{ $rec->nama }}">
                <h3>{{ $rec->nama }}</h3>
                <a href="/detail/{{ $rec->id }}">details</a>
            </div>
            @endforeach
        </div>
    </section>
</main>

<footer>
    <div class="container footer-grid">
        <div class="footer-links">
            <h4>LINKS</h4>
            <!-- LINK FOOTER SUDAH DIPERBAIKI BISA DIKLIK -->
            <a href="/about">About Us</a>
            <a href="/contact">Contact Us</a>
        </div>
        <div class="footer-logo">
            <img src="{{ asset('image/Logo.png') }}" alt="Footer Logo">
        </div>
        <div class="footer-social">
            <h4>FOLLOW US</h4>
            <div class="social-icons">
                <i class="fab fa-instagram" style="color: #E1306C; cursor: pointer;"></i>
                <i class="fab fa-tiktok" style="color: #000000; cursor: pointer;"></i>
                <i class="fab fa-whatsapp" style="color: #25D366; cursor: pointer;"></i>
            </div>
        </div>
    </div>
    <div class="pattern-bg"></div>
</footer>

<script>
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.js-slide');

    function changeSlide(direction) {
        if (slides.length <= 1) return;
        slides[currentSlideIndex].classList.remove('active');
        currentSlideIndex = (currentSlideIndex + direction + slides.length) % slides.length;
        slides[currentSlideIndex].classList.add('active');
    }
</script>

</body>
</html>
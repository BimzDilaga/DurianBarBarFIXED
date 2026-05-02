<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Bar Es Duren - Landing Page</title>
    <!-- WAJIB ADA TAILWIND BIAR GAK MENCENG & KONSISTEN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>


    /* HEADER & NAVBAR */
    .top-line {
        width: 100%; 
        height: 45px;
        /* Tekstur di atas, warna gradasi di bawah */
        background-image: 
            url("{{ asset('image/texture.png') }}"), 
            linear-gradient(to bottom, #39AE1F, #8CFF00);
        /* Biar teksturnya berulang menuhin kotak */
        background-repeat: repeat; 
        
        /* 🔥 PRO-TIP: Kalau tekstur kamu background-nya putih (bukan transparan), 
           nyalakan kodingan di bawah ini biar warnanya menyatu (blend) sama gradasi hijau! */
        /* background-blend-mode: multiply; */
        
        position: relative; 
        z-index: 99;
    }

        body {
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff; color: #333;
            overflow-x: hidden; /* Ini jurus ampuh biar halaman ga bisa geser menceng ke samping */
        }
        main { flex: 1; }

        /* HERO SLIDER BAWAANMU */
        .hero { margin-top: 30px; position: relative; max-width: 1100px; margin-left: auto; margin-right: auto; padding: 0 20px;}
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
        .recommendation { padding: 60px 0; max-width: 1100px; margin-left: auto; margin-right: auto; padding-left: 20px; padding-right: 20px;}
        .recommendation h2 { font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #666; margin-bottom: 40px; }
        .card-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .card { 
            border: 2px solid #f3f4f6; border-radius: 40px; padding: 30px; 
            transition: 0.3s; background: white; text-align: center;
        }
        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        .card img { width: 100%; height: 200px; object-fit: contain; margin-bottom: 20px; }
        .card h3 { font-weight: 800; font-size: 20px; margin: 10px 0; }
        .card a { color: #4CAF50; text-decoration: none; font-weight: 800; text-transform: lowercase; font-style: italic; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="bg-white">

    <!-- TOP LINE HIJAU YANG UDAH DIBENERIN -->
    <!-- TOP LINE HIJAU TEKSTUR -->
    <div class="top-line"></div>

    <!-- NAVBAR (KONSISTEN SAMA HALAMAN DETAIL) -->
    <nav class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center w-full">
        <img src="{{ asset('image/logo.png') }}" alt="Bar Bar Es Duren" class="h-16">
        
        <ul class="hidden md:flex gap-8 text-gray-800 font-black text-xs uppercase tracking-wider">
            <li><a href="/" class="text-yellow-500 hover:text-yellow-500">Home</a></li>
            <li><a href="/menu" class="hover:text-yellow-500">Menu</a></li>
            <li><a href="/outlet" class="hover:text-yellow-500">Outlet</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
        </ul>

        <div class="text-[#39AE1F] text-4xl">
            <a href="/profile" class="hover:scale-110 transition duration-300 inline-block">
                <i class="fas fa-user-circle"></i>
            </a>
        </div>
    </nav>

    <main>
       <!-- HERO SLIDER IMPROVED -->
<section class="hero">
    <div class="promo-slider-container">
        @foreach($products as $index => $item)
        <div class="promo-slide js-slide {{ $index == 0 ? 'active' : '' }}">
            <!-- Banner Utama -->
            <div class="promo-banner" style="background-color: {{ $item->warna_bg }};">
                
                <!-- SISI KIRI: Gambar Produk -->
                <div class="promo-img-wrapper">
                    <!-- Badge Persen (Menggunakan percent.png) -->
                    <div class="discount-badge">
                        <img src="{{ asset('image/percent.png') }}" alt="Discount" class="w-full h-full object-contain">
                    </div>
                    <!-- Foto Produk Asli -->
                    <img src="{{ asset('image/' . $item->gambar) }}" alt="{{ $item->nama }}">
                </div>

                <!-- TENGAH: Deskripsi -->
                <div class="promo-text">
                    <h1>{{ $item->nama }}</h1>
                    <p>{{ $item->deskripsi }}</p>
                </div>

                <!-- SISI KANAN: Promo & Harga -->
                <div class="right-box flex flex-col items-center justify-center gap-2">
                    <h2 class="text-white text-3xl font-black italic tracking-tighter uppercase">PROMO</h2>
                    
                    <div class="flex items-center gap-3">
                        <!-- Badge Persen Ekstra di Samping Harga -->
                        <div class="w-16 h-16 bg-white rounded-2xl p-2 flex items-center justify-center shadow-lg">
                             <img src="{{ asset('image/percent.png') }}" alt="Percent" class="w-full h-full object-contain">
                        </div>
                        
                        <div class="text-left">
                            <span class="old-price text-red-100 line-through text-xl opacity-80">
                                Rp. {{ number_format($item->harga_lama, 0, ',', '.') }}
                            </span>
                            <span class="new-price text-[#ffeb3b] text-4xl font-black block leading-none">
                                Rp. {{ number_format($item->harga_baru, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach

        <!-- Tombol Navigasi Slider -->
        <button class="slide-arrow arrow-left" onclick="changeSlide(-1)">
            <i class="fas fa-arrow-left text-gray-600"></i>
        </button>
        <button class="slide-arrow arrow-right" onclick="changeSlide(1)">
            <i class="fas fa-arrow-right text-gray-600"></i>
        </button>

        <!-- Dots Indicator -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
            @foreach($products as $i => $p)
                <div class="w-3 h-3 rounded-full {{ $i == 0 ? 'bg-gray-400' : 'bg-gray-200' }}"></div>
            @endforeach
        </div>
    </div>
</section>

        <!-- RECOMMENDATION -->
        <section class="recommendation">
            <h2>Recommendation</h2>
            <div class="card-container">
                @foreach($recommendations as $rec)
                <div class="card">
                    <img src="{{ asset('image/' . $rec->gambar) }}" alt="{{ $rec->nama }}">
                    <h3>{{ $rec->nama }}</h3>
                    
                    <!-- LOGIC LINK DETAILS YANG BENAR -->
                    @php
                        $realProduct = \App\Models\Product::where('nama', $rec->nama)->first();
                    @endphp
                    
                    @if($realProduct)
                        <a href="/detail/{{ $realProduct->id }}">details</a>
                    @else
                        <a href="#">details (Produk Kosong)</a>
                    @endif
                    
                </div>
                @endforeach
            </div>
        </section>
    </main>

<!-- FOOTER LOOPING PATTERN -->
    <footer class="w-full mt-20">
        <!-- Div ini yang bakal nge-loop gambar footer.png kamu -->
        <div style="
            width: 100%; 
            height: 150px; /* Atur tinggi ini sesuai kebutuhan desainmu */
            background-image: url('{{ asset('image/footer.png') }}');
            background-repeat: repeat-x; /* Ini kuncinya biar looping ke samping */
            background-size: contain; /* Biar gambarnya nggak pecah dan tetep proporsional */
            background-position: bottom;
        "></div>
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
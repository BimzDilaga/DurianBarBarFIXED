<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Bar Es Duren - Landing Page</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ================= LOADING SCREEN ANIMATION ================= */
        #loading-screen {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: white; z-index: 9999;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s;
        }

        .loader-logo { width: 150px; margin-bottom: 30px; animation: bounce 1.5s infinite ease-in-out; }
        .progress-container { width: 250px; height: 10px; background-color: #f3f4f6; border-radius: 20px; overflow: hidden; position: relative; border: 2px solid #39AE1F; }
        .progress-bar { height: 100%; width: 0%; background: linear-gradient(to right, #39AE1F, #8CFF00); transition: width 0.3s ease; }
        .loading-text { margin-top: 15px; font-weight: 900; color: #39AE1F; font-size: 18px; font-style: italic; }
        @keyframes bounce { 0%, 100% { transform: translateY(0) scale(1); } 50% { transform: translateY(-20px) scale(1.1); } }
        .loaded #loading-screen { opacity: 0; visibility: hidden; }

        /* ================= PENGATURAN UMUM ================= */
        body {
            display: flex; flex-direction: column; min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff; color: #000000;
            overflow-x: hidden; 
        }

        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; position: relative; z-index: 100;
        }
        .logo-glow { position: relative; display: flex; align-items: center; justify-content: center; }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }

        .nav-link { position: relative; padding-bottom: 4px; }
        .nav-link::after {
            content: ''; position: absolute; width: 0; height: 3px; bottom: 0; left: 50%;
            background-color: #39AE1F; transition: width 0.3s ease, left 0.3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; left: 0; }

        /* ================= PROMO HERO ================= */
        .hero { margin-top: 30px; position: relative; max-width: 1100px; margin-left: auto; margin-right: auto; padding: 0 20px; }
        .promo-slider-container { overflow: hidden; width: 100%; position: relative; padding-bottom: 20px; }
        .promo-slider-track { display: flex; transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1); width: 100%; }
        .promo-slide { min-width: 100%; display: flex; justify-content: center; }
        .promo-banner { border-radius: 50px; display: flex; padding: 40px; align-items: center; position: relative; overflow: hidden; min-height: 380px; border: 4px solid #f3f4f6; width: 100%; }

        .bg-original { background-color: #A3D133; background-image: url("{{ asset('image/bg-durian.png') }}"); background-size: cover; }
        .bg-teler    { background-color: #39AE1F; background-image: url("{{ asset('image/bg-awan.png') }}"); background-size: cover; }
        .bg-mie { background-image: linear-gradient(to right, rgba(163, 209, 51, 0.95), rgba(57, 174, 31, 0.85)), url("{{ asset('image/bg-mieayam.png') }}"); background-size: cover; background-position: center; }

        .promo-img-wrapper { flex: 0 0 320px; height: 320px; position: relative; }
        .promo-img-box { background: white; border-radius: 35px; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(0,0,0,0.1); position: relative; overflow: hidden; transform: translateZ(0); }
        .promo-img-box img.product-img { width: 85%; height: 85%; object-fit: contain; position: relative; z-index: 10; }
        .promo-img-box img.watermark-logo { position: absolute; width: 95%; height: auto; opacity: 0.12; z-index: 0; pointer-events: none; object-fit: contain; }
        .discount-badge-top { position: absolute; top: -15px; left: -15px; background: #ef4444; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 900; border: 4px solid white; z-index: 20; }

        .promo-text { padding: 0 40px; flex: 1; }
        .promo-text h1 { font-size: 40px; font-weight: 900; margin-bottom: 12px; text-transform: uppercase; font-style: italic; letter-spacing: -1.5px; }
        .promo-text p { font-size: 15px; line-height: 1.7; font-weight: 500; color: #2d2d2d; text-align: justify; }

        .promo-section-right { display: flex; align-items: center; gap: 15px; flex: 0 0 320px; justify-content: flex-end; }
        .white-promo-box { background: white; padding: 15px; border-radius: 25px; display: flex; align-items: center; justify-content: center; width: 90px; height: 90px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .price-container { display: flex; flex-direction: column; align-items: flex-start; }
        .promo-label { font-size: 28px; font-weight: 900; color: #ef4444; font-style: italic; line-height: 1; letter-spacing: -0.5px; }
        .old-price { position: relative; color: #5a575a; font-size: 24px; font-weight: 800; display: inline-block; letter-spacing: -0.5px; }
        .old-price::after { content: ""; position: absolute; left: 0; top: 55%; width: 100%; height: 3px; background-color: #ef4444; transform: translateY(-50%); }
        .new-price { font-size: 42px; font-weight: 900; color: #FFD429; line-height: 1; margin-top: 3px; white-space: nowrap; text-shadow: 2px 2px 0px #000000; letter-spacing: -1px; }

        .slide-arrow { position: absolute; top: 50%; transform: translateY(-50%); background: white; width: 45px; height: 45px; border-radius: 50%; z-index: 101; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .arrow-left { left: -15px; }
        .arrow-right { right: -15px; }

        h1, h2, h3, h4, .promo-label, .new-price, .old-price, .loading-text, .discount-badge-top { font-family: 'Outfit', sans-serif !important; }
        body, p, a, span, nav, button, div { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-white">

    <div id="loading-screen">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="loader-logo">
        <div class="progress-container"><div class="progress-bar" id="bar"></div></div>
        <div class="loading-text" id="percent">0%</div>
    </div>

    <div class="top-line"></div>

    <header class="sticky top-0 bg-white/95 backdrop-blur-md py-4 shadow-sm border-b border-gray-100 z-50 transition duration-300">
        <div class="container mx-auto max-w-7xl px-6 flex justify-between items-center">
            
            <div class="logo-glow">
                <a href="/" class="block transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[80px] md:h-[90px] object-contain">
                </a>
            </div>

            <nav class="hidden md:block">
                <ul class="flex space-x-10 text-[15px] font-[900] text-zinc-700 uppercase tracking-wider">
                    <li><a href="/" class="nav-link text-[#39AE1F] active">Home</a></li>
                    <li><a href="/menu" class="nav-link hover:text-[#39AE1F] transition duration-300">Menu</a></li>
                    <li><a href="/outlet" class="nav-link hover:text-[#39AE1F] transition duration-300">Outlet</a></li>
                    <li><a href="/about" class="nav-link hover:text-[#39AE1F] transition duration-300">About Us</a></li>
                    <li><a href="/contact" class="nav-link hover:text-[#39AE1F] transition duration-300">Contact Us</a></li>
                </ul>
            </nav>
            
            <div class="flex items-center gap-4 relative">
                
                <div class="relative">
                    <button id="cartBtn" class="group flex items-center justify-center p-2.5 rounded-full bg-gray-100 border border-gray-200 hover:bg-green-50 hover:border-green-200 shadow-sm transition duration-300 relative">
                        <i class="fas fa-shopping-cart text-[20px] text-gray-400 group-hover:text-[#39AE1F] transition duration-300"></i>
                        <span id="cartBadge" class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full border-2 border-white shadow-sm" style="display: none;">0</span>
                    </button>

                    <div id="cartDropdown" class="hidden absolute right-0 mt-3 w-[350px] bg-white rounded-2xl shadow-2xl border border-gray-100 z-[100] transform opacity-0 scale-95 transition-all duration-300 origin-top-right overflow-hidden">
                        <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <h3 class="font-[900] text-zinc-800 text-[15px] italic">Keranjang Saya</h3>
                            <span id="cartItemCount" class="text-xs font-bold text-gray-500">0 Item</span>
                        </div>
                        
                        <div id="cartItemsContainer" class="max-h-[250px] overflow-y-auto p-4 space-y-4"></div>

                        <div class="p-4 border-t border-gray-100 bg-white">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-[13px] font-[800] text-zinc-500">Subtotal:</span>
                                <span id="cartSubtotal" class="text-[18px] font-[900] text-[#39AE1F]">Rp 0</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <button type="button" onclick="window.location.href='/checkout'" class="block w-full bg-[#39AE1F] text-white text-center py-2.5 rounded-xl font-[900] uppercase tracking-wider text-[13px] hover:bg-green-700 transition shadow-md italic">
                                    Lanjut Checkout
                                </button>
                                <a href="/menu" class="block w-full bg-green-50 text-[#39AE1F] border border-[#39AE1F] text-center py-2 rounded-xl font-[800] uppercase tracking-wider text-[12px] hover:bg-[#39AE1F] hover:text-white transition italic">
                                    + Tambah Menu Lain
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-profile relative">
                    @auth
                        <a href="/profile" class="group flex items-center justify-center p-1 rounded-full bg-gradient-to-tr from-green-500 to-lime-400 shadow-md group hover:shadow-lg transition duration-300">
                            <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300 text-[#39AE1F] text-[42px]"></i>
                        </a>
                    @else
                        <a href="/login" class="group flex items-center justify-center p-1 rounded-full bg-gray-100 border border-gray-200 hover:bg-gray-200 shadow-sm transition duration-300">
                            <i class="fas fa-user-circle text-[42px] text-gray-400 group-hover:text-gray-500 transition duration-300"></i>
                        </a>
                    @endauth
                </div>

                <button id="menuBtn" class="block md:hidden text-gray-700 text-2xl focus:outline-none p-2 hover:text-[#39AE1F] transition">
                    <i class="fas fa-bars" id="menuIcon"></i>
                </button>
            </div>
        </div>

        <nav id="mobileMenu" class="hidden md:hidden bg-white w-full border-t border-gray-100 shadow-lg absolute top-full left-0 z-50">
            <ul class="flex flex-col text-[15px] font-[900] text-zinc-800 uppercase tracking-widest py-4">
                <li><a href="/" class="block px-8 py-3 bg-green-50 text-[#39AE1F] border-l-4 border-[#39AE1F]">Home</a></li>
                <li><a href="/menu" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">Menu</a></li>
                <li><a href="/outlet" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">Outlet</a></li>
                <li><a href="/about" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">About Us</a></li>
                <li><a href="/contact" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main class="relative flex-1 w-full overflow-hidden pb-12">
        
        <div class="absolute inset-y-0 left-0 w-[200px] xl:w-[350px] z-0 pointer-events-none hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" alt="Pohon Kiri" class="w-full h-full object-cover object-center opacity-90 scale-x-[-1]">
        </div>
        <div class="absolute inset-y-0 right-0 w-[200px] xl:w-[350px] z-0 pointer-events-none hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" alt="Pohon Kanan" class="w-full h-full object-cover object-center opacity-90">
        </div>

        <section class="hero relative z-10 pt-4">
            <div class="promo-slider-container">
                <div class="promo-slider-track" id="sliderTrack">
                    
                    <div class="promo-slide js-slide">
                        <div class="promo-banner bg-original">
                            <div class="promo-img-wrapper">
                                <div class="discount-badge-top" style="z-index: 20;"><img src="{{ asset('image/Percent.png') }}" class="w-10 h-10"></div>
                                <div class="promo-img-box">
                                    <img src="{{ asset('image/Logo.png') }}" class="watermark-logo" alt="Watermark"> 
                                    <img src="{{ asset('image/EsDurianOri.png') }}" class="product-img" alt="Es Durian Original" style="transform: translateY(-50px) scale(1.2);">
                                </div>
                            </div>
                            <div class="promo-text">
                                <h1 class="text-[#39AE1F]">Es Durian Original</h1>
                                <p>Nikmati kemurnian rasa durian pilihan dengan tekstur yang sangat lembut and manis alami yang bikin nagih terus. Segar, Manis, Bikin Bahagia.</p>
                            </div>
                            <div class="promo-section-right">
                                <div class="white-promo-box"><img src="{{ asset('image/Percent.png') }}" class="w-14 h-14 object-contain"></div>
                                <div class="price-container">
                                    <span class="promo-label">PROMO</span>
                                    <span class="old-price">Rp.20.000</span>
                                    <span class="new-price">Rp.15.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="promo-slide js-slide">
                        <div class="promo-banner bg-teler">
                            <div class="promo-img-wrapper">
                                <div class="discount-badge-top" style="z-index: 20;"><img src="{{ asset('image/Percent.png') }}" class="w-10 h-10"></div>
                                <div class="promo-img-box">
                                    <img src="{{ asset('image/Logo.png') }}" class="watermark-logo" alt="Watermark">
                                    <img src="{{ asset('image/es teler home.png') }}" class="product-img" alt="Es Teler Durian" style="transform: translateY(-35px) scale(1.2);">
                                </div>
                            </div>
                            <div class="promo-text">
                                <h1 class="text-[#39AE1F]">Es Teler Durian</h1>
                                <p>Rasakan sensasi mewahnya durian asli berpadu dengan lembutnya alpukat segar, warna-warni jelly manis, dan susu kental gurih yang lumer di lidah.</p>
                            </div>
                            <div class="promo-section-right">
                                <div class="white-promo-box"><img src="{{ asset('image/Percent.png') }}" class="w-14 h-14 object-contain"></div>
                                <div class="price-container">
                                    <span class="promo-label">PROMO</span>
                                    <span class="old-price">Rp.25.000</span>
                                    <span class="new-price">Rp.20.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="promo-slide js-slide">
                        <div class="promo-banner bg-mie">
                            <div class="promo-img-wrapper">
                                <div class="discount-badge-top" style="z-index: 20;"><img src="{{ asset('image/Percent.png') }}" class="w-10 h-10"></div>
                                <div class="promo-img-box">
                                    <img src="{{ asset('image/Logo.png') }}" class="watermark-logo" alt="Watermark">
                                    <img src="{{ asset('image/MieAyamJamur.png') }}" class="product-img" alt="Mie Ayam Bakso" style="transform: translateY(-15px) scale(0.8);">
                                </div>
                            </div>
                            <div class="promo-text">
                                <h1 class="text-[#FFD429]">Mie Ayam Jamur</h1>
                                <p>Mie kuning lembut disajikan dengan potongan ayam berbumbu kecap yang gurih, dipadukan dengan tumisan jamur tiram yang harum and lezat. Dilengkapi sawi hijau and kuah kaldu ayam hangat.</p>
                            </div>
                            <div class="promo-section-right">
                                <div class="white-promo-box"><img src="{{ asset('image/Percent.png') }}" class="w-14 h-14 object-contain"></div>
                                <div class="price-container">
                                    <span class="promo-label">PROMO </span>
                                    <span class="old-price">Rp.16.000</span>
                                    <span class="new-price">Rp.12.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <button class="slide-arrow arrow-left" onclick="changeSlide(-1)"><i class="fas fa-arrow-left text-gray-600"></i></button>
            <button class="slide-arrow arrow-right" onclick="changeSlide(1)"><i class="fas fa-arrow-right text-gray-600"></i></button>

            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-20">
                <div class="w-3 h-3 rounded-full cursor-pointer js-dot bg-black scale-125 shadow-md" onclick="goToSlide(0)"></div>
                <div class="w-3 h-3 rounded-full cursor-pointer js-dot bg-black/40" onclick="goToSlide(1)"></div>
                <div class="w-3 h-3 rounded-full cursor-pointer js-dot bg-black/40" onclick="goToSlide(2)"></div>
            </div>
        </section>

        @php
            $pUdangKeju     = \App\Models\Product::where('nama', 'like', '%Udang Keju%')->first();
            $pDawetJumbo    = \App\Models\Product::where('nama', 'like', '%Dawet Durian (Jumbo)%')->orWhere('nama', 'like', '%Dawet%Jumbo%')->first();
            $pMieBakso      = \App\Models\Product::where('nama', 'like', '%Mie Ayam Bakso%')->first();
            $pDurianCoklat  = \App\Models\Product::where('nama', 'like', '%Durian Coklat%')->first();
            $pTelerJumbo    = \App\Models\Product::where('nama', 'like', '%Teler Durian Jumbo%')->orWhere('nama', 'like', '%Teler%Jumbo%')->first();
            $pKentangGoreng = \App\Models\Product::where('nama', 'like', '%Kentang Goreng%')->first();
        @endphp

        <section class="recommendation mt-20 relative z-10">
            <h2 class="text-center font-[900] text-[36px] tracking-tighter text-zinc-800 uppercase italic">
                Our Recommendation
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-[1000px] mx-auto mt-12 px-6">
                
                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/' . ($pUdangKeju->gambar ?? 'UdangKeju.png')) }}" alt="{{ $pUdangKeju->nama ?? 'Udang Keju' }}" class="w-full h-52 object-cover mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-[900] text-[24px] tracking-tight text-zinc-800">{{ $pUdangKeju->nama ?? 'Udang Keju' }}</h3>
                        <p class="text-[#39AE1F] font-black text-lg my-1">Rp {{ number_format($pUdangKeju->harga_baru ?? 15000, 0, ',', '.') }}</p>
                        <div class="mt-auto pt-3 flex justify-between items-center">
                            <button onclick="addToCart('{{ $pUdangKeju->id ?? 17 }}', '{{ $pUdangKeju->nama ?? 'Udang Keju' }}', {{ $pUdangKeju->harga_baru ?? 15000 }}, '{{ asset('image/' . ($pUdangKeju->gambar ?? 'UdangKeju.png')) }}')" class="bg-[#39AE1F] text-white px-6 py-2.5 rounded-full font-[900] text-xs flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase tracking-wider italic cursor-pointer">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </button>
                            <a href="/detail/{{ $pUdangKeju->id ?? 17 }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/' . ($pDawetJumbo->gambar ?? 'DawetDurianJumbo.png')) }}" alt="{{ $pDawetJumbo->nama ?? 'Es Dawet Durian (Jumbo)' }}" class="w-full h-52 object-cover mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-[900] text-[24px] tracking-tight text-zinc-800 leading-tight">{{ $pDawetJumbo->nama ?? 'Es Dawet Durian (Jumbo)' }}</h3>
                        <p class="text-[#39AE1F] font-black text-lg my-1">Rp {{ number_format($pDawetJumbo->harga_baru ?? 15000, 0, ',', '.') }}</p>
                        <div class="mt-auto pt-3 flex justify-between items-center">
                            <button onclick="addToCart('{{ $pDawetJumbo->id ?? 12 }}', '{{ $pDawetJumbo->nama ?? 'Es Dawet Durian (Jumbo)' }}', {{ $pDawetJumbo->harga_baru ?? 15000 }}, '{{ asset('image/' . ($pDawetJumbo->gambar ?? 'DawetDurianJumbo.png')) }}')" class="bg-[#39AE1F] text-white px-6 py-2.5 rounded-full font-[900] text-xs flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase tracking-wider italic cursor-pointer">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </button>
                            <a href="/detail/{{ $pDawetJumbo->id ?? 12 }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/' . ($pMieBakso->gambar ?? 'mie ayam bakso.png')) }}" alt="{{ $pMieBakso->nama ?? 'Mie Ayam Bakso' }}" class="w-full h-52 object-cover object-bottom mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-[900] text-[24px] tracking-tight text-zinc-800">{{ $pMieBakso->nama ?? 'Mie Ayam Bakso' }}</h3>
                        <p class="text-[#39AE1F] font-black text-lg my-1">Rp {{ number_format($pMieBakso->harga_baru ?? 12000, 0, ',', '.') }}</p>
                        <div class="mt-auto pt-3 flex justify-between items-center">
                            <button onclick="addToCart('{{ $pMieBakso->id ?? 9 }}', '{{ $pMieBakso->nama ?? 'Mie Ayam Bakso' }}', {{ $pMieBakso->harga_baru ?? 12000 }}, '{{ asset('image/' . ($pMieBakso->gambar ?? 'mie ayam bakso.png')) }}')" class="bg-[#39AE1F] text-white px-6 py-2.5 rounded-full font-[900] text-xs flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase tracking-wider italic cursor-pointer">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </button>
                            <a href="/detail/{{ $pMieBakso->id ?? 9 }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/' . ($pDurianCoklat->gambar ?? 'EsDurianCoklat.png')) }}" alt="{{ $pDurianCoklat->nama ?? 'Es Durian Coklat' }}" class="w-full h-52 object-cover mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-[900] text-[24px] tracking-tight text-zinc-800">{{ $pDurianCoklat->nama ?? 'Es Durian Coklat' }}</h3>
                        <p class="text-[#39AE1F] font-black text-lg my-1">Rp {{ number_format($pDurianCoklat->harga_baru ?? 18000, 0, ',', '.') }}</p>
                        <div class="mt-auto pt-3 flex justify-between items-center">
                            <button onclick="addToCart('{{ $pDurianCoklat->id ?? 13 }}', '{{ $pDurianCoklat->nama ?? 'Es Durian Coklat' }}', {{ $pDurianCoklat->harga_baru ?? 18000 }}, '{{ asset('image/' . ($pDurianCoklat->gambar ?? 'EsDurianCoklat.png')) }}')" class="bg-[#39AE1F] text-white px-6 py-2.5 rounded-full font-[900] text-xs flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase tracking-wider italic cursor-pointer">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </button>
                            <a href="/detail/{{ $pDurianCoklat->id ?? 13 }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/' . ($pTelerJumbo->gambar ?? 'EsTelerJumbo.png')) }}" alt="{{ $pTelerJumbo->nama ?? 'Es Teler Durian Jumbo' }}" class="w-full h-52 object-cover mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-[900] text-[24px] tracking-tight text-zinc-800 leading-tight">{{ $pTelerJumbo->nama ?? 'Es Teler Durian Jumbo' }}</h3>
                        <p class="text-[#39AE1F] font-black text-lg my-1">Rp {{ number_format($pTelerJumbo->harga_baru ?? 20000, 0, ',', '.') }}</p>
                        <div class="mt-auto pt-3 flex justify-between items-center">
                            <button onclick="addToCart('{{ $pTelerJumbo->id ?? 14 }}', '{{ $pTelerJumbo->nama ?? 'Es Teler Durian Jumbo' }}', {{ $pTelerJumbo->harga_baru ?? 20000 }}, '{{ asset('image/' . ($pTelerJumbo->gambar ?? 'EsTelerJumbo.png')) }}')" class="bg-[#39AE1F] text-white px-6 py-2.5 rounded-full font-[900] text-xs flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase tracking-wider italic cursor-pointer">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </button>
                            <a href="/detail/{{ $pTelerJumbo->id ?? 14 }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/' . ($pKentangGoreng->gambar ?? 'KentangGoreng.png')) }}" alt="{{ $pKentangGoreng->nama ?? 'Kentang Goreng' }}" class="w-full h-52 object-cover mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-[900] text-[24px] tracking-tight text-zinc-800">{{ $pKentangGoreng->nama ?? 'Kentang Goreng' }}</h3>
                        <p class="text-[#39AE1F] font-black text-lg my-1">Rp {{ number_format($pKentangGoreng->harga_baru ?? 10000, 0, ',', '.') }}</p>
                        <div class="mt-auto pt-3 flex justify-between items-center">
                            <button onclick="addToCart('{{ $pKentangGoreng->id ?? 15 }}', '{{ $pKentangGoreng->nama ?? 'Kentang Goreng' }}', {{ $pKentangGoreng->harga_baru ?? 10000 }}, '{{ asset('image/' . ($pKentangGoreng->gambar ?? 'KentangGoreng.png')) }}')" class="bg-[#39AE1F] text-white px-6 py-2.5 rounded-full font-[900] text-xs flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase tracking-wider italic cursor-pointer">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </button>
                            <a href="/detail/{{ $pKentangGoreng->id ?? 15 }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer class="mt-8 relative z-30 bg-white border-t-4 border-[#FFD429]">
        <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 md:grid-cols-3 gap-6 items-start text-center md:text-left relative z-20">
            
            <div class="flex flex-col items-center space-y-3 order-2 md:order-1 mt-6 md:mt-0">
                <div class="flex flex-col items-start w-fit">
                    <h4 class="font-black text-lg uppercase text-black italic tracking-tight border-b-[3px] border-[#39AE1F] pb-1 inline-block mb-2">Menu Navigasi</h4>
                    <div class="flex flex-col space-y-1.5 w-full">
                        <a href="/" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Home</a>
                        <a href="/menu" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Menu & Kategori</a>
                        <a href="/outlet" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Lokasi Outlet</a>
                        <a href="/about" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> About Us</a>
                        <a href="/contact" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Contact Us</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center text-center space-y-3 order-1 md:order-2 border-b-2 md:border-b-0 pb-6 md:pb-0 border-gray-100">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="h-20 object-contain drop-shadow-md hover:scale-105 transition duration-300">
                <p class="text-gray-600 font-bold text-sm leading-snug max-w-xs mx-auto">
                    "Berkomitmen Menyajikan Kebahagiaan Lewat Setiap Mangkok Mie Ayam, Bakso, dan Aneka Cemilan Pilihan, Dipadukan dengan Keaslian Buah Durian Terbaik and Racikan Es Teler Khas yang Disajikan Secara Bar Bar Tanpa Batas!"
                </p>
            </div>
            
            <div class="flex flex-col items-center space-y-3 order-3 md:order-3 mt-6 md:mt-0">
                <div class="flex flex-col items-start w-fit">
                    <h4 class="font-black text-lg uppercase text-black italic tracking-tight border-b-[3px] border-[#39AE1F] pb-1 inline-block mb-2">Hubungi Kami</h4>
                    <div class="flex flex-col space-y-2 w-full max-w-xs text-[14px]">
                        <a href="https://wa.me/6285848182655" target="_blank" class="flex items-center justify-start gap-3 font-bold text-zinc-600 hover:text-[#25D366] transition duration-300 group bg-gray-50 p-1.5 rounded-xl border border-gray-100 shadow-sm">
                            <div class="bg-green-50 text-[#25D366] p-2 rounded-lg text-sm group-hover:bg-[#25D366] group-hover:text-white transition duration-300"><i class="fab fa-whatsapp"></i></div>
                            <div class="text-left">
                                <p class="text-[9px] text-zinc-400 uppercase tracking-widest font-black mb-0">WhatsApp CS</p>
                                <p class="text-[12px] font-black">0858-4818-2655</p>
                            </div>
                        </a>
                        
                        <a href="mailto:durianbarbarr@gmail.com" class="flex items-center justify-start gap-3 font-bold text-zinc-600 hover:text-red-500 transition duration-300 group bg-gray-50 p-1.5 rounded-xl border border-gray-100 shadow-sm">
                            <div class="bg-red-50 text-red-500 p-2 rounded-lg text-sm group-hover:bg-red-500 group-hover:text-white transition duration-300"><i class="fa-solid fa-envelope"></i></div>
                            <div class="text-left">
                                <p class="text-[9px] text-zinc-400 uppercase tracking-widest font-black mb-0">Email Support</p>
                                <p class="text-[12px] font-black">durianbarbarr@gmail.com</p>
                            </div>
                        </a>

                        <a href="https://instagram.com/dawetdurianbarbarpwt" target="_blank" class="flex items-center justify-start gap-3 font-bold text-zinc-600 hover:text-[#E1306C] transition duration-300 group bg-gray-50 p-1.5 rounded-xl border border-gray-100 shadow-sm">
                            <div class="bg-pink-50 text-[#E1306C] p-2 rounded-lg text-sm group-hover:bg-[#E1306C] group-hover:text-white transition duration-300"><i class="fa-brands fa-instagram"></i></div>
                            <div class="text-left">
                                <p class="text-[9px] text-zinc-400 uppercase tracking-wider font-black mb-0">Instagram</p>
                                <p class="text-[12px] font-black">@dawetdurianbarbarpwt</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="bg-[#39AE1F] text-center py-3 relative z-20 shadow-inner">
            <p class="font-bold text-white text-xs md:text-sm tracking-widest uppercase">
                &copy; {{ date('Y') }} <span class="text-[#FFD429] font-black italic">BAR BAR KULINER GROUP</span>. All Rights Reserved.
            </p>
        </div>

        <div class="relative z-10" style="width: 100%; height: 200px; background-image: url('{{ asset('image/footer.png') }}'); background-repeat: repeat-x; background-size: contain; background-position: bottom; margin-top: -10px;"></div>
    </footer>

    <script>
        window.addEventListener('load', () => {
            const bar = document.getElementById('bar');
            const percentText = document.getElementById('percent');
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        document.body.classList.add('loaded');
                        setTimeout(() => { document.getElementById('loading-screen').style.display = 'none'; }, 500);
                    }, 300);
                } else {
                    width += 5; bar.style.width = width + '%'; percentText.innerText = width + '%';
                }
            }, 30);
        });

        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.js-slide');
        const dots = document.querySelectorAll('.js-dot');
        const track = document.getElementById('sliderTrack');
        function updateSlider() {
            track.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
            dots.forEach((d) => { d.classList.replace('bg-black', 'bg-black/40'); d.classList.remove('scale-125'); });
            dots[currentSlideIndex].classList.replace('bg-black/40', 'bg-black'); dots[currentSlideIndex].classList.add('scale-125');
        }
        function changeSlide(d) { currentSlideIndex = (currentSlideIndex + d + slides.length) % slides.length; updateSlider(); }
        function goToSlide(i) { currentSlideIndex = i; updateSlider(); }

        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if (mobileMenu.classList.contains('hidden')) { menuIcon.classList.replace('fa-times', 'fa-bars'); } 
            else { menuIcon.classList.replace('fa-bars', 'fa-times'); }
        });

        // ==========================================
        // MESIN UTAMA KERANJANG (LOCAL STORAGE)
        // ==========================================
        let cartData = JSON.parse(localStorage.getItem('barbar_cart')) || [];

        function formatRupiah(angka) { return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }
        function saveCart() { localStorage.setItem('barbar_cart', JSON.stringify(cartData)); }

        const cartBtn = document.getElementById('cartBtn');
        const cartDropdown = document.getElementById('cartDropdown');

        if(cartBtn && cartDropdown) {
            cartBtn.addEventListener('click', (e) => {
                e.stopPropagation(); 
                if (cartDropdown.classList.contains('hidden')) {
                    cartDropdown.classList.remove('hidden');
                    setTimeout(() => {
                        cartDropdown.classList.remove('opacity-0', 'scale-95');
                        cartDropdown.classList.add('opacity-100', 'scale-100');
                    }, 10);
                } else {
                    cartDropdown.classList.remove('opacity-100', 'scale-100');
                    cartDropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => { cartDropdown.classList.add('hidden'); }, 300); 
                }
            });

            document.addEventListener('click', (e) => {
                if (!cartBtn.contains(e.target) && !cartDropdown.contains(e.target) && !cartDropdown.classList.contains('hidden')) {
                    cartDropdown.classList.remove('opacity-100', 'scale-100');
                    cartDropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => { cartDropdown.classList.add('hidden'); }, 300);
                }
            });
        }

        function renderCartHeader() {
            const container = document.getElementById('cartItemsContainer');
            if(!container) return;

            container.innerHTML = ''; 
            let totalHarga = 0; let totalBarang = 0;

            if (cartData.length === 0) {
                container.innerHTML = `<p class="text-center text-gray-400 text-xs py-4 font-bold">Keranjang masih kosong nih :(</p>`;
            } else {
                cartData.forEach((item, index) => {
                    totalHarga += item.price * item.qty;
                    totalBarang += item.qty;
                    container.innerHTML += `
                        <div class="flex gap-3 cart-item">
                            <img src="${item.img}" class="w-16 h-16 rounded-xl object-cover border border-gray-100 shadow-sm" alt="Item">
                            <div class="flex-1 flex flex-col justify-between py-0.5">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-[13px] font-[800] text-zinc-800 leading-tight">${item.name}</h4>
                                    <button type="button" onclick="removeItem(${index})" class="text-gray-300 hover:text-red-500 transition"><i class="fas fa-trash-alt text-[12px]"></i></button>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-[13px] font-[900] text-[#39AE1F]">${formatRupiah(item.price)}</span>
                                    <div class="flex items-center bg-gray-100 rounded-lg p-0.5">
                                        <button type="button" onclick="changeQty(${index}, -1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-md text-gray-600 hover:text-red-500 shadow-sm transition"><i class="fas fa-minus text-[10px]"></i></button>
                                        <span class="w-7 text-center text-[12px] font-bold text-zinc-800">${item.qty}</span>
                                        <button type="button" onclick="changeQty(${index}, 1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-md text-gray-600 hover:text-[#39AE1F] shadow-sm transition"><i class="fas fa-plus text-[10px]"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }
            document.getElementById('cartSubtotal').innerText = formatRupiah(totalHarga);
            document.getElementById('cartItemCount').innerText = totalBarang + ' Item';
            const badge = document.getElementById('cartBadge');
            badge.innerText = totalBarang;
            badge.style.display = totalBarang > 0 ? 'block' : 'none';
        }

        function addToCart(id, name, price, img) {
            const existingItem = cartData.find(item => item.id === id);
            if (existingItem) {
                existingItem.qty += 1; 
            } else {
                cartData.push({id, name, price, img, qty: 1}); 
            }
            saveCart(); renderCartHeader();
            if (cartDropdown && cartDropdown.classList.contains('hidden')) {
                cartDropdown.classList.remove('hidden');
                setTimeout(() => {
                    cartDropdown.classList.remove('opacity-0', 'scale-95');
                    cartDropdown.classList.add('opacity-100', 'scale-100');
                }, 10);
            }
        }

        function removeItem(index) {
            if(event) event.stopPropagation();
            cartData.splice(index, 1);
            saveCart(); renderCartHeader();
        }

        function changeQty(index, amount) {
            if(event) event.stopPropagation();
            if (cartData[index].qty + amount >= 1) {
                cartData[index].qty += amount;
                saveCart(); renderCartHeader();
            }
        }

        window.addEventListener('DOMContentLoaded', () => { renderCartHeader(); });
    </script>
</body>
</html>
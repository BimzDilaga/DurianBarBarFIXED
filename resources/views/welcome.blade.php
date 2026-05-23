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

        /* ================= ANIMASI DEKORASI POHON ================= */
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-100px) scaleX(-1); }
            to { opacity: 0.9; transform: translateX(0) scaleX(-1); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 0.9; transform: translateX(0); }
        }
        .tree-animate-left {
            animation: slideInLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            animation-delay: 0.5s; /* Mulai setelah loading screen hilang */
            opacity: 0; 
        }
        .tree-animate-right {
            animation: slideInRight 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            animation-delay: 0.5s; 
            opacity: 0;
        }
    </style>
</head>

<body class="bg-white">

    <div id="loading-screen">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="loader-logo">
        <div class="progress-container"><div class="progress-bar" id="bar"></div></div>
        <div class="loading-text" id="percent">0%</div>
    </div>

    <div class="top-line"></div>

    @if(session('error'))
        <div id="alert-box" class="fixed top-24 left-1/2 -translate-x-1/2 bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999] flex items-center gap-3 animate-bounce border-2 border-red-700">
            <i class="fas fa-exclamation-triangle text-2xl text-[#FFD429]"></i>
            <div>
                <p class="font-black uppercase tracking-widest text-xs opacity-80 m-0">System Notification</p>
                <p class="font-bold text-sm m-0">{{ session('error') }}</p>
            </div>
            <button onclick="document.getElementById('alert-box').style.display='none'" class="ml-4 text-white hover:text-gray-200 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
    @endif

    @include('components.navbar')

    <main class="relative flex-1 w-full overflow-hidden pb-12">
        
        <div class="absolute inset-y-0 left-0 w-[200px] xl:w-[350px] z-0 pointer-events-none hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" alt="Pohon Kiri" class="w-full h-full object-cover object-center tree-animate-left">
        </div>
        
        <div class="absolute inset-y-0 right-0 w-[200px] xl:w-[350px] z-0 pointer-events-none hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" alt="Pohon Kanan" class="w-full h-full object-cover object-center tree-animate-right">
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
                
                @php
                    // Mengambil data produk berdasarkan kata kunci utama agar lebih akurat
                    $pUdangKeju     = \App\Models\Product::where('nama', 'like', '%Udang%')->first();
                    $pDawetJumbo    = \App\Models\Product::where('nama', 'like', '%Dawet%')->first();
                    $pMieBakso      = \App\Models\Product::where('nama', 'like', '%Mie%')->first();
                    $pDurianCoklat  = \App\Models\Product::where('nama', 'like', '%Coklat%')->first();
                    $pTelerJumbo    = \App\Models\Product::where('nama', 'like', '%Teler%')->first();
                    $pKentangGoreng = \App\Models\Product::where('nama', 'like', '%Kentang%')->first();

                    // Diubah menjadi ->stock (disamakan dengan database halaman kategori yang berhasil)
                    $products_data = [
                        ['id' => $pUdangKeju?->id, 'nama' => $pUdangKeju?->nama, 'harga' => $pUdangKeju?->harga_baru, 'img' => $pUdangKeju?->gambar, 'stock' => $pUdangKeju?->stock],
                        ['id' => $pDawetJumbo?->id, 'nama' => $pDawetJumbo?->nama, 'harga' => $pDawetJumbo?->harga_baru, 'img' => $pDawetJumbo?->gambar, 'stock' => $pDawetJumbo?->stock],
                        ['id' => $pMieBakso?->id, 'nama' => $pMieBakso?->nama, 'harga' => $pMieBakso?->harga_baru, 'img' => $pMieBakso?->gambar, 'stock' => $pMieBakso?->stock],
                        ['id' => $pDurianCoklat?->id, 'nama' => $pDurianCoklat?->nama, 'harga' => $pDurianCoklat?->harga_baru, 'img' => $pDurianCoklat?->gambar, 'stock' => $pDurianCoklat?->stock],
                        ['id' => $pTelerJumbo?->id, 'nama' => $pTelerJumbo?->nama, 'harga' => $pTelerJumbo?->harga_baru, 'img' => $pTelerJumbo?->gambar, 'stock' => $pTelerJumbo?->stock],
                        ['id' => $pKentangGoreng?->id, 'nama' => $pKentangGoreng?->nama, 'harga' => $pKentangGoreng?->harga_baru, 'img' => $pKentangGoreng?->gambar, 'stock' => $pKentangGoreng?->stock],
                    ];
                @endphp

                @foreach($products_data as $index => $p)
                <div class="reveal-on-scroll opacity-0 translate-y-12 transition-all duration-700 ease-out bg-white p-6 hover:shadow-2xl hover:-translate-y-3 flex flex-col relative z-40 group" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    
                    <div class="overflow-hidden rounded-2xl mb-5 w-full relative">
                        <img src="{{ asset('image/' . $p['img']) }}" alt="{{ $p['nama'] }}" class="w-full h-52 object-cover transform transition-transform duration-500 group-hover:scale-110">
                        
                        {{-- Logika pengecekan diganti ke $p['stock'] --}}
                        @if($p['stock'] <= 0)
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center rounded-2xl">
                                <span class="bg-red-600 text-white font-black uppercase tracking-widest text-xs px-4 py-2 rounded-xl italic">Habis</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-[900] text-[24px] tracking-tight text-zinc-800">{{ $p['nama'] }}</h3>
                        <p class="text-[#39AE1F] font-black text-lg my-1">Rp {{ number_format($p['harga'], 0, ',', '.') }}</p>
                        
                        {{-- Badges indikator jumlah stok --}}
                        <div class="mb-4 flex items-center gap-1.5 text-xs font-bold">
                            <span class="text-zinc-400">Stok:</span>
                            @if($p['stock'] > 5)
                                <span class="text-zinc-600 bg-zinc-100 px-2 py-0.5 rounded-full">{{ $p['stock'] }} pcs</span>
                            @elseif($p['stock'] > 0)
                                <span class="text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full animate-pulse">Sisa {{ $p['stock'] }} pcs!</span>
                            @else
                                <span class="text-red-600 bg-red-50 px-2 py-0.5 rounded-full">Habis</span>
                            @endif
                        </div>
                        
                        <div class="mt-auto pt-3">
                            <div class="flex justify-center mb-2">
                                <a href="/detail/{{ $p['id'] }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] transition hover:opacity-75">Details</a>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                @if($p['stock'] > 0)
                                    <button type="button" onclick="addToCart('{{ $p['id'] }}', '{{ $p['nama'] }}', {{ $p['harga'] }}, '{{ asset('image/' . $p['img']) }}')" class="bg-[#39AE1F] text-white px-2 py-1.5 rounded-full font-bold text-[10px] flex items-center justify-center gap-1 hover:bg-green-700 transition shadow-sm uppercase tracking-tighter truncate">
                                        <i class="fas fa-shopping-cart text-[9px]"></i> Keranjang
                                    </button>
                                    <a href="{{ url('/checkout') }}?action=buy_now&product_id={{ $p['id'] }}" class="bg-[#FFD429] text-gray-800 px-2 py-1.5 rounded-full font-bold text-[10px] flex items-center justify-center gap-1 hover:bg-orange-500 hover:text-white transition-all duration-300 shadow-sm uppercase tracking-tighter truncate">
                                        <i class="fas fa-bolt text-[9px]"></i> Checkout
                                    </a>
                                @else
                                    <button type="button" disabled class="bg-gray-200 text-gray-400 px-2 py-1.5 rounded-full font-bold text-[10px] flex items-center justify-center gap-1 cursor-not-allowed uppercase tracking-tighter truncate">
                                        <i class="fas fa-shopping-cart text-[9px]"></i> Keranjang
                                    </button>
                                    <button type="button" disabled class="bg-gray-100 text-gray-400 px-2 py-1.5 rounded-full font-bold text-[10px] flex items-center justify-center gap-1 cursor-not-allowed uppercase tracking-tighter truncate">
                                        <i class="fas fa-ban text-[9px]"></i> Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

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
        // 1. LOGIKA LOADING BAR
        window.addEventListener('load', () => {
            const bar = document.getElementById('bar');
            const percentText = document.getElementById('percent');
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        document.body.classList.add('loaded');
                        setTimeout(() => { 
                            const loadingScreen = document.getElementById('loading-screen');
                            if(loadingScreen) loadingScreen.style.display = 'none'; 
                        }, 500);
                    }, 300);
                } else {
                    width += 5; 
                    if(bar) bar.style.width = width + '%'; 
                    if(percentText) percentText.innerText = width + '%';
                }
            }, 30);
        });

        // 2. LOGIKA SLIDER PROMO (HERO)
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.js-slide');
        const dots = document.querySelectorAll('.js-dot');
        const track = document.getElementById('sliderTrack');
        
        function updateSlider() {
            if(!track) return;
            track.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
            dots.forEach((d) => { d.classList.replace('bg-black', 'bg-black/40'); d.classList.remove('scale-125'); });
            if(dots[currentSlideIndex]) {
                dots[currentSlideIndex].classList.replace('bg-black/40', 'bg-black'); 
                dots[currentSlideIndex].classList.add('scale-125');
            }
        }
        
        function changeSlide(d) { 
            if(slides.length > 0) {
                currentSlideIndex = (currentSlideIndex + d + slides.length) % slides.length; 
                updateSlider(); 
            }
        }
        
        function goToSlide(i) { 
            currentSlideIndex = i; 
            updateSlider(); 
        }

        // 3. LOGIKA ANIMASI SCROLL (INTERSECTION OBSERVER)
        document.addEventListener("DOMContentLoaded", function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 // Animasi mulai saat 15% dari kartu terlihat
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        // Menambahkan delay halus antar kartu agar muncul bergantian (staggered effect)
                        setTimeout(() => {
                            entry.target.classList.remove('opacity-0', 'translate-y-12');
                            entry.target.classList.add('opacity-100', 'translate-y-0');
                        }, index * 150); 
                        
                        // Stop mengawasi elemen yang sudah dianimasikan
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Terapkan observer ke semua kartu produk
            const cards = document.querySelectorAll('.reveal-on-scroll');
            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
    
    @include('components.cart-script')
</body>
</html>
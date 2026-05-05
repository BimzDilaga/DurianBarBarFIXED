<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Bar Es Duren - Landing Page</title>
    
    <!-- ================= LIBRARY & FONTS ================= -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- ================= CUSTOM CSS ================= -->
    <style>
        /* 1. PENGATURAN UMUM */
        body {
            display: flex; flex-direction: column; min-height: 100vh;
            font-family: 'Montserrat', sans-serif; 
            background-color: #ffffff; color: #000000;
            overflow-x: hidden; 
        }
        main { flex: 1; }

        /* 2. TOP BAR & LOGO GLOW */
        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; position: relative; z-index: 99;
        }
        .logo-glow {
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }

        /* 3. HERO SLIDER BANNER */
        .hero { 
            margin-top: 30px; position: relative; max-width: 1100px; 
            margin-left: auto; margin-right: auto; padding: 0 20px;
        }
        .promo-banner { 
            border-radius: 50px; display: flex; padding: 40px; 
            align-items: center; position: relative; overflow: hidden; min-height: 380px;
            border: 4px solid #f3f4f6; 
        }
        .promo-slide { display: none; width: 100%; position: relative; z-index: 10; }
        .promo-slide.active { display: flex; animation: fadeIn 0.5s; }

        /* Background Motif Banner */
        .bg-original { background-color: #A3D133; background-image: url("{{ asset('image/bg-durian.png') }}"); background-size: cover; }
        .bg-teler    { background-color: #39AE1F; background-image: url("{{ asset('image/bg-awan.png') }}"); background-size: cover; }
        
        /* ================= INI YANG DIUBAH ================= */
        /* bg-mie diberi efek gradasi transparan ala slide 1 & 2 biar gambar mie di belakangnya pudar elegan */
        .bg-mie { 
            background-image: linear-gradient(to right, rgba(163, 209, 51, 0.95), rgba(57, 174, 31, 0.85)), url("{{ asset('image/bg-mieayam.png') }}"); 
            background-size: cover; 
            background-position: center;
        }
        /* =================================================== */

        /* ================= BAGIAN GAMBAR BANNER (KANDANG GANDA) ================= */
        .promo-img-wrapper { 
            flex: 0 0 320px; height: 320px; 
            position: relative; /* Tempat nempelnya lencana diskon */
        }
        .promo-img-box {
            background: white; border-radius: 35px; 
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            position: relative;
            overflow: hidden; /* Klip gambar cup/logo yang mbleber */
            transform: translateZ(0); /* Trik biar nggak ngebug di browser */
        }
        .promo-img-box img.product-img { 
            width: 85%; height: 85%; object-fit: contain; position: relative; z-index: 10; 
        }
        .promo-img-box img.watermark-logo {
            position: absolute; width: 95%; height: auto; opacity: 0.12; z-index: 0; pointer-events: none; object-fit: contain;
        }
        .discount-badge-top {
            position: absolute; top: -15px; left: -15px; 
            background: #ef4444; color: white; width: 60px; height: 60px; 
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 900; border: 4px solid white; z-index: 20;
        }
        /* ==================================================================== */

        /* Teks Banner */
        .promo-text { padding: 0 40px; flex: 1; }
        .promo-text h1 { font-size: 38px; font-weight: 900; margin-bottom: 10px; text-transform: uppercase; font-style: italic; letter-spacing: -1px; }
        .promo-text p { font-size: 14px; line-height: 1.6; font-weight: 700; color: #333333; text-align: justify; }

        /* Harga Banner */
        .promo-section-right { display: flex; align-items: center; gap: 15px; flex: 0 0 320px; justify-content: flex-end; }
        .white-promo-box {
            background: white; padding: 15px; border-radius: 25px;
            display: flex; align-items: center; justify-content: center;
            width: 90px; height: 90px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .price-container { display: flex; flex-direction: column; align-items: flex-start; }
        .promo-label { font-size: 28px; font-weight: 900; color: #ef4444; font-style: italic; line-height: 1; }
        .old-price { 
            position: relative; color: #6d6a6d; font-size: 24px; font-weight: 800; display: inline-block;
        }
        .old-price::after {
            content: ""; position: absolute; left: 0; top: 55%; width: 100%; height: 3px; 
            background-color: #ef4444; transform: translateY(-50%);
        }
        .new-price { 
            font-size: 38px; font-weight: 900; color: #FFD429; line-height: 1; margin-top: 5px; 
            white-space: nowrap; text-shadow: 2px 2px 0px #000000; 
        }

        /* Navigasi Panah Slider */
        .slide-arrow { 
            position: absolute; top: 50%; transform: translateY(-50%); 
            background: white; width: 45px; height: 45px; border-radius: 50%; 
            z-index: 101; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .arrow-left { left: -15px; }
        .arrow-right { right: -15px; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>

<body class="bg-white">

    <!-- =======================================================
         GARIS TEKSTUR ATAS
         ======================================================= -->
    <div class="top-line"></div>


    <!-- =======================================================
         HEADER / NAVBAR SECTON
         ======================================================= -->
    <header class="bg-white py-6 relative z-30">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            
            <!-- Logo -->
            <div class="logo-glow">
                <a href="/"><img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[100px] object-contain"></a>
            </div>

            <!-- Menu Navigasi Tengah -->
            <nav class="hidden md:block">
                <ul class="flex space-x-12 text-[18px] font-[900] text-gray-800 uppercase tracking-tight">
                    <li><a href="/" class="text-[#39AE1F] border-b-4 border-[#39AE1F] pb-1">Home</a></li>
                    <li><a href="/menu" class="hover:text-[#39AE1F] transition">Menu</a></li>
                    <li><a href="/outlet" class="hover:text-[#39AE1F] transition">Outlet</a></li>
                    <li><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></li>
                    <li><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></li>
                </ul>
            </nav>
            
            <!-- Profil User (Logika Login/Belum Login) -->
            <div class="user-profile text-[#39AE1F] text-[55px] relative z-50">
                @auth
                    <!-- Sudah Login -> Ke Halaman Profile -->
                    <a href="/profile" class="block cursor-pointer relative z-50">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300"></i>
                    </a>
                @else
                    <!-- Belum Login -> Ke Halaman Login -->
                    <a href="/login" class="block cursor-pointer relative z-50">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300 text-gray-400"></i>
                    </a>
                @endauth
            </div>

        </div>
    </header>


    <!-- =======================================================
         KONTEN UTAMA (MAIN)
         ======================================================= -->
    <main>
        
        <!-- ================= SLIDER PROMO ================= -->
        <section class="hero">
            <div class="promo-slider-container">
                
                <!-- SLIDE 1: ES DURIAN ORIGINAL -->
                <div class="promo-slide js-slide active">
                    <div class="promo-banner bg-original">
                        
                        <div class="promo-img-wrapper">
                            <div class="discount-badge-top" style="z-index: 20;"><img src="{{ asset('image/Percent.png') }}" class="w-10 h-10"></div>
                            <div class="promo-img-box">
                                <img src="{{ asset('image/Logo.png') }}" class="watermark-logo" alt="Watermark"> 
                                <img src="{{ asset('image/es durian original.png') }}" class="product-img" alt="Es Durian Original" style="transform: translateY(-50px) scale(1.2);">
                            </div>
                        </div>

                        <div class="promo-text">
                            <h1 class="text-[#39AE1F]">Es Durian Original</h1>
                            <p>Nikmati kemurnian rasa durian pilihan dengan tekstur yang sangat lembut dan manis alami yang bikin nagih terus. Segar, Manis, Bikin Bahagia.</p>
                        </div>
                        <div class="promo-section-right">
                            <div class="white-promo-box"><img src="{{ asset('image/Percent.png') }}" class="w-14 h-14 object-contain"></div>
                            <div class="price-container">
                                <span class="promo-label">PROMO</span>
                                <span class="old-price">Rp.20.000</span>
                                <span class="new-price">Rp.17.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2: ES TELER DURIAN -->
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

                <!-- SLIDE 3: MIE AYAM JAMUR -->
                <div class="promo-slide js-slide">
                    <div class="promo-banner bg-mie">
                        
                        <div class="promo-img-wrapper">
                            <div class="discount-badge-top" style="z-index: 20;"><img src="{{ asset('image/Percent.png') }}" class="w-10 h-10"></div>
                            <div class="promo-img-box">
                                <img src="{{ asset('image/Logo.png') }}" class="watermark-logo" alt="Watermark">
                                <img src="{{ asset('image/mie ayam jamur.png') }}" class="product-img" alt="Mie Ayam Jamur" style="transform: translateY(-15px) scale(0.8);">
                            </div>
                        </div>

                        <div class="promo-text">
                            <h1 class="text-[#FFD429]">Mie Ayam Jamur</h1>
                            <p>Mie kuning lembut disajikan dengan potongan ayam berbumbu kecap yang gurih, dipadukan dengan tumisan jamur tiram yang harum dan lezat. Dilengkapi sawi hijau dan kuah kaldu ayam hangat.</p>
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

            <!-- Tombol Navigasi Kanan Kiri -->
            <button class="slide-arrow arrow-left" onclick="changeSlide(-1)"><i class="fas fa-arrow-left text-gray-600"></i></button>
            <button class="slide-arrow arrow-right" onclick="changeSlide(1)"><i class="fas fa-arrow-right text-gray-600"></i></button>

            <!-- Indikator Titik (Dots) di Bawah Slider -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-20">
                <div class="w-3 h-3 rounded-full cursor-pointer js-dot bg-black scale-125 shadow-md" onclick="goToSlide(0)"></div>
                <div class="w-3 h-3 rounded-full cursor-pointer js-dot bg-black/40" onclick="goToSlide(1)"></div>
                <div class="w-3 h-3 rounded-full cursor-pointer js-dot bg-black/40" onclick="goToSlide(2)"></div>
            </div>
        </section>


        <!-- ================= BAGIAN RECOMMENDATION ================= -->
        <section class="recommendation mt-16 mb-8 relative z-30">
            <h2 class="text-center font-black text-[32px] mb-12 text-gray-500 capitalize">Recommendation</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-[1000px] mx-auto px-6">
                
                <!-- Card 1: Udang Keju -->
                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/UdangKeju.png') }}" alt="Udang Keju" class="w-full h-52 object-cover mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-black text-[22px] mb-1 text-gray-500">Udang Keju</h3>
                        <div class="mt-auto pt-4">
                            <a href="/detail/1" class="text-[#39AE1F] font-bold italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Es Dawet -->
                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/dawet durian jumbo.png') }}" alt="Es Dawet" class="w-full h-52 object-cover mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-black text-[22px] mb-1 text-gray-500 leading-tight">Es Dawet Durian (Jumbo)</h3>
                        <div class="mt-auto pt-4">
                            <a href="/detail/2" class="text-[#39AE1F] font-bold italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Mie Ayam -->
                <div class="bg-white p-6 transition duration-300 hover:shadow-xl flex flex-col relative z-40" style="border: 1px solid #9CA3AF; border-radius: 35px; height: 100%;">
                    <img src="{{ asset('image/mie ayam bakso.png') }}" alt="Mie Ayam Bakso" class="w-full h-52 object-cover object-bottom mb-5 rounded-2xl">
                    <div class="w-full text-left flex flex-col flex-grow">
                        <h3 class="font-black text-[22px] mb-1 text-gray-500">Mie Ayam Bakso</h3>
                        <div class="mt-auto pt-4">
                            <a href="/detail/3" class="text-[#39AE1F] font-bold italic border-b-[3px] border-[#39AE1F] pb-[2px] inline-block transition hover:opacity-75 cursor-pointer relative z-50">details</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>


    <!-- =======================================================
         FOOTER SECTION
         ======================================================= -->
    <footer class="mt-20">
        <!-- Area Informasi Footer -->
        <div class="max-w-5xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 items-center">
            
            <!-- Link Footer -->
            <div class="space-y-4">
                <h4 class="font-black text-2xl uppercase text-black">LINKS</h4>
                <div class="flex flex-col space-y-3">
                    <a href="/about" class="font-bold text-gray-500 text-[17px] hover:text-[#39AE1F] transition">About Us</a>
                    <a href="/contact" class="font-bold text-gray-500 text-[17px] hover:text-[#39AE1F] transition">Contact Us</a>
                </div>
            </div>
            
            <!-- Logo Footer -->
            <div class="flex justify-center">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-28 object-contain">
            </div>
            
            <!-- Sosial Media -->
            <div class="text-right flex flex-col items-end space-y-4">
                <h4 class="font-black text-2xl uppercase text-black">FOLLOW US</h4>
                <div class="flex gap-5 text-3xl">
                    <i class="fab fa-instagram text-[#E1306C] hover:scale-110 transition cursor-pointer"></i>
                    <i class="fab fa-tiktok text-black hover:scale-110 transition cursor-pointer"></i>
                    <i class="fab fa-whatsapp text-[#25D366] hover:scale-110 transition cursor-pointer"></i>
                </div>
            </div>

        </div>

        <!-- Pattern Looping Paling Bawah -->
        <div style="width: 100%; height: 150px; background-image: url('{{ asset('image/footer.png') }}'); background-repeat: repeat-x; background-size: contain; background-position: bottom;"></div>
    </footer>


    <!-- =======================================================
         JAVASCRIPT SLIDER LOGIC
         ======================================================= -->
    <script>
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.js-slide');
        const dots = document.querySelectorAll('.js-dot');
        
        // Fungsi untuk mengupdate tampilan slide
        function updateSlider() {
            slides.forEach((s, i) => { 
                s.classList.remove('active'); 
                dots[i].classList.replace('bg-black', 'bg-black/40'); 
                dots[i].classList.remove('scale-125'); 
            });
            slides[currentSlideIndex].classList.add('active'); 
            dots[currentSlideIndex].classList.replace('bg-black/40', 'bg-black'); 
            dots[currentSlideIndex].classList.add('scale-125');
        }
        
        // Fungsi untuk panah Kanan/Kiri
        function changeSlide(d) { 
            currentSlideIndex = (currentSlideIndex + d + slides.length) % slides.length; 
            updateSlider(); 
        }
        
        // Fungsi untuk titik navigasi di bawah slider
        function goToSlide(i) { 
            currentSlideIndex = i; 
            updateSlider(); 
        }
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outlet - Durian Bar Bar</title>
    
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
        main { flex: 1; position: relative; }

        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; position: relative; z-index: 100;
        }
        .logo-glow {
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }

        /* CUSTOM ANIMASI UNDERLINE UNTUK NAV LINK */
        .nav-link {
            position: relative;
            padding-bottom: 4px;
        }
        .nav-link::after {
            content: ''; position: absolute; width: 0; height: 3px;
            bottom: 0; left: 50%; background-color: #39AE1F;
            transition: width 0.3s ease, left 0.3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%; left: 0;
        }

        /* ================= DEKORASI POHON JUMBO ================= */
        .tree-wrapper { position: relative; width: 100%; max-width: 1400px; margin: 0 auto; }
        .tree-decor {
            position: absolute; top: 0; width: 450px; opacity: 0.9; z-index: 0; pointer-events: none;
        }
        .tree-left { left: -180px; transform: scaleX(-1); }
        .tree-right { right: -180px; }

        /* ================= KHUSUS HALAMAN OUTLET ================= */
        .banner-outlet {
            background-color: #FFC107; width: 100%; text-align: center; padding: 25px 0;
        }
        .banner-outlet h1 { color: #ffffff; font-size: 50px; font-weight: 900; letter-spacing: -1px; margin: 0; text-transform: uppercase; }

        /* AUTOMATIC TYPOGRAPHY HIERARCHY MANAGER */
        h1, h2, h3, h4, h5, h6, .loading-text, .outlet-title {
            font-family: 'Outfit', sans-serif !important;
        }
        footer, footer p, footer a, footer h4, footer span, footer div {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>

<body class="bg-white">

    <div id="loading-screen">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="loader-logo">
        <div class="progress-container">
            <div class="progress-bar" id="bar"></div>
        </div>
        <div class="loading-text" id="percent">0%</div>
    </div>

    <div class="top-line"></div>

    @include('components.navbar')
    <main>
        <div class="banner-outlet relative z-20 shadow-md">
            <h1 class="text-center text-white text-[50px] font-black uppercase tracking-tighter m-0">OUTLET</h1>
        </div>

        <div class="tree-wrapper">
            <!-- Pohon Durian Kiri & Kanan Tetap Diam Kokoh di Sini -->
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-left hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-right hidden xl:block">

            <!-- KOMPONEN INTERAKTIF MAPS & OUTLET -->
            <div class="max-w-6xl mx-auto mt-12 mb-24 px-6 relative z-10">
                <div class="bg-[#39AE1F] rounded-[40px] p-6 md:p-10 shadow-2xl border-4 border-white">
                    
                    <!-- Judul Section Dalam Box -->
                    <div class="text-center mb-8">
                        <h2 class="outlet-title text-3xl font-black text-white uppercase tracking-tight">Lokasi Cabang Kami</h2>
                        <p class="text-green-100 text-sm font-bold mt-1">Gunakan peta interaktif di bawah untuk melihat seluruh jaringan outlet kami!</p>
                    </div>

                    <!-- WADAH GOOGLE MY MAPS JUMBO -->
                    <div class="w-full h-[450px] md:h-[550px] rounded-[30px] overflow-hidden shadow-inner border-4 border-white relative bg-zinc-100 mb-8">
                        <!-- Google My Maps Link Kamu -->
                        <iframe src="https://www.google.com/maps/d/embed?mid=1JLfDQrD4Bk60tgVY1SRBLXgp7nXYgHA&ehbc=2E312F" 
                                class="w-full h-full border-0" 
                                allowfullscreen="" 
                                loading="lazy"></iframe>
                    </div>

                    <!-- DAFTAR ALAMAT RESMI (GRID LAYOUT) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        <!-- Outlet 1 -->
                        <div class="bg-white p-5 rounded-2xl border-2 border-[#FFD429] shadow-sm flex gap-3 items-start">
                            <div class="bg-red-100 text-red-500 p-2.5 rounded-xl shrink-0 mt-0.5"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4 class="font-black text-base text-zinc-900 leading-tight">Pusat Purwokerto</h4>
                                <p class="text-xs text-gray-500 font-semibold mt-1 normal-case leading-normal">Jl. Prof. Dr. Suharso, Mangunjaya, Purwokerto Lor, Kec. Purwokerto Timur</p>
                            </div>
                        </div>

                        <!-- Outlet 2 -->
                        <div class="bg-white p-5 rounded-2xl border-2 border-transparent shadow-sm flex gap-3 items-start">
                            <div class="bg-red-100 text-red-500 p-2.5 rounded-xl shrink-0 mt-0.5"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4 class="font-black text-base text-zinc-900 leading-tight">Cabang Banjarnegara</h4>
                                <p class="text-xs text-gray-500 font-semibold mt-1 normal-case leading-normal">Jl. Pemuda, Krandegan, Kec. Banjarnegara, Kab. Banjarnegara</p>
                            </div>
                        </div>

                        <!-- Outlet 3 -->
                        <div class="bg-white p-5 rounded-2xl border-2 border-transparent shadow-sm flex gap-3 items-start">
                            <div class="bg-red-100 text-red-500 p-2.5 rounded-xl shrink-0 mt-0.5"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4 class="font-black text-base text-zinc-900 leading-tight">Cabang Wonosobo</h4>
                                <p class="text-xs text-gray-500 font-semibold mt-1 normal-case leading-normal">Jl. A. Yani, Tosari, Jaraksari, Kec. Wonosobo, Kab. Wonosobo</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
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

    @include('components.cart-script')
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Durian BarBar</title>
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0;
            overflow-x: hidden;
        }
        main { flex: 1; position: relative; }

        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; background-size: auto; position: relative; z-index: 100;
        }

        .logo-glow {
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }

        /* ================= DEKORASI POHON JUMBO ================= */
        .tree-wrapper { position: relative; width: 100%; max-width: 1400px; margin: 0 auto; }
        .tree-decor {
            position: absolute; top: 0; width: 450px; opacity: 0.9; z-index: 0; pointer-events: none;
        }
        .tree-left { left: -180px; transform: scaleX(-1); }
        .tree-right { right: -180px; }

        /* ================= KELAS ANIMASI SCROLL ================= */
        .reveal-up { opacity: 0; transform: translateY(40px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-left { opacity: 0; transform: translateX(-50px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-right { opacity: 0; transform: translateX(50px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-active { opacity: 1; transform: translate(0, 0); }

        /* Animasi berputar untuk watermark */
        @keyframes slowSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-slow-spin { animation: slowSpin 60s linear infinite; }

        /* AUTOMATIC TYPOGRAPHY HIERARCHY MANAGER */
        h1, h2, h3, h4, h5, h6, .loading-text {
            font-family: 'Outfit', sans-serif !important;
        }
        footer, footer p, footer a, footer h4, footer span, footer div {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>
<body class="text-gray-800">

    <div id="loading-screen">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="loader-logo">
        <div class="progress-container">
            <div class="progress-bar" id="bar"></div>
        </div>
        <div class="loading-text" id="percent">0%</div>
    </div>

    <div class="top-line"></div>

    @include('components.navbar')

    <div class="bg-[#FFD429] py-6 shadow-sm relative z-20 text-center">
        <h1 class="text-4xl md:text-[50px] font-black text-white uppercase tracking-tighter m-0">ABOUT US</h1>
    </div>

    <main>
        <div class="tree-wrapper">
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-left hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-right hidden xl:block">

            <div class="container mx-auto max-w-5xl px-6 relative z-10 py-16 text-center">
                <div class="absolute inset-0 flex justify-center items-center z-0 pointer-events-none opacity-[0.15]">
                <img src="{{ asset('image/Logo.png') }}" alt="Watermark" class="w-[500px] object-contain animate-slow-spin">
                </div>

                <h2 class="text-3xl md:text-[40px] font-black mb-10 tracking-tight uppercase reveal-up js-reveal">
                    <span class="text-[#39AE1F]">Selamat datang</span> 
                    <span class="text-[#FFD429]">di website kami!</span>
                </h2>

                <p class="text-zinc-700 font-bold text-lg md:text-[17px] leading-[1.8] mb-16 px-2 md:px-10 text-justify md:text-center reveal-up js-reveal" style="transition-delay: 150ms;">
                    Kami menyediakan berbagai makanan dan minuman favorit seperti es durian, mie ayam, es dawet, dan aneka camilan dengan rasa terbaik dan kualitas terjamin. Kami berkomitmen memberikan pengalaman kuliner yang mudah, cepat, dan menyenangkan dengan mengutamakan bahan berkualitas, pelayanan ramah, serta harga terjangkau. Kami juga terus berinovasi menghadirkan menu baru sesuai selera pelanggan.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-14 text-left overflow-hidden">
                    <div class="reveal-left js-reveal" style="transition-delay: 300ms;">
                        <img src="{{ asset('image/visi.png') }}" alt="Visi BarBar" class="w-full h-64 object-cover rounded-[35px] shadow-lg mb-6 border-4 border-white transition-all duration-300 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-2xl cursor-pointer">
                        <h3 class="text-[#39AE1F] text-2xl font-black mb-3 uppercase tracking-tight">Visi:</h3>
                        <p class="text-zinc-700 text-base font-bold leading-relaxed">
                            Menjadi pilihan utama masyarakat dalam menikmati makanan dan minuman berkualitas.
                        </p>
                    </div>
                    
                    <div class="reveal-right js-reveal" style="transition-delay: 450ms;">
                        <img src="{{ asset('image/misi.png') }}" alt="Misi BarBar" class="w-full h-64 object-cover rounded-[35px] shadow-lg mb-6 border-4 border-white transition-all duration-300 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-2xl cursor-pointer">
                        <h3 class="text-[#FFD429] text-2xl font-black mb-3 uppercase tracking-tight">Misi:</h3>
                        <ul class="text-zinc-700 text-base font-bold leading-relaxed list-disc pl-5 space-y-2">
                            <li>Menyediakan produk berkualitas tinggi</li>
                            <li>Memberikan pelayanan terbaik</li>
                            <li>Terus berinovasi dalam menu</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-20 reveal-up js-reveal" style="transition-delay: 600ms;">
                    <p class="font-black text-zinc-800 text-base md:text-xl uppercase tracking-tight">
                        Terima kasih telah mempercayai kami. Kami berharap dapat menjadi bagian dari momen spesial Anda.
                    </p>
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
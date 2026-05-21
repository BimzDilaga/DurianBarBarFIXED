<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bar Bar Es Duren</title>
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

        /* KONSISTENSI STYLE BAR BAR */
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh; 
            margin: 0; padding: 0; background-color: #ffffff; color: #333;
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

        /* DEKORASI POHON JUMBO */
        .tree-wrapper { position: relative; width: 100%; max-width: 1400px; margin: 0 auto; }
        .tree-decor {
            position: absolute; top: 0; width: 450px; opacity: 0.9; z-index: 0; pointer-events: none;
        }
        .tree-left { left: -180px; transform: scaleX(-1); }
        .tree-right { right: -180px; }

        /* AUTOMATIC TYPOGRAPHY HIERARCHY MANAGER */
        h1, h2, h3, h4, h5, h6, .loading-text {
            font-family: 'Outfit', sans-serif !important;
        }
        footer, footer p, footer a, footer h4, footer span, footer div {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>
<body>

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
        <div class="bg-[#FFD429] w-full py-6 shadow-sm relative z-20">
            <h1 class="text-center text-white text-[50px] font-black uppercase tracking-tighter m-0">Contact Us Here</h1>
        </div>

        <div class="tree-wrapper">
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-left hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-right hidden xl:block">

            <div class="max-w-4xl mx-auto mt-16 mb-16 px-8 relative z-10">
                
                @if(session('success'))
                <div id="success-alert" class="bg-green-50 border-l-8 border-[#39AE1F] p-6 rounded-2xl shadow-lg mb-8 transform transition-all duration-500 flex items-start gap-5 bg-white/90 backdrop-blur-sm">
                    <div class="bg-[#39AE1F] rounded-full p-3 text-white flex-shrink-0 shadow-sm">
                        <i class="fas fa-check-circle text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-[#39AE1F] font-black text-2xl mb-1 uppercase tracking-wide">Pesan Berhasil Terkirim!</h3>
                        <p class="text-gray-600 font-bold text-[15px] leading-relaxed">
                            Terima kasih banyak atas pesan kamu! <br>
                            Masukan, saran, dan dukungan kamu sangat berarti untuk membuat Bar Bar Es Duren jadi makin mantap ke depannya. Pesan kamu sudah kami terima dan akan segera kami baca. Sukses selalu dan salam Bar Bar!
                        </p>
                    </div>
                    <button onclick="document.getElementById('success-alert').style.display='none'" class="text-gray-400 hover:text-red-500 transition duration-300 p-1">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                @endif
                <form action="#" method="POST" class="space-y-8 bg-white/80 backdrop-blur-sm p-10 rounded-[40px] shadow-xl border border-gray-100">
                    @csrf
                    
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                        <label class="font-black text-xl text-[#39AE1F] w-full md:w-1/3 uppercase tracking-tight">Name</label>
                        <input type="text" name="name" placeholder="Input ur name" required
                               class="w-full md:w-2/3 border-2 border-gray-200 rounded-2xl px-6 py-4 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F] shadow-sm">
                    </div>

                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                        <label class="font-black text-xl text-[#39AE1F] w-full md:w-1/3 uppercase tracking-tight">Phone</label>
                        <div class="flex w-full md:w-2/3 shadow-sm">
                            <span class="bg-gray-100 border-2 border-gray-200 border-r-0 rounded-l-2xl px-6 py-4 font-black text-gray-500">+62</span>
                            <input type="text" name="phone" placeholder="82192010" required
                                   class="w-full border-2 border-gray-200 rounded-r-2xl px-6 py-4 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F]">
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                        <label class="font-black text-xl text-[#39AE1F] w-full md:w-1/3 uppercase tracking-tight">Email</label>
                        <input type="email" name="email" placeholder="Input ur email address" required
                               class="w-full md:w-2/3 border-2 border-gray-200 rounded-2xl px-6 py-4 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F] shadow-sm">
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <label class="font-black text-xl text-[#39AE1F] w-full md:w-1/3 pt-2 uppercase tracking-tight">What Do You Want To Tell</label>
                        <textarea name="message" rows="5" placeholder="Tulis pesan barbar kamu di sini..." required
                                  class="w-full md:w-2/3 border-2 border-gray-200 rounded-2xl px-6 py-4 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F] shadow-sm resize-none"></textarea>
                    </div>

                    <div class="flex flex-col md:flex-row items-start gap-4 pt-4">
                        <div class="hidden md:block w-1/3"></div>
                        <div class="w-full md:w-2/3">
                            <button type="submit" class="bg-[#39AE1F] text-white font-black py-5 px-16 rounded-full hover:bg-green-700 transition-all duration-300 shadow-lg tracking-widest text-2xl uppercase">
                                SEND IT!
                            </button>
                        </div>
                    </div>
                </form>
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
    </script>
    
    @include('components.cart-script')
</body>
</html>
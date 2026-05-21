<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile - Bar Bar Es Duren</title>
    
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

        /* STYLE PROFILE CARD UPGRADE */
        .bg-yellow-barbar { background-color: #FFC107; }
        .profile-card {
            border: 2px solid #f3f4f6;
            box-shadow: 0 25px 60px rgba(0,0,0,0.08);
        }

        /* AUTOMATIC TYPOGRAPHY HIERARCHY MANAGER */
        h1, h2, h3, h4, h5, h6, .loading-text {
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
        <div class="bg-yellow-barbar w-full py-4 shadow-md relative z-20 text-center">
            <h1 class="text-white text-[45px] font-black uppercase tracking-tighter m-0">Your Profile</h1>
        </div>

        <div class="tree-wrapper">
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-left hidden xl:block">
            <img src="{{ asset('image/pohon-durian.png') }}" class="tree-decor tree-right hidden xl:block">

            <div class="max-w-4xl mx-auto mt-16 mb-24 px-6 relative z-10">
                <div class="profile-card bg-white p-8 md:p-12 flex flex-col md:flex-row items-stretch justify-center gap-10 md:gap-14 relative z-20 rounded-[50px] border-b-8 border-[#39AE1F]">
                    
                    <div class="flex flex-col items-center justify-center bg-gray-50 p-8 rounded-[40px] border-2 border-gray-100 flex-shrink-0 w-full md:w-64 text-center shadow-inner">
                        <div class="w-32 h-32 rounded-full border-4 border-[#FFC107] bg-white flex items-center justify-center text-[#39AE1F] text-6xl shadow-sm mb-5 transition duration-300 hover:scale-105">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h3 class="font-black text-2xl text-gray-800 uppercase tracking-tighter leading-tight px-2 mb-3">
                            {{ auth()->user()->name ?? 'Aditya Nur Arif' }}
                        </h3>
                        <span class="bg-[#39AE1F] text-white text-[12px] font-black px-6 py-2 rounded-full uppercase tracking-widest shadow-md">
                            Member Bar Bar
                        </span>
                    </div>

                    <div class="flex-1 w-full space-y-4 pt-2 flex flex-col justify-between">
                        <div class="space-y-4 w-full">
                            
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex items-center gap-4 shadow-sm transition hover:shadow-md">
                                <div class="bg-[#FFC107] text-white p-3 rounded-xl w-12 h-12 flex items-center justify-center text-xl shadow-md flex-shrink-0">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="text-left">
                                    <h4 class="font-black text-xs uppercase text-gray-400 tracking-tight">Nama Lengkap</h4>
                                    <p class="font-bold text-gray-700 text-xl leading-tight mt-0.5">{{ auth()->user()->name ?? 'Aditya Nur Arif' }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex items-center gap-4 shadow-sm transition hover:shadow-md">
                                <div class="bg-[#39AE1F] text-white p-3 rounded-xl w-12 h-12 flex items-center justify-center text-xl shadow-md flex-shrink-0">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="text-left overflow-hidden">
                                    <h4 class="font-black text-xs uppercase text-gray-400 tracking-tight">Email</h4>
                                    <p class="font-bold text-gray-700 text-base md:text-lg leading-tight mt-0.5 truncate">{{ auth()->user()->email ?? 'adityanurarif9@gmail.com' }}</p>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex items-center gap-4 shadow-sm transition hover:shadow-md">
                                <div class="bg-[#FFC107] text-white p-3 rounded-xl w-12 h-12 flex items-center justify-center text-xl shadow-md flex-shrink-0">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="text-left">
                                    <h4 class="font-black text-xs uppercase text-gray-400 tracking-tight">No Handphone</h4>
                                    <p class="font-bold text-gray-700 text-lg leading-tight mt-0.5">{{ auth()->user()->no_hp ?? '085848182655' }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex items-center justify-between gap-4 shadow-sm transition hover:shadow-md">
                                <div class="flex items-center gap-4 w-full">
                                    <div class="bg-[#39AE1F] text-white p-3 rounded-xl w-12 h-12 flex items-center justify-center text-xl shadow-md flex-shrink-0">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div class="text-left w-full">
                                        <h4 class="font-black text-xs uppercase text-gray-400 tracking-tight">Password</h4>
                                        <input type="password" id="profile-password" value="{{ session('password_mentah') ?? '********' }}" class="bg-transparent font-bold text-gray-700 text-2xl tracking-widest outline-none pointer-events-none w-full border-none p-0 h-6 leading-none mt-1" readonly>
                                    </div>
                                </div>
                                <button type="button" onclick="togglePassword()" class="text-gray-400 hover:text-[#39AE1F] transition text-xl cursor-pointer pr-2 flex-shrink-0">
                                    <i id="eye-icon" class="fas fa-eye-slash"></i>
                                </button>
                            </div>

                        </div>

                        <div class="pt-6 text-left">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-black py-3.5 px-12 rounded-full text-md uppercase tracking-widest hover:-translate-y-1 transition duration-300 shadow-lg flex items-center gap-3">
                                    Logout <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
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
                        setTimeout(() => { document.getElementById('loading-screen').style.display = 'none'; }, 500);
                    }, 300);
                } else {
                    width += 5;
                    bar.style.width = width + '%';
                    percentText.innerText = width + '%';
                }
            }, 30);
        });

        // 2. LOGIKA HAMBURGER MENU MOBILE
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            
            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.classList.replace('fa-times', 'fa-bars');
            } else {
                menuIcon.classList.replace('fa-bars', 'fa-times');
            }
        });

        // 3. LOGIKA EYE ICON
        function togglePassword() {
            const pwdInput = document.getElementById('profile-password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (pwdInput.type === "password") {
                pwdInput.type = "text";
                pwdInput.classList.remove('tracking-widest');
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                pwdInput.type = "password";
                pwdInput.classList.add('tracking-widest');
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
    @include('components.cart-script')
</body>
</html>
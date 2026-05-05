<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Font Gahar Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0; background-color: #ffffff;
            overflow-x: hidden;
        }
        main { flex: 1; }
        
        /* FIX TOP LINE: Tekstur dan Gradasi Hijau */
        .top-line {
            width: 100%; 
            height: 45px;
            background-image: 
                url("{{ asset('image/texture.png') }}"), 
                linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat;
            background-size: auto;
            position: relative; 
            z-index: 99;
        }

        /* Glow Putih di belakang Logo */
        .logo-glow {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-glow::before {
            content: '';
            position: absolute;
            width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
        }

        /* Footer Pattern Looping */
        .footer-loop {
            width: 100%; height: 120px;
            background-image: url('{{ asset('image/footer.png') }}');
            background-repeat: repeat-x;
            background-size: contain;
            background-position: bottom;
        }
    </style>
</head>
<body>

    <!-- TOP LINE HIJAU -->
    <div class="top-line"></div>

    <!-- NAVBAR DISAMAKAN DENGAN HOME (WARNA HIJAU) -->
    <header class="bg-white py-6 relative z-20">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            
            <div class="logo-glow">
                <a href="/">
                    <img src="{{ asset('image/logo.png') }}" alt="Bar Bar Es Duren" class="h-[100px] object-contain">
                </a>
            </div>

            <!-- WARNA LINK DIUBAH KE HIJAU (#39AE1F) AGAR SAMA SEPERTI HOME -->
            <nav class="hidden md:block">
                <ul class="flex space-x-12 text-[18px] font-[900] text-gray-700 uppercase tracking-tight">
                    <li><a href="/" class="hover:text-[#39AE1F] transition">Home</a></li>
                    
                    <!-- MENU 'MENU' AKTIF DENGAN WARNA HIJAU DAN GARIS BAWAH -->
                    <li><a href="/menu" class="text-[#39AE1F] border-b-4 border-[#39AE1F] pb-1">Menu</a></li>
                    
                    <li><a href="/outlet" class="hover:text-[#39AE1F] transition">Outlet</a></li>
                    <li><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></li>
                    <li><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></li>
                </ul>
            </nav>

            <!-- INI BAGIAN YANG DIUBAH! LOGIKA LOGIN/BELUM LOGIN SAMA KAYAK HOME -->
            <div class="user-profile text-[#39AE1F] text-[55px] relative z-50">
                @auth
                    <!-- Sudah Login -> Ke Halaman Profile (Hijau) -->
                    <a href="/profile" class="block cursor-pointer relative z-50">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300"></i>
                    </a>
                @else
                    <!-- Belum Login -> Ke Halaman Login (Abu-abu) -->
                    <a href="/login" class="block cursor-pointer relative z-50">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300 text-gray-400"></i>
                    </a>
                @endauth
            </div>
            <!-- SELESAI BAGIAN YANG DIUBAH -->

        </div>
    </header>

    <main>
        <!-- BANNER KUNING TETAP UNTUK KONTRAS BRAND -->
        <div class="bg-[#FFD429] w-full py-6 shadow-md text-center">
            <h1 class="text-white text-[50px] font-black italic uppercase tracking-tighter m-0">MENU</h1>
        </div>

        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4">
            <!-- Kategori Menu dengan Lingkaran Hijau -->
            <div class="flex flex-wrap justify-center gap-12 md:gap-20">
                <a href="/menu/es-durian" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/EsDurianMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Es Durian</h3>
                </a>

                <a href="/menu/mie-ayam" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/MieAyamMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-120 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Mie Ayam</h3>
                </a>

                <a href="/menu/es-dawet" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/EsDawetMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Es Dawet</h3>
                </a>
            </div>

            <div class="flex flex-wrap justify-center gap-12 md:gap-28 mt-12 md:mt-16">
                <a href="/menu/cemilan" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/CemilanMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Cemilan</h3>
                </a>

                <a href="/menu/es-teler" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/EsTelerMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Es Teler</h3>
                </a>
            </div>
        </div>
    </main>

    <!-- FOOTER KONSISTEN -->
    <footer class="w-full mt-auto">
        <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-3 items-center border-t border-gray-100">
            <div class="space-y-1">
                <h4 class="font-black text-xl mb-4 italic uppercase text-black">LINKS</h4>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></p>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-28">
            </div>
            <div class="text-right flex flex-col items-end">
                <h4 class="font-black text-xl mb-4 italic uppercase text-black">FOLLOW US</h4>
                <div class="flex gap-4 text-3xl">
                    <i class="fab fa-instagram text-pink-600 hover:scale-110 cursor-pointer transition"></i>
                    <i class="fab fa-tiktok text-black hover:scale-110 cursor-pointer transition"></i>
                    <i class="fab fa-whatsapp text-green-500 hover:scale-110 cursor-pointer transition"></i>
                </div>
            </div>
        </div>
        <div class="footer-loop"></div>
    </footer>

</body>
</html>
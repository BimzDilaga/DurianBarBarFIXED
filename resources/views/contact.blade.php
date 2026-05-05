<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bar Bar Es Duren</title>
    <!-- TAILWIND & FONTS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        /* KONSISTENSI STYLE BAR BAR */
        body { 
            font-family: 'Montserrat', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh; 
            margin: 0; padding: 0; background-color: #ffffff; color: #333;
            overflow-x: hidden;
        }
        main { flex: 1; }

        /* FIX TOP LINE: Tekstur dulu baru Gradasi (Sama persis kayak Home & Menu) */
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

        /* Efek Glow Putih di belakang Logo */
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

        /* FOOTER LOOPING SESUAI LANDING PAGE */
        .footer-loop {
            width: 100%; height: 150px;
            background-image: url('{{ asset('image/footer.png') }}');
            background-repeat: repeat-x;
            background-size: contain;
            background-position: bottom;
        }
    </style>
</head>
<body>

    <!-- TOP LINE -->
    <div class="top-line"></div>

    <!-- NAVBAR YAG SUDAH DIPERBESAR DAN DISAMAKAN -->
    <header class="bg-white py-6 relative z-20">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            
            <!-- LOGO DIBESARKAN (h-[100px]) + GLOW -->
            <div class="logo-glow">
                <a href="/">
                    <img src="{{ asset('image/logo.png') }}" alt="Bar Bar Es Duren" class="h-[100px] object-contain">
                </a>
            </div>

            <!-- MENU DIBESARKAN (text-[18px] font-[900]) -->
            <nav class="hidden md:block">
                <ul class="flex space-x-12 text-[18px] font-[900] text-gray-700 uppercase tracking-tight">
                    <li><a href="/" class="hover:text-[#39AE1F] transition">Home</a></li>
                    <li><a href="/menu" class="hover:text-[#39AE1F] transition">Menu</a></li>
                    <li><a href="/outlet" class="hover:text-[#39AE1F] transition">Outlet</a></li>
                    <li><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></li>

                    <!-- MENU CONTACT US AKTIF DENGAN GARIS BAWAH KUNING -->
                    <li><a href="/contact" class="text-[#39AE1F] border-b-4 border-[#39AE1F] pb-1">Contact Us</a></li>
                </ul>
            </nav>

            <!-- INI BAGIAN YANG DIUBAH! LOGIKA LOGIN/BELUM LOGIN SAMA KAYAK HOME/MENU/ABOUT -->
            <div class="user-profile text-[55px] relative z-50">
                @auth
                    <!-- Sudah Login -> Ikon Hijau -> Ke Halaman Profile -->
                    <a href="/profile" class="block cursor-pointer relative z-50 text-[#39AE1F]">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300"></i>
                    </a>
                @else
                    <!-- Belum Login -> Ikon Abu-abu -> Ke Halaman Login -->
                    <a href="/login" class="block cursor-pointer relative z-50 text-gray-400">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300"></i>
                    </a>
                @endauth
            </div>
            <!-- SELESAI BAGIAN YANG DIUBAH -->

        </div>
    </header>

    <main>
        <!-- BANNER JUDUL -->
        <div class="bg-[#FFD429] w-full py-6 shadow-sm">
            <h1 class="text-center text-white text-[50px] font-black italic uppercase tracking-tighter m-0">Contact Us Here</h1>
        </div>

        <!-- FORM LAYOUT -->
        <div class="max-w-4xl mx-auto mt-16 mb-20 px-8">
            <form action="#" method="POST" class="space-y-8">
                @csrf
                
                <!-- Row: Name -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 italic uppercase">Name</label>
                    <input type="text" name="name" placeholder="Input ur name" 
                           class="w-full md:w-2/3 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F]">
                </div>

                <!-- Row: Phone -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 italic uppercase">Phone</label>
                    <div class="flex w-full md:w-2/3">
                        <span class="bg-gray-100 border-2 border-gray-200 border-r-0 rounded-l-xl px-4 py-3 font-black text-gray-500">+62</span>
                        <input type="text" name="phone" placeholder="82192010" 
                               class="w-full border-2 border-gray-200 rounded-r-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F]">
                    </div>
                </div>

                <!-- Row: Email -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 italic uppercase">Email</label>
                    <input type="email" name="email" placeholder="Input ur email address" 
                           class="w-full md:w-2/3 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F]">
                </div>

                <!-- Row: Message -->
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 pt-2 italic uppercase">What Do You Want To Tell</label>
                    <textarea name="message" rows="5" placeholder="Tulis pesan barbar kamu di sini..."
                              class="w-full md:w-2/3 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F] resize-none"></textarea>
                </div>

                <!-- Row: Button SEND -->
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <div class="hidden md:block w-1/3"></div>
                    <div class="w-full md:w-2/3">
                        <button type="submit" class="bg-[#39AE1F] text-white font-black py-3 px-12 rounded-[20px] hover:bg-green-700 transition tracking-tighter italic">
                            SEND IT!
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- FOOTER KONSISTEN (DIKEMBALIKAN FULL SUPAYA SAMA DENGAN PAGE LAIN) -->
    <footer class="w-full mt-auto pt-10">
        <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-3 items-center">
            <div class="space-y-1">
                <h4 class="font-black text-xl mb-4 italic uppercase text-black">LINKS</h4>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/about" class="hover:text-green-500 transition">About Us</a></p>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/contact" class="hover:text-green-500 transition">Contact Us</a></p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-28">
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
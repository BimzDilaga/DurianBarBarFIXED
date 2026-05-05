<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Durian BarBar</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Font Gahar Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0;
            overflow-x: hidden;
        }

        main { flex: 1; }

        /* TOP LINE HIJAU GAHAR */
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

        /* FOOTER LOOPING */
        .footer-loop {
            width: 100%; height: 120px;
            background-image: url('{{ asset('image/footer.png') }}');
            background-repeat: repeat-x;
            background-size: contain;
            background-position: bottom;
        }
    </style>
</head>
<body class="text-gray-800">

    <!-- TOP LINE -->
    <div class="top-line"></div>

    <!-- NAVBAR DISAMAKAN DENGAN HOME (ABOUT US AKTIF HIJAU) -->
    <header class="bg-white py-6 relative z-20">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            
            <div class="logo-glow">
                <a href="/">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo Barbar" class="h-[100px] object-contain">
                </a>
            </div>

            <nav class="hidden md:block">
                <ul class="flex space-x-12 text-[18px] font-[900] text-gray-700 uppercase tracking-tight">
                    <li><a href="/" class="hover:text-[#39AE1F] transition">Home</a></li>
                    <li><a href="/menu" class="hover:text-[#39AE1F] transition">Menu</a></li>
                    <li><a href="/outlet" class="hover:text-[#39AE1F] transition">Outlet</a></li>
                    
                    <!-- MENU ABOUT US AKTIF DENGAN WARNA HIJAU SESUAI HOME -->
                    <li><a href="/about" class="text-[#39AE1F] border-b-4 border-[#39AE1F] pb-1">About Us</a></li>
                    
                    <li><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></li>
                </ul>
            </nav>

            <!-- INI BAGIAN YANG DIUBAH! LOGIKA LOGIN/BELUM LOGIN SAMA KAYAK HOME/MENU -->
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

    <!-- BANNER ABOUT US (Teks Putih Sesuai Request) -->
    <div class="bg-[#FFD429] py-6 shadow-sm relative z-10 text-center">
        <h1 class="text-4xl md:text-[50px] font-black text-white uppercase italic tracking-tighter m-0">ABOUT US</h1>
    </div>

    <!-- KONTEN UTAMA -->
    <main class="flex-grow relative py-16 overflow-hidden text-center">
        <!-- Watermark Logo -->
        <div class="absolute inset-0 flex justify-center items-center z-0 pointer-events-none opacity-5">
            <img src="{{ asset('image/Logo.png') }}" alt="Watermark" class="w-[500px] object-contain">
        </div>

        <div class="container mx-auto max-w-5xl px-6 relative z-10">
            <h2 class="text-3xl md:text-[40px] font-black mb-10 tracking-tight">
                <span class="text-[#39AE1F]">Selamat datang</span> 
                <span class="text-[#FFD429]">di website kami!</span>
            </h2>

            <p class="text-[#333] font-bold text-lg md:text-[17px] leading-[1.8] mb-16 px-2 md:px-10">
                Kami menyediakan berbagai makanan dan minuman favorit seperti es durian, mie ayam, es dawet, dan aneka camilan dengan rasa terbaik dan kualitas terjamin. Kami berkomitmen memberikan pengalaman kuliner yang mudah, cepat, dan menyenangkan dengan mengutamakan bahan berkualitas, pelayanan ramah, serta harga terjangkau. Kami juga terus berinovasi menghadirkan menu baru sesuai selera pelanggan.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-14 text-left">
                <!-- BAGIAN VISI -->
                <div>
                    <!-- Efek Timbul ada di baris class img ini ya koh -->
                    <img src="{{ asset('image/visi.png') }}" alt="Outlet BarBar" class="w-full h-64 object-cover rounded-[35px] shadow-lg mb-6 border-4 border-white transition-all duration-300 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-2xl cursor-pointer">
                    
                    <h3 class="text-[#39AE1F] text-2xl font-black mb-3 uppercase italic">Visi:</h3>
                    <p class="text-[#333] text-base font-bold leading-relaxed">
                        Menjadi pilihan utama masyarakat dalam menikmati makanan dan minuman berkualitas.
                    </p>
                </div>
                
                <!-- BAGIAN MISI -->
                <div>
                    <!-- Efek Timbul ada di baris class img ini ya koh -->
                    <img src="{{ asset('image/misi.png') }}" alt="Poster Es Dawet" class="w-full h-64 object-cover rounded-[35px] shadow-lg mb-6 border-4 border-white transition-all duration-300 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-2xl cursor-pointer">
                    
                    <h3 class="text-[#FFD429] text-2xl font-black mb-3 uppercase italic">Misi:</h3>
                    <ul class="text-[#333] text-base font-bold leading-relaxed list-disc pl-5 space-y-2">
                        <li>Menyediakan produk berkualitas tinggi</li>
                        <li>Memberikan pelayanan terbaik</li>
                        <li>Terus berinovasi dalam menu</li>
                    </ul>
                </div>
            </div>

            <div class="mt-20">
                <p class="font-black text-black text-base md:text-lg">
                    Terima kasih telah mempercayai kami. Kami berharap dapat menjadi bagian dari momen spesial Anda.
                </p>
            </div>
        </div>
    </main>

    <!-- FOOTER KONSISTEN -->
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
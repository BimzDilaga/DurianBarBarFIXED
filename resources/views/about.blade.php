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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #ffffff;
        }

        /* 1. HEADER PATTERN (Gambar Kedua) */
        .top-pattern {
            width: 100%;
            height: 45px;
            background: linear-gradient(to bottom, #8CFF00, #39AE1F);
            /* Memanggil gambar header yang mas kirim */
            background-image: url('{{ asset("image/header_pattern.png") }}'), 
                              linear-gradient(to bottom, #8CFF00, #39AE1F);
            background-repeat: repeat-x;
            background-size: contain;
            position: relative;
            z-index: 99;
        }

        /* 2. FOOTER PATTERN (Gambar Pertama / texture.png) */
        .bottom-pattern {
            height: 100px;
            width: 100%;
            /* Memanggil gambar footer kuning yang mas kirim */
            background-image: url('{{ asset("image/texture.png") }}');
            background-repeat: repeat-x;
            background-position: bottom;
            background-size: contain;
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
            width: 120px; height: 120px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>
<body class="text-gray-800 flex flex-col min-h-screen">

    <!-- BAGIAN PALING ATAS: Header Pattern -->
    <div class="top-pattern"></div>

    <!-- NAVBAR -->
    <header class="bg-white py-3 border-b border-gray-100 shadow-sm relative z-20">
        <div class="container mx-auto max-w-6xl px-6 flex justify-between items-center">
            <div class="logo-glow">
                <a href="/">
                    <img src="{{ asset('image/Logo.png') }}" alt="Logo Barbar" class="h-[75px] object-contain">
                </a>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-10 text-[15px] font-extrabold text-gray-500 uppercase">
                    <li><a href="/" class="hover:text-[#44AD24] transition">Home</a></li>
                    <li><a href="/menu" class="hover:text-[#44AD24] transition">Menu</a></li>
                    <li><a href="/outlet" class="hover:text-[#44AD24] transition">Outlet</a></li>
                    <li><a href="/about" class="text-[#44AD24]">About Us</a></li>
                    <li><a href="/contact" class="hover:text-[#44AD24] transition">Contact Us</a></li>
                </ul>
            </nav>
            <div class="user-profile text-[#39AE1F]">
                <a href="/profile">
                    <i class="fa-solid fa-circle-user text-[40px] hover:scale-110 transition duration-300"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- BANNER ABOUT US (Ukuran dikecilkan sedikit) -->
    <div class="bg-[#FFD429] py-6 shadow-sm relative z-10">
    <h1 class="text-center text-4xl md:text-5xl font-black text-white uppercase tracking-[0.05em]">About us</h1>
    </div>

    <!-- KONTEN UTAMA -->
    <main class="flex-grow relative py-16 overflow-hidden text-center">
        <!-- Watermark Logo -->
        <div class="absolute inset-0 flex justify-center items-center z-0 pointer-events-none opacity-5">
            <img src="{{ asset('image/Logo.png') }}" alt="Watermark" class="w-[500px] object-contain">
        </div>

        <div class="container mx-auto max-w-5xl px-6 relative z-10">
            <h2 class="text-3xl md:text-4xl font-black mb-10">
                <span class="text-[#39AE1F]">Selamat datang</span> 
                <span class="text-[#facc15]">di website kami!</span>
            </h2>

            <p class="text-[#333] font-bold text-lg md:text-[17px] leading-[1.8] mb-16 px-2 md:px-10">
                Kami menyediakan berbagai makanan dan minuman favorit seperti es durian, mie ayam, es dawet, dan aneka camilan dengan rasa terbaik dan kualitas terjamin. Kami berkomitmen memberikan pengalaman kuliner yang mudah, cepat, dan menyenangkan dengan mengutamakan bahan berkualitas, pelayanan ramah, serta harga terjangkau. Kami juga terus berinovasi menghadirkan menu baru sesuai selera pelanggan.
            </p>

            <!-- Visi & Misi Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-14 text-left">
                <div>
                    <img src="{{ asset('image/Outlet.jpg') }}" alt="Outlet BarBar" class="w-full h-64 object-cover rounded-[35px] shadow-lg mb-6">
                    <h3 class="text-[#39AE1F] text-2xl font-black mb-3 uppercase">Visi:</h3>
                    <p class="text-[#333] text-base font-bold leading-relaxed">
                        Menjadi pilihan utama masyarakat dalam menikmati makanan dan minuman berkualitas.
                    </p>
                </div>
                <div>
                    <img src="{{ asset('image/EsDawetMenu.png') }}" alt="Poster Es Dawet" class="w-full h-64 object-cover rounded-[35px] shadow-lg mb-6">
                    <h3 class="text-[#facc15] text-2xl font-black mb-3 uppercase">Misi:</h3>
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

    <!-- FOOTER (Sesuai Gambar Pertama) -->
    <footer class="bg-white relative z-10 pt-16">
        <div class="container mx-auto max-w-6xl px-8 grid grid-cols-1 md:grid-cols-3 gap-10 items-center text-center">
            
            <div class="md:text-left">
                <h4 class="font-black text-2xl text-black mb-5">LINKS</h4>
                <div class="flex flex-col space-y-2 text-lg font-extrabold text-gray-500">
                    <a href="/about" class="hover:text-[#44AD24] transition">About Us</a>
                    <a href="/contact" class="hover:text-[#44AD24] transition">Contact Us</a>
                </div>
            </div>

            <div class="flex justify-center logo-glow">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo BarBar" class="h-28 object-contain">
            </div>

            <div class="md:text-right flex flex-col md:items-end items-center">
                <h4 class="font-black text-2xl text-black mb-5 uppercase">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="w-12 h-12 rounded-full flex items-center justify-center text-white shadow-lg" style="background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-full flex items-center justify-center text-white bg-black shadow-lg">
                        <i class="fab fa-tiktok text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-full flex items-center justify-center text-white bg-[#25D366] shadow-lg">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- PALING BAWAH: Texture Kuning Berulang -->
        <div class="bottom-pattern mt-40"></div>
    </footer>

</body>
</html>
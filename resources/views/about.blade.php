<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Font Gahar Kita -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0; background-color: #ffffff;
            overflow-x: hidden;
        }
        main { flex: 1; }
        
         /* FIX TOP LINE: Tekstur dulu baru Gradasi */
    .top-line {
        width: 100%; 
        height: 45px;
        background-image: 
            url("{{ asset('image/texture.png') }}"), 
            linear-gradient(to bottom, #39AE1F, #8CFF00);
        background-repeat: repeat;
        background-size: auto; /* Biar tekstur aslinya kelihatan */
        position: relative; 
        z-index: 99;
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
<body>

    <!-- TOP LINE -->
    <div class="top-line"></div>

    <!-- NAVBAR KONSISTEN -->
    <nav class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center w-full">
        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-16">
        <ul class="hidden md:flex gap-8 text-gray-800 font-black text-xs uppercase tracking-widest">
            <li><a href="/" class="hover:text-yellow-500">Home</a></li>
            <li><a href="/menu" class="hover:text-yellow-500">Menu</a></li>
            <li><a href="/outlet" class="hover:text-yellow-500">Outlet</a></li>
            <li><a href="/about" class="text-yellow-500 border-b-2 border-yellow-500 pb-1">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
        </ul>
        <div class="text-[#39AE1F] text-4xl">
            <a href="/profile"><i class="fas fa-user-circle hover:scale-110 transition"></i></a>
        </div>
    </nav>

    <!-- BANNER KUNING -->
    <div class="bg-[#FFC107] w-full py-3 shadow-md text-center">
        <h1 class="text-white text-5xl font-black italic uppercase tracking-tighter">About Us</h1>
    </div>

    <!-- KONTEN UTAMA -->
    <main class="max-w-5xl mx-auto mt-12 p-6 w-full mb-20 text-center relative">
        
        <!-- Watermark Logo Transparan di Background -->
        <div class="absolute inset-0 flex justify-center items-center z-0 pointer-events-none opacity-[0.03]">
            <img src="{{ asset('image/logo.png') }}" alt="Watermark" class="w-[500px] object-contain">
        </div>

        <div class="relative z-10">
            <!-- Judul Selamat Datang -->
            <h2 class="text-4xl md:text-5xl font-black italic uppercase tracking-tighter mb-8">
                <span class="text-[#39AE1F]">Selamat Datang</span> 
                <span class="text-[#FFC107]">Di Bar Bar!</span>
            </h2>

            <!-- Teks Penjelasan -->
            <p class="text-gray-600 font-bold text-lg leading-relaxed mb-16 max-w-4xl mx-auto">
                Kami menyediakan berbagai makanan dan minuman favorit seperti es durian, mie ayam, es dawet, dan aneka camilan dengan rasa terbaik dan kualitas terjamin. Kami berkomitmen memberikan pengalaman kuliner yang mudah, cepat, dan menyenangkan dengan mengutamakan bahan berkualitas, pelayanan ramah, serta harga terjangkau. Kami juga terus berinovasi menghadirkan menu baru sesuai selera pelanggan.
            </p>

            <!-- Visi & Misi Grid (Dibuat gaya kotak membulat) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-14 text-left">
                
                <!-- VISI -->
                <div class="border-4 border-gray-100 rounded-[40px] p-6 shadow-lg bg-white hover:-translate-y-2 transition duration-300">
                    <img src="{{ asset('image/Outlet.jpg') }}" alt="Outlet BarBar" class="w-full h-64 object-cover rounded-[25px] mb-6">
                    <h3 class="text-[#39AE1F] text-3xl font-black mb-3 italic uppercase tracking-tighter">Visi:</h3>
                    <p class="text-gray-600 text-base font-bold leading-relaxed">
                        Menjadi pilihan utama masyarakat dalam menikmati makanan dan minuman berkualitas dengan porsi dan rasa yang benar-benar "Bar Bar".
                    </p>
                </div>

                <!-- MISI -->
                <div class="border-4 border-gray-100 rounded-[40px] p-6 shadow-lg bg-white hover:-translate-y-2 transition duration-300">
                    <img src="{{ asset('image/EsDawetMenu.png') }}" alt="Poster Es Dawet" class="w-full h-64 object-cover rounded-[25px] mb-6">
                    <h3 class="text-[#FFC107] text-3xl font-black mb-3 italic uppercase tracking-tighter">Misi:</h3>
                    <ul class="text-gray-600 text-base font-bold leading-relaxed list-disc pl-5 space-y-2">
                        <li>Menyediakan produk berkualitas tinggi.</li>
                        <li>Memberikan pelayanan terbaik dan ramah.</li>
                        <li>Terus berinovasi dalam menu sesuai selera.</li>
                    </ul>
                </div>

            </div>

            <!-- Pesan Penutup -->
            <div class="mt-20">
                <p class="font-black text-gray-700 text-xl italic uppercase tracking-tighter">
                    Terima kasih telah mempercayai kami. Gak Bar-Bar, Gak Enak!
                </p>
            </div>
        </div>
    </main>

    <!-- FOOTER KONSISTEN -->
    <footer class="w-full mt-auto">
        <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-3 items-center">
            <div class="space-y-1">
                <h4 class="font-black text-xl mb-4 italic uppercase">LINKS</h4>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/about">About Us</a></p>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/contact">Contact Us</a></p>
            </div>
            <div class="flex justify-center">
                <!-- Stempel Merah -->
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-28">
            </div>
            <div class="text-right flex flex-col items-end">
                <h4 class="font-black text-xl mb-4 italic uppercase">FOLLOW US</h4>
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
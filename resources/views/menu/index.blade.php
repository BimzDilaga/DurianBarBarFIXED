<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Bar Bar Es Duren</title>
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
            <li><a href="/menu" class="text-yellow-500 border-b-2 border-yellow-500 pb-1">Menu</a></li>
            <li><a href="/outlet" class="hover:text-yellow-500">Outlet</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
        </ul>
        <div class="text-[#39AE1F] text-4xl">
            <a href="/profile"><i class="fas fa-user-circle hover:scale-110 transition"></i></a>
        </div>
    </nav>

    <main>
        <!-- BANNER KUNING MENU -->
        <div class="bg-[#FFC107] w-full py-3 shadow-md text-center">
            <h1 class="text-white text-5xl font-black italic uppercase tracking-tighter m-0">MENU</h1>
        </div>

        <!-- Kategori Menu (Lingkaran Hijau) -->
        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4">
            
            <!-- Baris Atas (3 Item) -->
            <div class="flex flex-wrap justify-center gap-12 md:gap-20">
                <!-- Es Durian -->
                <a href="/menu/es-durian" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300">
                        <img src="{{ asset('image/EsDurianMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Es Durian</h3>
                </a>

                <!-- Mie Ayam -->
                <a href="/menu/mie-ayam" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300">
                        <img src="{{ asset('image/MieAyamMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Mie Ayam</h3>
                </a>

                <!-- Es Dawet -->
                <a href="/menu/es-dawet" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300">
                        <img src="{{ asset('image/EsDawetMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Es Dawet</h3>
                </a>
            </div>

            <!-- Baris Bawah (2 Item) -->
            <div class="flex flex-wrap justify-center gap-12 md:gap-28 mt-12 md:mt-16">
                <!-- Cemilan -->
                <a href="/menu/cemilan" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300">
                        <img src="{{ asset('image/CemilanMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Cemilan</h3>
                </a>

                <!-- Es Teler -->
                <a href="/menu/es-teler" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300">
                        <img src="{{ asset('image/EsTelerMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase italic tracking-tighter group-hover:text-[#39AE1F] transition">Es Teler</h3>
                </a>
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
                <img src="{{ asset('image/logo-stempel.png') }}" alt="Logo" class="h-28">
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
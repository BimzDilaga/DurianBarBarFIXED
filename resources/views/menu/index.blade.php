<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap');
        
        /* FLEXBOX SETUP BIAR FOOTER NEMPEL BAWAH */
        body { 
            font-family: 'Nunito', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh; 
            margin: 0; padding: 0; background-color: #ffffff; color: #333;
        }
        main { flex: 1; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

        /* HEADER & NAVBAR (SINKRON DENGAN WELCOME) */
        .top-line {
            width: 100%; height: 45px;
            background: linear-gradient(to bottom, #39AE1F, #8CFF00);
            position: relative; z-index: 99;
        }
        header { padding: 15px 0; background: white; border-bottom: 1px solid #eee; }
        .navbar { display: flex; justify-content: space-between; align-items: center; }
        .logo-area img { height: 70px; }
        nav ul { display: flex; list-style: none; gap: 25px; margin: 0; padding: 0; }
        nav ul li a { text-decoration: none; color: #555; font-weight: 800; font-size: 14px; text-transform: uppercase; transition: 0.3s;}
        nav ul li a:hover { color: #44AD24; }
        nav ul li a.active { color: #44AD24; border-bottom: 3px solid #44AD24; padding-bottom: 5px; }
        .user-profile i { font-size: 35px; color: #4CAF50; cursor: pointer; }

        /* STYLE KHUSUS HALAMAN MENU */
        .bg-yellow-barbar { background-color: #FFC107; }
        .circle-green { background-color: #44AD24; }
        
        /* FOOTER (SINKRON DENGAN WELCOME) */
        footer { padding: 50px 0 0 0; background: white; margin-top: 50px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; align-items: start; }
        .footer-links h4, .footer-social h4 { font-weight: 900; margin-bottom: 20px; }
        .footer-logo img { height: 90px; opacity: 0.4; filter: grayscale(1); margin: 0 auto; display: block; }
        .social-icons { display: flex; justify-content: flex-end; gap: 20px; font-size: 30px; }
        .pattern-bg { 
            height: 100px; margin-top: 30px;
            background-color: #fffbeb; 
            background-image: radial-gradient(#fde047 20%, transparent 20%); 
            background-size: 30px 30px; 
        }
    </style>
</head>
<body>

    <!-- HEADER SAMA PERSIS DENGAN WELCOME -->
    <div class="top-line"></div>
    <header>
        <div class="container navbar">
            <div class="logo-area">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Barbar">
            </div>
            <nav>
                <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/menu" class="active">Menu</a></li>
    <li><a href="/outlet">Outlet</a></li>
    <li><a href="/About">About Us</a></li>
    <li><a href="/contact">Contact Us</a></li>
</ul>
            </nav>
            <div class="user-profile">
    <i class="fas fa-circle-user"></i>
</div>
        </div>
    </header>

    <main>
        <!-- Banner Kuning MENU -->
        <div class="bg-yellow-barbar w-full py-4 shadow-md">
            <h1 class="text-center text-white text-5xl font-black italic tracking-widest uppercase m-0">MENU</h1>
        </div>

        <!-- Wadah Kategori (Lingkaran Hijau) yang dirapatkan -->
        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4">
            
            <!-- Baris Atas (3 Item) -->
            <div class="flex flex-wrap justify-center gap-12 md:gap-20">
                
                <!-- Es Durian -->
                <a href="/menu/es-durian" class="flex flex-col items-center group transition">
                    <div class="circle-green w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                        <img src="{{ asset('image/EsDurianMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md">
                    </div>
                    <h3 class="mt-5 text-xl md:text-2xl font-black text-gray-700 uppercase italic group-hover:text-[#44AD24] transition">Es Durian</h3>
                </a>

                <!-- Mie Ayam -->
                <a href="/menu/mie-ayam" class="flex flex-col items-center group transition">
                    <div class="circle-green w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                        <img src="{{ asset('image/MieAyamMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md">
                    </div>
                    <h3 class="mt-5 text-xl md:text-2xl font-black text-gray-700 uppercase italic group-hover:text-[#44AD24] transition">Mie Ayam</h3>
                </a>

                <!-- Es Dawet -->
                <a href="/menu/es-dawet" class="flex flex-col items-center group transition">
                    <div class="circle-green w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                        <img src="{{ asset('image/EsDawetMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md">
                    </div>
                    <h3 class="mt-5 text-xl md:text-2xl font-black text-gray-700 uppercase italic group-hover:text-[#44AD24] transition">Es Dawet</h3>
                </a>
            </div>

            <!-- Baris Bawah (2 Item) -->
            <div class="flex flex-wrap justify-center gap-12 md:gap-28 mt-12 md:mt-16">
                
                <!-- Cemilan -->
                <a href="/menu/cemilan" class="flex flex-col items-center group transition">
                    <div class="circle-green w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                        <img src="{{ asset('image/CemilanMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md">
                    </div>
                    <h3 class="mt-5 text-xl md:text-2xl font-black text-gray-700 uppercase italic group-hover:text-[#44AD24] transition">Cemilan</h3>
                </a>

                <!-- Es Teler -->
                <a href="/menu/es-teler" class="flex flex-col items-center group transition">
                    <div class="circle-green w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                        <img src="{{ asset('image/EsTelerMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md">
                    </div>
                    <h3 class="mt-5 text-xl md:text-2xl font-black text-gray-700 uppercase italic group-hover:text-[#44AD24] transition">Es Teler</h3>
                </a>
            </div>

        </div>
    </main>

    <!-- FOOTER SAMA PERSIS DENGAN WELCOME -->
    <footer>
        <div class="container footer-grid">
            <div class="footer-links">
                <h4>LINKS</h4>
                <p class="text-gray-500 font-bold mb-2">About Us</p>
                <p class="text-gray-500 font-bold">Contact Us</p>
            </div>
            <div class="footer-logo">
                <img src="{{ asset('image/logo.png') }}" alt="Footer Logo">
            </div>
            <div class="footer-social">
                <h4>FOLLOW US</h4>
                <div class="social-icons">
                    <i class="fab fa-instagram" style="color: #E1306C;"></i>
                    <i class="fab fa-tiktok" style="color: #000000;"></i>
                    <i class="fab fa-whatsapp" style="color: #25D366;"></i>
                </div>
            </div>
        </div>
        <div class="pattern-bg"></div>
    </footer>

</body>
</html>
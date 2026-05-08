<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outlet - Durian Bar Bar</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        /* 1. PENGATURAN UMUM */
        body {
            display: flex; flex-direction: column; min-height: 100vh;
            font-family: 'Montserrat', sans-serif; 
            background-color: #ffffff; color: #000000;
            overflow-x: hidden; 
        }
        main { flex: 1; }

        /* 2. TOP BAR & LOGO GLOW (Sama persis kayak Home) */
        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; position: relative; z-index: 99;
        }
        .logo-glow {
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }

        /* 3. KHUSUS HALAMAN OUTLET */
        .banner-outlet {
            background-color: #FFC107; /* Kuning Bar Bar */
            width: 100%; text-align: center; padding: 20px 0;
        }
        .banner-outlet h1 {
            color: #ffffff; font-size: 40px; font-weight: 900; letter-spacing: 3px; margin: 0;
        }
        
        .search-box-wrapper {
            border: 1px solid #aaa; border-radius: 15px; padding: 10px 20px;
            display: flex; align-items: center; max-width: 900px; margin: 40px auto;
        }
        .search-input { 
            flex: 1; border: none; outline: none; font-size: 15px; color: #666; padding: 5px; 
        }
        
        .map-wrapper {
            max-width: 900px; margin: 0 auto; height: 450px; 
            border-radius: 20px; overflow: hidden; 
            box-shadow: 8px 8px 0px #b0b4b8; background-color: #f0f0f0;
        }
        .map-wrapper iframe {
            width: 100%; height: 100%; border: none;
        }
    </style>
</head>

<body class="bg-white">

    <div class="top-line"></div>


    <header class="bg-white py-6 relative z-30">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            
            <div class="logo-glow">
                <a href="/"><img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[100px] object-contain"></a>
            </div>

            <nav class="hidden md:block">
                <ul class="flex space-x-12 text-[18px] font-[900] text-gray-800 uppercase tracking-tight">
                    <li><a href="/" class="hover:text-[#39AE1F] transition">Home</a></li>
                    <li><a href="/menu" class="hover:text-[#39AE1F] transition">Menu</a></li>
                    <li><a href="/outlet" class="text-[#39AE1F] border-b-4 border-[#39AE1F] pb-1">Outlet</a></li>
                    <li><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></li>
                    <li><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></li>
                </ul>
            </nav>
            
            <div class="user-profile text-[#39AE1F] text-[55px] relative z-50">
                @auth
                    <a href="/profile" class="block cursor-pointer relative z-50">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300"></i>
                    </a>
                @else
                    <a href="/login" class="block cursor-pointer relative z-50">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300 text-gray-400"></i>
                    </a>
                @endauth
            </div>

        </div>
    </header>


    <main>
        
        <div class="banner-outlet relative z-20">
            <h1>OUTLET</h1>
        </div>

        <div class="px-6 mb-20">
            <div class="search-box-wrapper relative z-20 bg-white">
                <span class="font-bold text-[15px] mr-4 text-gray-800">Find Location:</span>
                <input type="text" class="search-input" placeholder="Enter Search Location...">
                <button class="bg-gray-200 border border-gray-400 rounded-lg px-4 py-1 font-bold text-gray-600 hover:bg-gray-300 transition">X</button>
            </div>

            <div class="map-wrapper relative z-20">
                <iframe src="https://www.google.com/maps/d/embed?mid=1JLfDQrD4Bk60tgVY1SRBLXgp7nXYgHA&ehbc=2E312F" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

    </main>


    <footer class="mt-auto">
        <div class="max-w-5xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 items-center">
            
            <div class="space-y-4">
                <h4 class="font-black text-2xl uppercase text-black">LINKS</h4>
                <div class="flex flex-col space-y-3">
                    <a href="/about" class="font-bold text-gray-500 text-[17px] hover:text-[#39AE1F] transition">About Us</a>
                    <a href="/contact" class="font-bold text-gray-500 text-[17px] hover:text-[#39AE1F] transition">Contact Us</a>
                </div>
            </div>
            
            <div class="flex justify-center">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-28 object-contain">
            </div>
            
            <div class="text-right flex flex-col items-end space-y-4">
                <h4 class="font-black text-2xl uppercase text-black">FOLLOW US</h4>
                <div class="flex gap-5 text-3xl">
                    <i class="fab fa-instagram text-[#E1306C] hover:scale-110 transition cursor-pointer"></i>
                    <i class="fab fa-tiktok text-black hover:scale-110 transition cursor-pointer"></i>
                    <i class="fab fa-whatsapp text-[#25D366] hover:scale-110 transition cursor-pointer"></i>
                </div>
            </div>

        </div>

        <div style="width: 100%; height: 150px; background-image: url('{{ asset('image/footer.png') }}'); background-repeat: repeat-x; background-size: contain; background-position: bottom;"></div>
    </footer>

</body>
</html>
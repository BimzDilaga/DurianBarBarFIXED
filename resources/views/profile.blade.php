<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile - Bar Bar Es Duren</title>
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
        /* Icon user profile yang aktif */
        .user-profile a { font-size: 35px; color: #44AD24; transition: transform 0.3s; display: block; }
        .user-profile a:hover { transform: scale(1.1); }

        /* STYLE KHUSUS HALAMAN PROFILE */
        .bg-yellow-barbar { background-color: #FFC107; }
        
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

    <!-- HEADER -->
    <div class="top-line"></div>
    <header>
        <div class="container navbar">
            <div class="logo-area">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Barbar">
            </div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/menu">Menu</a></li>
                    <li><a href="#">Outlet</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <a href="/profile"><i class="fas fa-circle-user hover:scale-110 transition duration-300"></i></a>
            </div>
        </div>
    </header>

    <main>
        <!-- Banner Kuning PROFILE -->
        <div class="bg-yellow-barbar w-full py-4 shadow-md">
            <h1 class="text-center text-white text-5xl font-black uppercase m-0 tracking-wide">Your Profile</h1>
        </div>

        <!-- Konten Profil -->
        <div class="max-w-4xl mx-auto mt-20 mb-20 px-4">
            <div class="flex flex-col md:flex-row items-center md:items-start justify-center gap-16 md:gap-32">
                
                <!-- Icon Hijau Raksasa di Kiri -->
                <div class="text-[#00a82d] text-[12rem] leading-none drop-shadow-md">
                    <i class="fa-solid fa-circle-user"></i>
                </div>

                <!-- Teks Detail di Kanan -->
                <div class="flex-1 w-full max-w-md pt-4 relative">
                    <div class="space-y-6 text-gray-800">
                        <div>
                            <h4 class="font-black text-lg">Name:</h4>
                            <!-- Nama asli user -->
                            <p class="font-bold text-gray-600 text-sm mt-1">{{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            <h4 class="font-black text-lg">Email:</h4>
                            <!-- Email asli user -->
                            <p class="font-bold text-gray-600 text-sm mt-1">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <h4 class="font-black text-lg">Address:</h4>
                            <p class="font-bold text-gray-600 text-sm mt-1">Jl. yang benar</p>
                        </div>
                        <div>
                            <h4 class="font-black text-lg">Password:</h4>
                            <p class="font-bold text-gray-600 text-sm mt-1">****************</p>
                        </div>
                        
                        <!-- Tambahan Tombol Logout -->
                        <div class="pt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white font-black py-1.5 px-6 rounded-full text-sm hover:bg-red-700 transition shadow-sm">
                                    Logout <i class="fas fa-sign-out-alt ml-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Garis Bawah Hitam Ala Desainmu -->
                    <hr class="border-t border-gray-600 mt-6 w-[120%] -ml-10">
                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container footer-grid">
            <div class="footer-links">
                <h4>LINKS</h4>
                <p class="text-gray-500 font-bold mb-2 text-sm">About Us</p>
                <p class="text-gray-500 font-bold text-sm"><a href="/contact">Contact Us</a></p>
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
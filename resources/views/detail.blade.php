<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama }} - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap');
        
        body { 
            font-family: 'Nunito', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh; 
            margin: 0; padding: 0; background-color: #ffffff; color: #333;
        }
        main { flex: 1; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

        /* HEADER & NAVBAR */
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
        .user-profile a { font-size: 35px; color: #44AD24; transition: transform 0.3s; display: block; }
        .user-profile a:hover { transform: scale(1.1); }

        .bg-yellow-barbar { background-color: #FFC107; }
        
        /* FOOTER */
        footer { padding: 50px 0 0 0; background: white; margin-top: 50px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; align-items: start; }
        .footer-links h4, .footer-social h4 { font-weight: 900; margin-bottom: 20px; }
        .footer-logo img { height: 90px; opacity: 0.4; filter: grayscale(1); margin: 0 auto; display: block; }
        .social-icons { display: flex; justify-content: flex-start; gap: 20px; font-size: 30px; }
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
        <!-- Banner Kuning dengan Tombol Back -->
        <div class="bg-yellow-barbar w-full py-4 shadow-sm relative flex items-center justify-center">
            <a href="javascript:history.back()" class="absolute left-10 md:left-20 bg-[#39AE1F] text-white px-8 py-2 rounded-full font-black text-xl hover:bg-green-700 transition shadow-md">
                Back
            </a>
            <!-- Nama produk otomatis dari database -->
            <h1 class="text-center text-white text-4xl md:text-5xl font-black uppercase m-0 tracking-wide">{{ $product->nama }}</h1>
        </div>

        <!-- Detail Konten -->
        <div class="max-w-5xl mx-auto mt-16 mb-20 px-4">
            <div class="flex flex-col md:flex-row gap-12 items-start">
                
                <!-- Kiri: Card Gambar Produk -->
                <div class="w-full md:w-1/3">
                    <div class="border-2 border-gray-400 rounded-[30px] p-6 text-center shadow-sm">
                        <!-- Gambar otomatis dari database -->
                        <img src="{{ asset('image/' . $product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-auto object-cover rounded-2xl mb-6">
                        
                        <hr class="border-t border-gray-400 mb-4 w-4/5 mx-auto">
                        
                        <h3 class="font-black text-2xl text-gray-700">{{ $product->nama }}</h3>
                    </div>
                </div>

                <!-- Kanan: Detail Info Produk -->
                <div class="w-full md:w-2/3 pt-4">
                    <h2 class="text-4xl font-black text-[#44AD24] mb-2">{{ $product->nama }}</h2>
                    
                    <!-- Garis Atas Harga -->
                    <hr class="border-t border-gray-400 mb-4 w-full">
                    
                    <!-- Harga dari kolom harga_baru -->
                    <h1 class="text-5xl md:text-6xl font-black text-[#44AD24] mb-6">Rp.{{ number_format($product->harga_baru, 0, ',', '.') }}</h1>
                    
                    <!-- Deskripsi komposisi -->
                    <p class="font-bold text-gray-600 leading-relaxed text-lg max-w-2xl">
                        {{ $product->deskripsi }}
                    </p>
                    
                    <!-- Garis Bawah Deskripsi -->
                    <hr class="border-t border-gray-400 mt-8 w-full">
                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container footer-grid">
            <div class="footer-links">
                <p class="font-black text-gray-600 mb-2 text-sm"><a href="#">About Us</a></p>
                <p class="font-black text-gray-600 text-sm"><a href="/contact">Contact Us</a></p>
            </div>
            <div class="footer-logo">
                <img src="{{ asset('image/logo.png') }}" alt="Footer Logo">
            </div>
            <div class="footer-social">
                <h4 class="font-black text-xl mb-4 text-gray-900">FOLLOW US</h4>
                <div class="social-icons justify-start">
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
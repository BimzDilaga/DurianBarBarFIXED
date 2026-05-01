<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap');
        body { font-family: 'Nunito', sans-serif; display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
        
        /* HEADER & NAVBAR (SINKRON DENGAN WELCOME) */
        .top-line {
            width: 100%; height: 45px;
            background: linear-gradient(to bottom, #39AE1F, #8CFF00);
            position: relative; z-index: 99;
        }
        header { padding: 15px 0; background: white; border-bottom: 1px solid #eee; }
        .navbar { display: flex; justify-content: space-between; align-items: center; max-width: 1100px; margin: 0 auto; padding: 0 20px;}
        .logo-area img { height: 70px; }
        nav ul { display: flex; list-style: none; gap: 25px; margin: 0; padding: 0; }
        nav ul li a { text-decoration: none; color: #555; font-weight: 800; font-size: 14px; text-transform: uppercase; transition: 0.3s;}
        nav ul li a:hover { color: #44AD24; }
        nav ul li a.active { color: #44AD24; border-bottom: 3px solid #44AD24; padding-bottom: 5px; }
        .user-profile i { font-size: 35px; color: #4CAF50; cursor: pointer; }

        .bg-yellow-barbar { background-color: #FFC107; }
        .bg-green-dark { background-color: #38A12A; }
        .bg-green-light { background-color: #8CFF00; }
        
        /* FOOTER (SINKRON DENGAN WELCOME) */
        footer { padding: 50px 0 0 0; background: white; margin-top: 50px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; align-items: start; max-width: 1100px; margin: 0 auto; padding: 0 20px;}
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
<body class="bg-white">

    <!-- HEADER SAMA PERSIS DENGAN WELCOME -->
    <div class="top-line"></div>
    <header>
        <div class="navbar">
            <div class="logo-area">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Barbar">
            </div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/menu" class="active">Menu</a></li>
                    <li><a href="#">Outlet</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>
            <div class="user-profile">
    <i class="fas fa-circle-user"></i>
</div>
        </div>
    </header>

    <main>
        <!-- Banner Kuning + Tombol Back -->
        <div class="bg-yellow-barbar w-full py-3 relative shadow-md flex justify-center items-center">
            <!-- Tombol Back -->
            <a href="/menu" class="absolute left-8 md:left-20 bg-[#44ad24] text-white px-6 py-1.5 rounded-full font-black text-lg border-2 border-white shadow-sm hover:bg-green-700 transition">
                Back
            </a>
            <h1 class="text-white text-4xl font-black italic tracking-widest uppercase m-0">MENU</h1>
        </div>

        <!-- Container Utama (Box Hijau) -->
        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4">
            <div class="bg-green-dark rounded-[40px] p-8 pt-12 relative shadow-xl">
                
                <!-- Badge Judul Kategori -->
                <div class="absolute -top-7 left-1/2 transform -translate-x-1/2 bg-green-light px-16 py-2 rounded-full shadow-md">
                    <h2 class="text-3xl font-black text-gray-800">{{ $title }}</h2>
                </div>

                <!-- List Produk -->
                <div class="flex flex-col gap-6 mt-4">
                    @forelse($products as $item)
                    <div class="bg-white rounded-[25px] p-5 flex flex-col md:flex-row gap-6 items-stretch shadow-md">
                        <!-- Gambar -->
                        <div class="bg-[#FFC107] rounded-2xl w-full md:w-40 h-40 flex-shrink-0 flex items-center justify-center p-2">
                            <img src="{{ asset('image/' . $item->gambar) }}" class="max-h-full object-contain drop-shadow-md">
                        </div>
                        <!-- Info -->
                        <div class="flex-1 flex flex-col justify-between py-1">
                            <div>
                                <h3 class="text-2xl font-black text-gray-700">{{ $item->nama }}</h3>
                                <p class="text-xs text-gray-600 mt-2 font-bold leading-relaxed md:pr-4">{{ $item->deskripsi }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-[#FFC107] font-black text-xl">Rp. {{ number_format($item->harga_baru, 0, ',', '.') }}</span>
                                <!-- Tombol Buy sekarang mengarah ke Detail Produk -->
<a href="/detail/{{ $item->id }}" class="bg-[#44ad24] text-white px-6 py-1.5 rounded-full font-black text-sm flex items-center gap-2 hover:bg-green-700 transition shadow-sm">
    <i class="fas fa-search"></i> Detail
</a>

<!-- Contoh membungkus Nama Produk dengan Link Detail -->
<a href="/detail/{{ $item->id }}">
    <h3 class="text-2xl font-black text-gray-700 hover:text-[#44ad24] transition cursor-pointer">
        {{ $item->nama }}
    </h3>
</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-[25px] p-8 text-center shadow-md">
                        <h3 class="text-xl font-bold text-gray-500">Menu untuk kategori {{ $title }} belum tersedia.</h3>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
        
    </main>
    

    <!-- FOOTER SAMA PERSIS DENGAN WELCOME -->
    <footer>
        <div class="footer-grid">
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
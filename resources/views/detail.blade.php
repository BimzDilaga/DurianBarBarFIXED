<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0; overflow-x: hidden;
        }
        main { flex: 1; }

        /* TOP LINE BAR BAR (TEXTURE + GRADIENT) */
        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat;
            position: relative; z-index: 99;
        }

        /* CARD PRODUK (LURUS & BERSIH) */
        .product-card-box {
            border: 2px solid #e5e7eb;
            border-radius: 40px;
            padding: 25px;
            width: 100%;
            max-width: 350px;
        }
        .inner-img-box {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 20px;
            margin-bottom: 15px;
        }

        /* FOOTER LOOPING (PATTERN KREATIVE) */
        .footer-loop {
            width: 100%; height: 150px;
            background-image: url('{{ asset('image/footer.png') }}');
            background-repeat: repeat-x;
            background-size: contain;
            background-position: bottom;
        }
    </style>
</head>
<body class="bg-white">

    <!-- TOP LINE -->
    <div class="top-line"></div>

    <!-- NAVBAR -->
    <nav class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center w-full">
        <img src="{{ asset('image/logo.png') }}" alt="Bar Bar Es Duren" class="h-16">
        <ul class="hidden md:flex gap-8 text-gray-800 font-black text-xs uppercase tracking-widest">
            <li><a href="/" class="hover:text-yellow-500">Home</a></li>
            <li><a href="/menu" class="hover:text-yellow-500">Menu</a></li>
            <li><a href="/outlet" class="hover:text-yellow-500">Outlet</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
        </ul>
        <div class="text-[#39AE1F] text-4xl">
            <i class="fas fa-user-circle"></i>
        </div>
    </nav>

    <!-- BANNER KUNING (LURUS) -->
    <div class="bg-[#FFC107] w-full py-2 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 flex items-center">
            <a href="javascript:history.back()" class="bg-[#39AE1F] text-white px-8 py-1 rounded-full font-black text-lg border-2 border-white italic uppercase">
                Back
            </a>
            <h1 class="flex-1 text-center text-white text-4xl font-black italic uppercase tracking-tighter">
                {{ $product->nama }}
            </h1>
        </div>
    </div>

    <!-- MAIN CONTENT (DILURUSKAN) -->
    <main class="max-w-6xl mx-auto px-6 mt-16 w-full mb-20">
        <div class="flex flex-col md:flex-row gap-20 items-start">
            
            <!-- SISI KIRI: Box Gambar Produk -->
            <div class="product-card-box">
                <div class="inner-img-box">
                    <img src="{{ asset('image/' . $product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-auto rounded-3xl">
                </div>
                <h3 class="text-center font-black text-gray-500 text-xl italic uppercase tracking-tighter">
                    {{ $product->nama }}
                </h3>
            </div>

            <!-- SISI KANAN: Detail Teks -->
            <div class="flex-1">
                <h2 class="text-[#39AE1F] text-5xl font-black italic uppercase tracking-tighter mb-2">
                    {{ $product->nama }}
                </h2>
                <hr class="border-t-2 border-gray-300 mb-6">
                
                <p class="text-[#39AE1F] text-7xl font-black tracking-tighter mb-6">
                    Rp.{{ number_format($product->harga_baru, 0, ',', '.') }}
                </p>
                
                <p class="text-gray-600 font-bold text-lg leading-relaxed max-w-xl mb-12">
                    {{ $product->deskripsi }}
                </p>

                <hr class="border-t-2 border-gray-300 mb-8">
                
                <a href="/checkout/{{ $product->id }}" class="bg-[#39AE1F] hover:bg-green-700 text-white px-12 py-4 rounded-[25px] font-black shadow-lg transition inline-block text-xl italic uppercase tracking-widest">
                    Checkout Now!
                </a>
            </div>
        </div>
    </main>

    <!-- FOOTER 3 KOLOM -->
    <footer class="w-full mt-auto">
        <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-3 items-start">
            <!-- Col 1: Links -->
            <div class="space-y-3">
                <h4 class="font-black text-xl mb-4 italic">LINKS</h4>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/about">About Us</a></p>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/contact">Contact Us</a></p>
            </div>
            
            <!-- Col 2: Logo Tengah -->
            <div class="flex justify-center">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-28 opacity-90">
            </div>
            
            <!-- Col 3: Follow Us -->
            <div class="text-right flex flex-col items-end">
                <h4 class="font-black text-xl mb-4 italic">FOLLOW US</h4>
                <div class="flex gap-4 text-3xl">
                    <i class="fab fa-instagram text-pink-600"></i>
                    <i class="fab fa-tiktok text-black"></i>
                    <i class="fab fa-whatsapp text-green-500"></i>
                </div>
            </div>
        </div>
        
        <!-- Pattern Bawah Looping -->
        <div class="footer-loop"></div>
    </footer>

</body>
</html>
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
            color: #000000;
        }
        main { flex: 1; }

        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; position: relative; z-index: 99;
        }

        .product-card-box {
            border: 2px solid #e5e7eb; border-radius: 40px;
            padding: 25px; width: 100%; max-width: 350px; background-color: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .inner-img-box {
            border-bottom: 2px solid #e5e7eb; padding-bottom: 20px; margin-bottom: 15px;
        }

        .footer-loop {
            width: 100%; height: 150px;
            background-image: url("{{ asset('image/footer.png') }}");
            background-repeat: repeat-x; background-size: contain; background-position: bottom;
        }
    </style>
</head>
<body class="bg-white">

    <div class="top-line"></div>

    <header class="bg-white py-6 relative z-30">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            <div class="relative flex justify-center items-center">
                <a href="/"><img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-[100px] object-contain"></a>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-12 text-[18px] font-[900] text-gray-800 uppercase tracking-tight">
                    <li><a href="/" class="hover:text-[#39AE1F] transition">Home</a></li>
                    <li><a href="/menu" class="text-[#39AE1F] border-b-4 border-[#39AE1F] pb-1">Menu</a></li>
                    <li><a href="/outlet" class="hover:text-[#39AE1F] transition">Outlet</a></li>
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

    <div class="bg-[#FFC107] w-full py-3 shadow-sm relative z-10">
        <div class="max-w-6xl mx-auto px-6 flex items-center">
            <a href="javascript:history.back()" class="bg-[#39AE1F] text-white px-8 py-2 rounded-full font-black text-lg border-2 border-white italic uppercase hover:bg-green-700 transition shadow-md">
                Back
            </a>
            <h1 class="flex-1 text-center text-white text-4xl font-black italic uppercase tracking-tighter" style="text-shadow: 1px 1px 0px rgba(0,0,0,0.2);">
                {{ $product->nama }}
            </h1>
        </div>
    </div>

    <main class="max-w-6xl mx-auto px-6 mt-16 w-full mb-24 relative z-20">
        <div class="flex flex-col md:flex-row gap-20 items-start">
            <div class="product-card-box">
                <div class="inner-img-box">
                    <img src="{{ asset('image/' . $product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-auto rounded-3xl object-contain">
                </div>
                <h3 class="text-center font-black text-gray-500 text-xl italic uppercase tracking-tighter">
                    {{ $product->nama }}
                </h3>
            </div>

            <div class="flex-1">
                <h2 class="text-[#39AE1F] text-5xl font-black italic uppercase tracking-tighter mb-2">
                    {{ $product->nama }}
                </h2>
                <hr class="border-t-2 border-gray-300 mb-6">
                <p class="text-[#39AE1F] text-7xl font-black tracking-tighter mb-6">
                    Rp.{{ number_format($product->harga_baru, 0, ',', '.') }}
                </p>
                <p class="text-gray-700 font-bold text-lg leading-relaxed max-w-xl mb-12">
                    {{ $product->deskripsi }}
                </p>
                   <p class="text-gray-700 font-bold text-lg leading-relaxed max-w-xl mb-12">
                    {{ $product->deskripsi_detail }}
                </p>
                <hr class="border-t-2 border-gray-300 mb-8">
                
                <!-- INI DIA YANG DIBENERIN! Linknya sekarang lari ke /beli/ -->
                <a href="/beli/{{ $product->id }}" class="bg-[#39AE1F] hover:bg-green-700 text-white px-12 py-4 rounded-[25px] font-black shadow-lg transition inline-block text-xl italic uppercase tracking-widest hover:-translate-y-1">
                    Checkout Now!
                </a>

            </div>
        </div>
    </main>

    <footer class="w-full mt-auto">
        <div class="max-w-5xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 items-center">
            <div class="space-y-4">
                <h4 class="font-black text-2xl uppercase text-black">LINKS</h4>
                <div class="flex flex-col space-y-3">
                    <a href="/about" class="font-bold text-gray-500 text-[17px] hover:text-[#39AE1F] transition">About Us</a>
                    <a href="/contact" class="font-bold text-gray-500 text-[17px] hover:text-[#39AE1F] transition">Contact Us</a>
                </div>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-28 object-contain">
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
        <div class="footer-loop"></div>
    </footer>

</body>
</html>
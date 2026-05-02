<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

    .footer-loop {
        width: 100%; 
        height: 120px;
        background-image: url('{{ asset('image/footer.png') }}');
        background-repeat: repeat-x;
        background-size: contain;
        background-position: bottom;
    }
</style>
</head>
<body>

    <!-- TOP LINE & NAVBAR -->
    <div class="top-line"></div>
    <nav class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center w-full">
        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-16">
        <ul class="hidden md:flex gap-8 text-gray-800 font-bold text-xs uppercase">
            <li><a href="/">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/outlet">Outlet</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact Us</a></li>
        </ul>
        <div class="text-[#39AE1F] text-4xl"><i class="fas fa-user-circle"></i></div>
    </nav>

    <!-- BANNER KUNING -->
    <div class="bg-[#FFC107] w-full py-3 shadow-md text-center">
        <h1 class="text-white text-5xl font-black italic uppercase tracking-tighter">Checkout Page</h1>
    </div>

    <!-- MAIN CONTENT -->
    <main class="max-w-5xl mx-auto mt-10 p-6 w-full mb-20">
        <h2 class="text-[#8CFF00] text-6xl font-black mb-10 italic uppercase tracking-tighter">Checkout</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            
            <!-- KIRI: Payment Detail -->
            <div>
                <h3 class="text-xl font-bold text-gray-500 mb-1">Payment Detail</h3>
                <div class="w-3/4 border-t-2 border-gray-400 mb-6"></div>
                
                <div class="border-2 border-gray-300 rounded-[30px] p-8 space-y-6">
                    @php
                        $payments = [
                            ['name' => 'Card', 'img' => 'https://upload.wikimedia.org/wikipedia/commons/d/d6/Visa_2021.svg'],
                            ['name' => 'M-banking', 'img' => 'https://upload.wikimedia.org/wikipedia/commons/e/e4/BCA_logo.svg'],
                            ['name' => 'E-Wallet', 'img' => 'https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg'],
                            ['name' => 'Qris', 'img' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg']
                        ];
                    @endphp

                    @foreach($payments as $p)
                    <div class="flex items-center gap-6">
                        <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="w-14 h-8 object-contain">
                        <div>
                            <span class="font-bold text-gray-700 block text-base">{{ $p['name'] }}</span>
                            <button class="bg-[#64D521] text-white px-7 py-0.5 rounded-sm font-black text-xs hover:bg-green-600 transition uppercase">Pay</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- KANAN: Product Detail -->
            <div>
                <h3 class="text-xl font-bold text-gray-500 mb-1">Product Detail</h3>
                <div class="w-full border-t-2 border-gray-400 mb-6"></div>
                
                <div class="flex items-start gap-6">
                    <!-- Box Kuning Produk -->
                    <div class="bg-[#FFC107] p-3 rounded-2xl w-28 h-28 flex items-center justify-center shadow-md">
                        <img src="{{ asset('image/' . $product->gambar) }}" class="max-h-full rounded-lg">
                    </div>
                    
                    <!-- Nama & Harga -->
                    <div>
                        <h4 class="text-3xl font-black text-gray-600 border-b-2 border-gray-200 inline-block mb-1">{{ $product->nama }}</h4>
                        <p class="text-[#FFC107] text-3xl font-black">Rp. {{ number_format($product->harga_baru, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Total Section -->
                <div class="mt-32">
                    <div class="w-full border-t-4 border-gray-300 mb-4"></div>
                    <div class="flex justify-end items-center gap-3">
                        <span class="text-5xl font-black text-gray-600 italic uppercase">Total:</span>
                        <span class="text-[#FFC107] text-5xl font-black tracking-tighter">Rp. {{ number_format($product->harga_baru, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="w-full mt-auto">
        <div class="max-w-5xl mx-auto px-6 py-10 grid grid-cols-3 items-center">
            <div class="space-y-1 text-sm font-bold text-gray-500 uppercase">
                <h4 class="font-black text-xl text-black mb-4 italic">LINKS</h4>
                <p><a href="#">About Us</a></p>
                <p><a href="/contact">Contact Us</a></p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('image/logo-stempel.png') }}" alt="Stamp" class="h-24">
            </div>
            <div class="text-right">
                <h4 class="font-black text-xl text-black mb-4 italic">FOLLOW US</h4>
                <div class="flex gap-4 text-3xl justify-end">
                    <i class="fab fa-instagram text-pink-600"></i>
                    <i class="fab fa-tiktok text-black"></i>
                    <i class="fab fa-whatsapp text-green-500"></i>
                </div>
            </div>
        </div>
        <div class="footer-loop"></div>
    </footer>

</body>
</html>
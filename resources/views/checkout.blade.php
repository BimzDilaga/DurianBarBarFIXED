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
    
    .top-line {
        width: 100%; 
        height: 45px;
        background-image: 
            url("{{ asset('image/texture.png') }}"), 
            linear-gradient(to bottom, #39AE1F, #8CFF00);
        background-repeat: repeat;
        background-size: auto; 
        position: relative; 
        z-index: 99;
    }

    .logo-glow {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .logo-glow::before {
        content: '';
        position: absolute;
        width: 130px; height: 130px;
        background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        z-index: -1;
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

    <div class="top-line"></div>

    <header class="bg-white py-6 relative z-30 w-full">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            <div class="logo-glow">
                <a href="/"><img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[100px] object-contain"></a>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-12 text-[18px] font-[900] text-gray-800 uppercase tracking-tight">
                    <li><a href="/" class="hover:text-[#39AE1F] transition">Home</a></li>
                    <li><a href="/menu" class="hover:text-[#39AE1F] transition">Menu</a></li>
                    <li><a href="/outlet" class="hover:text-[#39AE1F] transition">Outlet</a></li>
                    <li><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></li>
                    <li><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></li>
                </ul>
            </nav>
            <div class="user-profile text-[55px] relative z-50">
                @auth
                    <a href="/profile" class="block cursor-pointer relative z-50 text-[#39AE1F]">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300"></i>
                    </a>
                @else
                    <a href="/login" class="block cursor-pointer relative z-50 text-gray-400">
                        <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300"></i>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <div class="bg-[#FFC107] w-full py-4 shadow-md text-center">
        <h1 class="text-white text-[45px] font-black tracking-tighter m-0">Checkout Page</h1>
    </div>

    <main class="max-w-5xl mx-auto mt-10 p-6 w-full mb-20">
        <h2 class="text-[#39AE1F] text-5xl font-black mb-10 tracking-tighter">Checkout</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            
            <!-- KIRI: Payment Detail -->
            <div>
                <h3 class="text-xl font-black text-gray-500 mb-2">Payment Detail</h3>
                <div class="w-full border-t-2 border-gray-400 mb-6"></div>
                
                <div class="border-[3px] border-gray-200 rounded-[25px] p-6 space-y-6">
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
                        <div class="w-20 flex justify-center">
                            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="max-h-8 object-contain">
                        </div>
                        <div class="flex flex-col items-start gap-1">
                            <span class="font-black text-gray-600 text-lg">{{ $p['name'] }}</span>
                            <button class="bg-[#5cd61e] text-white px-8 py-1 rounded-sm font-black text-sm hover:bg-green-600 transition shadow-sm">Pay</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- KANAN: Product Detail -->
            <div>
                <h3 class="text-xl font-black text-gray-500 mb-2">Product Detail</h3>
                <div class="w-full border-t-2 border-gray-400 mb-6"></div>
                
                @php $totalHarga = 0; @endphp

                <!-- 1. Looping Keranjang Belanja -->
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php $totalHarga += $details['harga_baru'] * $details['quantity']; @endphp
                        
                        <div class="flex items-start gap-6 mb-8">
                            <div class="bg-[#FFC107] p-2 rounded-2xl w-[100px] h-[100px] flex items-center justify-center shadow-md flex-shrink-0">
                                <img src="{{ asset('image/' . $details['gambar']) }}" alt="{{ $details['nama'] }}" class="max-h-full rounded-lg object-contain">
                            </div>
                            <div class="flex flex-col">
                                <h4 class="text-2xl font-black text-gray-600 border-b-[3px] border-gray-200 pb-1 mb-1 inline-block">{{ $details['nama'] }}</h4>
                                <p class="text-[#FFC107] text-2xl font-black">
                                    Rp. {{ number_format($details['harga_baru'], 0, ',', '.') }}
                                </p>
                                <div class="flex items-center bg-[#39AE1F] text-white rounded-full w-[90px] mt-2 px-2 py-1 justify-between shadow-sm">
                                    <a href="/kurang/{{ $id }}" class="hover:scale-110 transition"><i class="fas fa-minus-circle text-[#FFC107] text-lg"></i></a>
                                    <span class="font-black text-sm">{{ $details['quantity'] }}</span>
                                    <a href="/beli/{{ $id }}" class="hover:scale-110 transition"><i class="fas fa-plus-circle text-[#FFC107] text-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-gray-100 p-6 rounded-2xl mb-8 text-center text-gray-500 font-bold border-2 border-dashed">
                        Belum ada pesanan nih, yuk jajan dulu!
                    </div>
                @endif

                <!-- 2. Tambah Produk (HIASAN UNGU SUDAH DIHAPUS) -->
                <a href="/menu" class="flex items-center gap-6 mb-8 group cursor-pointer transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-[#39AE1F] rounded-2xl w-[100px] h-[100px] flex items-center justify-center shadow-md flex-shrink-0 text-white text-5xl font-black relative group-hover:bg-green-600 transition shadow-sm">
                        +
                    </div>
                    <div class="flex flex-col">
                        <h4 class="text-2xl font-black text-gray-500 border-b-[3px] border-gray-200 pb-1 mb-1 inline-block group-hover:text-[#39AE1F] transition">Tambah Produk</h4>
                        <p class="text-[#FFC107] text-lg font-bold">Klik untuk pilih menu lain</p>
                    </div>
                </a>

                <!-- Total Section -->
                <div class="mt-10">
                    <div class="w-full border-t-[3px] border-gray-400 mb-4"></div>
                    <div class="flex justify-start items-center gap-4">
                        <span class="text-4xl font-black text-gray-600">Total:</span>
                        <span class="text-[#FFC107] text-4xl font-black tracking-tighter">
                            Rp. {{ number_format($totalHarga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="w-full mt-auto pt-10">
        <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-3 items-center">
            <div class="space-y-1">
                <h4 class="font-black text-xl mb-4 text-black">LINKS</h4>
                <p class="font-bold text-gray-500 text-sm"><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></p>
                <p class="font-bold text-gray-500 text-sm"><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-28">
            </div>
            <div class="text-right flex flex-col items-end">
                <h4 class="font-black text-xl mb-4 text-black">FOLLOW US</h4>
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
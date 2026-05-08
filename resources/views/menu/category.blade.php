<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Bar Bar Es Duren</title>
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
        background-size: auto; /* Biar tekstur aslinya kelihatan */
        position: relative; 
        z-index: 99;
    }

        .bg-green-dark { background-color: #38A12A; }
        .bg-green-light { background-color: #8CFF00; }

        /* FOOTER LOOPING */
        .footer-loop {
            width: 100%; height: 120px;
            background-image: url('{{ asset('image/footer.png') }}');
            background-repeat: repeat-x;
            background-size: contain;
            background-position: bottom;
        }

        /* LOGO GLOW (Diambil dari Landing Page biar konsisten) */
        .logo-glow {
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }
    </style>
</head>
<body class="bg-white">

    <div class="top-line"></div>

    <header class="bg-white py-6 relative z-30 w-full">
        <div class="container mx-auto max-w-7xl px-8 flex justify-between items-center">
            
            <div class="logo-glow">
                <a href="/"><img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[100px] object-contain"></a>
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

    <main>
        <div class="bg-[#FFC107] w-full py-3 relative shadow-md flex justify-center items-center">
            <a href="/menu" class="absolute left-6 md:left-20 bg-[#39AE1F] text-white px-6 py-1 rounded-full font-black text-lg border-2 border-white shadow-sm hover:bg-green-700 transition italic uppercase">
                Back
            </a>
            <h1 class="text-white text-5xl font-black italic uppercase tracking-tighter m-0">MENU</h1>
        </div>

        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4">
            <div class="bg-green-dark rounded-[40px] p-8 pt-12 relative shadow-xl">
                
                <div class="absolute -top-7 left-1/2 transform -translate-x-1/2 bg-green-light px-16 py-2 rounded-full shadow-md border-4 border-white">
                    <h2 class="text-3xl font-black text-gray-800 uppercase italic tracking-tighter">{{ $title }}</h2>
                </div>

                <div class="flex flex-col gap-6 mt-4">
                    @forelse($products as $item)
                    <div class="bg-white rounded-[25px] p-5 flex flex-col md:flex-row gap-6 items-stretch shadow-md hover:-translate-y-1 transition duration-300">
                        
                        <div class="bg-[#FFC107] rounded-2xl w-full md:w-40 h-40 flex-shrink-0 flex items-center justify-center p-2 shadow-inner">
                            <img src="{{ asset('image/' . $item->gambar) }}" alt="{{ $item->nama }}" class="max-h-full object-contain drop-shadow-md">
                        </div>
                        
                        <div class="flex-1 flex flex-col justify-between py-1">
                            <div>
                                <a href="/detail/{{ $item->id }}">
                                    <h3 class="text-3xl font-black text-gray-700 hover:text-[#39AE1F] transition cursor-pointer italic uppercase tracking-tighter">
                                        {{ $item->nama }}
                                    </h3>
                                </a>
                                <p class="text-sm text-gray-600 mt-2 font-bold leading-relaxed md:pr-4">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                            
                            <div class="flex justify-between items-center mt-4 border-t-2 border-gray-100 pt-4">
                                <div class="flex flex-col">
                                    @if($item->harga_lama && $item->harga_lama > $item->harga_baru)
                                        <span class="text-sm text-gray-400 line-through font-bold leading-none mb-1">
                                            Rp. {{ number_format($item->harga_lama, 0, ',', '.') }}
                                        </span>
                                    @endif
                                    
                                    <span class="text-[#FFC107] font-black text-3xl tracking-tighter leading-none">
                                        Rp. {{ number_format($item->harga_baru, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <a href="/detail/{{ $item->id }}" class="bg-[#39AE1F] text-white px-8 py-2 rounded-full font-black text-sm flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase italic">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-[25px] p-10 text-center shadow-md">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-2xl font-black text-gray-500 italic uppercase tracking-tighter">Menu untuk kategori "{{ $title }}" belum tersedia.</h3>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
    </main>

    <footer class="w-full mt-auto">
        <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-3 items-center border-t border-gray-100">
            <div class="space-y-1">
                <h4 class="font-black text-xl mb-4 italic uppercase text-black">LINKS</h4>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/about" class="hover:text-[#39AE1F] transition">About Us</a></p>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/contact" class="hover:text-[#39AE1F] transition">Contact Us</a></p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-28 object-contain">
            </div>
            <div class="text-right flex flex-col items-end">
                <h4 class="font-black text-xl mb-4 italic uppercase text-black">FOLLOW US</h4>
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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Font Gahar Kita -->
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
    </style>
</head>
<body class="bg-white">

    <!-- TOP LINE -->
    <div class="top-line"></div>

    <!-- NAVBAR KONSISTEN -->
    <nav class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center w-full">
        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-16">
        <ul class="hidden md:flex gap-8 text-gray-800 font-black text-xs uppercase tracking-widest">
            <li><a href="/" class="hover:text-yellow-500">Home</a></li>
            <li><a href="/menu" class="text-yellow-500 border-b-2 border-yellow-500 pb-1">Menu</a></li>
            <li><a href="/outlet" class="hover:text-yellow-500">Outlet</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
        </ul>
        <div class="text-[#39AE1F] text-4xl">
            <a href="/profile"><i class="fas fa-user-circle hover:scale-110 transition"></i></a>
        </div>
    </nav>

    <main>
        <!-- Banner Kuning + Tombol Back -->
        <div class="bg-[#FFC107] w-full py-3 relative shadow-md flex justify-center items-center">
            <!-- Tombol Back -->
            <a href="/menu" class="absolute left-6 md:left-20 bg-[#39AE1F] text-white px-6 py-1 rounded-full font-black text-lg border-2 border-white shadow-sm hover:bg-green-700 transition italic uppercase">
                Back
            </a>
            <h1 class="text-white text-5xl font-black italic uppercase tracking-tighter m-0">MENU</h1>
        </div>

        <!-- Container Utama (Box Hijau) -->
        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4">
            <div class="bg-green-dark rounded-[40px] p-8 pt-12 relative shadow-xl">
                
                <!-- Badge Judul Kategori -->
                <div class="absolute -top-7 left-1/2 transform -translate-x-1/2 bg-green-light px-16 py-2 rounded-full shadow-md border-4 border-white">
                    <h2 class="text-3xl font-black text-gray-800 uppercase italic tracking-tighter">{{ $title }}</h2>
                </div>

                <!-- List Produk -->
                <div class="flex flex-col gap-6 mt-4">
                    @forelse($products as $item)
                    <div class="bg-white rounded-[25px] p-5 flex flex-col md:flex-row gap-6 items-stretch shadow-md hover:-translate-y-1 transition duration-300">
                        
                        <!-- Gambar Produk di Kotak Kuning -->
                        <div class="bg-[#FFC107] rounded-2xl w-full md:w-40 h-40 flex-shrink-0 flex items-center justify-center p-2 shadow-inner">
                            <img src="{{ asset('image/' . $item->gambar) }}" alt="{{ $item->nama }}" class="max-h-full object-contain drop-shadow-md">
                        </div>
                        
                        <!-- Info Produk -->
                        <div class="flex-1 flex flex-col justify-between py-1">
                            <div>
                                <!-- Link Judul Produk -->
                                <a href="/detail/{{ $item->id }}">
                                    <h3 class="text-3xl font-black text-gray-700 hover:text-[#39AE1F] transition cursor-pointer italic uppercase tracking-tighter">
                                        {{ $item->nama }}
                                    </h3>
                                </a>
                                <p class="text-sm text-gray-600 mt-2 font-bold leading-relaxed md:pr-4">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                            
                            <!-- Harga & Tombol Detail -->
                            <div class="flex justify-between items-center mt-4 border-t-2 border-gray-100 pt-4">
                                <span class="text-[#FFC107] font-black text-3xl tracking-tighter">
                                    Rp. {{ number_format($item->harga_baru, 0, ',', '.') }}
                                </span>
                                
                                <a href="/detail/{{ $item->id }}" class="bg-[#39AE1F] text-white px-8 py-2 rounded-full font-black text-sm flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase italic">
                                    <i class="fas fa-search"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- Tampilan Jika Kategori Kosong -->
                    <div class="bg-white rounded-[25px] p-10 text-center shadow-md">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-2xl font-black text-gray-500 italic uppercase tracking-tighter">Menu untuk kategori "{{ $title }}" belum tersedia.</h3>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER KONSISTEN -->
    <footer class="w-full mt-auto">
        <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-3 items-center">
            <div class="space-y-1">
                <h4 class="font-black text-xl mb-4 italic uppercase">LINKS</h4>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/about">About Us</a></p>
                <p class="font-bold text-gray-500 text-sm uppercase"><a href="/contact">Contact Us</a></p>
            </div>
            <div class="flex justify-center">
                <!-- Stempel Merah -->
                <img src="{{ asset('image/logo-stempel.png') }}" alt="Logo" class="h-28">
            </div>
            <div class="text-right flex flex-col items-end">
                <h4 class="font-black text-xl mb-4 italic uppercase">FOLLOW US</h4>
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
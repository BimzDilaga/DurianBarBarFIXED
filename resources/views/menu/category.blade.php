<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ================= LOADING SCREEN ANIMATION ================= */
        #loading-screen {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: white; z-index: 9999;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s;
        }

        .loader-logo {
            width: 150px; margin-bottom: 30px;
            animation: bounce 1.5s infinite ease-in-out;
        }

        .progress-container {
            width: 250px; height: 10px;
            background-color: #f3f4f6; border-radius: 20px;
            overflow: hidden; position: relative; border: 2px solid #39AE1F;
        }

        .progress-bar {
            height: 100%; width: 0%;
            background: linear-gradient(to right, #39AE1F, #8CFF00);
            transition: width 0.3s ease;
        }

        .loading-text {
            margin-top: 15px; font-weight: 900; color: #39AE1F;
            font-size: 18px; font-style: italic;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.1); }
        }

        /* Hilangkan loading saat selesai */
        .loaded #loading-screen { opacity: 0; visibility: hidden; }

        /* ================= PENGATURAN UMUM ================= */
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0; background-color: #ffffff;
            overflow-x: hidden;
        }
        main { flex: 1; }
        
        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; background-size: auto; position: relative; z-index: 100;
        }

        /* STYLE KHAS HALAMAN KATEGORI */
        .bg-green-dark { background-color: #38A12A; }
        .bg-green-light { background-color: #8CFF00; }

        .logo-glow {
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }

        /* CUSTOM ANIMASI UNDERLINE UNTUK NAV LINK */
        .nav-link {
            position: relative;
            padding-bottom: 4px;
        }
        .nav-link::after {
            content: ''; position: absolute; width: 0; height: 3px;
            bottom: 0; left: 50%; background-color: #39AE1F;
            transition: width 0.3s ease, left 0.3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%; left: 0;
        }

        /* AUTOMATIC TYPOGRAPHY HIERARCHY MANAGER */
        h1, h2, h3, h4, h5, h6, .loading-text, .price-badge {
            font-family: 'Outfit', sans-serif !important;
        }
        footer, footer p, footer a, footer h4, footer span, footer div {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>
<body class="bg-white">

    <div id="loading-screen">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="loader-logo">
        <div class="progress-container">
            <div class="progress-bar" id="bar"></div>
        </div>
        <div class="loading-text" id="percent">0%</div>
    </div>

    <div class="top-line"></div>

    <header class="sticky top-0 bg-white/95 backdrop-blur-md py-4 shadow-sm border-b border-gray-100 z-50 transition duration-300">
        <div class="container mx-auto max-w-7xl px-6 flex justify-between items-center">
            
            <div class="logo-glow">
                <a href="/" class="block transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[80px] md:h-[90px] object-contain">
                </a>
            </div>

            <nav class="hidden md:block">
                <ul class="flex space-x-10 text-[15px] font-[900] text-zinc-700 uppercase tracking-wider">
                    <li><a href="/" class="nav-link hover:text-[#39AE1F] transition duration-300">Home</a></li>
                    <li><a href="/menu" class="nav-link text-[#39AE1F] active">Menu</a></li>
                    <li><a href="/outlet" class="nav-link hover:text-[#39AE1F] transition duration-300">Outlet</a></li>
                    <li><a href="/about" class="nav-link hover:text-[#39AE1F] transition duration-300">About Us</a></li>
                    <li><a href="/contact" class="nav-link hover:text-[#39AE1F] transition duration-300">Contact Us</a></li>
                </ul>
            </nav>
            
            <div class="flex items-center gap-4 relative">
                
                <div class="relative">
                    <button id="cartBtn" class="group flex items-center justify-center p-2.5 rounded-full bg-gray-100 border border-gray-200 hover:bg-green-50 hover:border-green-200 shadow-sm transition duration-300 relative">
                        <i class="fas fa-shopping-cart text-[20px] text-gray-400 group-hover:text-[#39AE1F] transition duration-300"></i>
                        <span id="cartBadge" class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full border-2 border-white shadow-sm" style="display: none;">0</span>
                    </button>

                    <div id="cartDropdown" class="hidden absolute right-0 mt-3 w-[350px] bg-white rounded-2xl shadow-2xl border border-gray-100 z-[100] transform opacity-0 scale-95 transition-all duration-300 origin-top-right overflow-hidden">
                        <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <h3 class="font-[900] text-zinc-800 text-[15px] italic">Keranjang Saya</h3>
                            <span id="cartItemCount" class="text-xs font-bold text-gray-500">0 Item</span>
                        </div>
                        
                        <div id="cartItemsContainer" class="max-h-[250px] overflow-y-auto p-4 space-y-4"></div>

                        <div class="p-4 border-t border-gray-100 bg-white">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-[13px] font-[800] text-zinc-500">Subtotal:</span>
                                <span id="cartSubtotal" class="text-[18px] font-[900] text-[#39AE1F]">Rp 0</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <a href="/checkout" class="block w-full bg-[#39AE1F] text-white text-center py-2.5 rounded-xl font-[900] uppercase tracking-wider text-[13px] hover:bg-green-700 transition shadow-md italic">
                                    Lanjut Checkout
                                </a>
                                <a href="/menu" class="block w-full bg-green-50 text-[#39AE1F] border border-[#39AE1F] text-center py-2 rounded-xl font-[800] uppercase tracking-wider text-[12px] hover:bg-[#39AE1F] hover:text-white transition italic">
                                    + Kategori Menu Lain
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-profile relative">
                    @auth
                        <a href="/profile" class="group flex items-center justify-center p-1 rounded-full bg-gradient-to-tr from-green-500 to-lime-400 shadow-md group hover:shadow-lg transition duration-300">
                            <i class="fas fa-user-circle shadow-sm bg-white rounded-full hover:scale-110 transition duration-300 text-[#39AE1F] text-[42px]"></i>
                        </a>
                    @else
                        <a href="/login" class="group flex items-center justify-center p-1 rounded-full bg-gray-100 border border-gray-200 hover:bg-gray-200 shadow-sm transition duration-300">
                            <i class="fas fa-user-circle text-[42px] text-gray-400 group-hover:text-gray-500 transition duration-300"></i>
                        </a>
                    @endauth
                </div>

                <button id="menuBtn" class="block md:hidden text-gray-700 text-2xl focus:outline-none p-2 hover:text-[#39AE1F] transition">
                    <i class="fas fa-bars" id="menuIcon"></i>
                </button>
            </div>
        </div>

        <nav id="mobileMenu" class="hidden md:hidden bg-white w-full border-t border-gray-100 shadow-lg absolute top-full left-0 z-50">
            <ul class="flex flex-col text-[15px] font-[900] text-zinc-800 uppercase tracking-widest py-4">
                <li><a href="/" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">Home</a></li>
                <li><a href="/menu" class="block px-8 py-3 bg-green-50 text-[#39AE1F] border-l-4 border-[#39AE1F]">Menu</a></li>
                <li><a href="/outlet" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">Outlet</a></li>
                <li><a href="/about" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">About Us</a></li>
                <li><a href="/contact" class="block px-8 py-3 hover:bg-gray-50 hover:text-[#39AE1F] transition">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="bg-[#FFC107] w-full py-3 relative shadow-md flex justify-center items-center">
            <a href="/menu" class="absolute left-6 md:left-20 bg-[#39AE1F] text-white px-6 py-1 rounded-full font-black text-lg border-2 border-white shadow-sm hover:bg-green-700 transition uppercase tracking-wide">
                Back
            </a>
            <h1 class="text-white text-5xl font-black uppercase tracking-tighter m-0">MENU</h1>
        </div>

        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4">
            <div class="bg-green-dark rounded-[40px] p-8 pt-12 relative shadow-xl">
                <div class="absolute -top-7 left-1/2 transform -translate-x-1/2 bg-green-light px-16 py-2 rounded-full shadow-md border-4 border-white">
                    <h2 class="text-3xl font-black text-gray-800 uppercase tracking-tighter m-0">{{ $title }}</h2>
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
                                    <h3 class="text-3xl font-black text-gray-700 hover:text-[#39AE1F] transition cursor-pointer uppercase tracking-tighter m-0">
                                        {{ $item->nama }}
                                    </h3>
                                </a>
                                <p class="text-sm text-gray-600 mt-2 font-bold leading-relaxed md:pr-4">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                            
                            <div class="flex justify-between items-center mt-4 border-t-2 border-gray-100 pt-4">
                                <div class="flex flex-col price-badge">
                                    @if($item->harga_lama && $item->harga_lama > $item->harga_baru)
                                        <span class="text-sm text-gray-400 line-through font-bold leading-none mb-1">
                                            Rp. {{ number_format($item->harga_lama, 0, ',', '.') }}
                                        </span>
                                    @endif
                                    <span class="text-[#FFC107] font-black text-3xl tracking-tighter leading-none">
                                        Rp. {{ number_format($item->harga_baru, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <a href="/detail/{{ $item->id }}" class="text-[#39AE1F] font-[900] text-sm uppercase tracking-widest italic border-b-[3px] border-[#39AE1F] pb-[2px] hover:opacity-75 transition">
                                        Details
                                    </a>
                                    <button type="button" onclick="addToCart('{{ $item->id }}', '{{ $item->nama }}', {{ $item->harga_baru }}, '{{ asset('image/' . $item->gambar) }}')" class="bg-[#39AE1F] text-white px-6 py-2 rounded-full font-black text-sm flex items-center gap-2 hover:bg-green-700 transition shadow-sm uppercase tracking-wider cursor-pointer">
                                        <i class="fas fa-shopping-cart"></i> Buy
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-[25px] p-10 text-center shadow-md">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-2xl font-black text-gray-500 uppercase tracking-tighter m-0">Menu untuk kategori "{{ $title }}" belum tersedia.</h3>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-8 relative z-30 bg-white border-t-4 border-[#FFD429]">
        <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 md:grid-cols-3 gap-6 items-start text-center md:text-left relative z-20">
            
            <div class="flex flex-col items-center space-y-3 order-2 md:order-1 mt-6 md:mt-0">
                <div class="flex flex-col items-start w-fit">
                    <h4 class="font-black text-lg uppercase text-black italic tracking-tight border-b-[3px] border-[#39AE1F] pb-1 inline-block mb-2">Menu Navigasi</h4>
                    <div class="flex flex-col space-y-1.5 w-full">
                        <a href="/" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Home</a>
                        <a href="/menu" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Menu & Kategori</a>
                        <a href="/outlet" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Lokasi Outlet</a>
                        <a href="/about" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> About Us</a>
                        <a href="/contact" class="font-bold text-gray-500 text-[14px] hover:text-[#39AE1F] hover:translate-x-2 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-[#FFD429]"></i> Contact Us</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center text-center space-y-3 order-1 md:order-2 border-b-2 md:border-b-0 pb-6 md:pb-0 border-gray-100">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="h-20 object-contain drop-shadow-md hover:scale-105 transition duration-300">
                <p class="text-gray-600 font-bold text-sm leading-snug max-w-xs mx-auto">
                    "Berkomitmen Menyajikan Kebahagiaan Lewat Setiap Mangkok Mie Ayam, Bakso, dan Aneka Cemilan Pilihan, Dipadukan dengan Keaslian Buah Durian Terbaik and Racikan Es Teler Khas yang Disajikan Secara Bar Bar Tanpa Batas!"
                </p>
            </div>
            
            <div class="flex flex-col items-center space-y-3 order-3 md:order-3 mt-6 md:mt-0">
                <div class="flex flex-col items-start w-fit">
                    <h4 class="font-black text-lg uppercase text-black italic tracking-tight border-b-[3px] border-[#39AE1F] pb-1 inline-block mb-2">Hubungi Kami</h4>
                    <div class="flex flex-col space-y-2 w-full max-w-xs text-[14px]">
                        <a href="https://wa.me/6285848182655" target="_blank" class="flex items-center justify-start gap-3 font-bold text-zinc-600 hover:text-[#25D366] transition duration-300 group bg-gray-50 p-1.5 rounded-xl border border-gray-100 shadow-sm">
                            <div class="bg-green-50 text-[#25D366] p-2 rounded-lg text-sm group-hover:bg-[#25D366] group-hover:text-white transition duration-300"><i class="fab fa-whatsapp"></i></div>
                            <div class="text-left">
                                <p class="text-[9px] text-zinc-400 uppercase tracking-widest font-black mb-0">WhatsApp CS</p>
                                <p class="text-[12px] font-black">0858-4818-2655</p>
                            </div>
                        </a>
                        
                        <a href="mailto:durianbarbarr@gmail.com" class="flex items-center justify-start gap-3 font-bold text-zinc-600 hover:text-red-500 transition duration-300 group bg-gray-50 p-1.5 rounded-xl border border-gray-100 shadow-sm">
                            <div class="bg-red-50 text-red-500 p-2 rounded-lg text-sm group-hover:bg-red-500 group-hover:text-white transition duration-300"><i class="fa-solid fa-envelope"></i></div>
                            <div class="text-left">
                                <p class="text-[9px] text-zinc-400 uppercase tracking-widest font-black mb-0">Email Support</p>
                                <p class="text-[12px] font-black">durianbarbarr@gmail.com</p>
                            </div>
                        </a>

                        <a href="https://instagram.com/dawetdurianbarbarpwt" target="_blank" class="flex items-center justify-start gap-3 font-bold text-zinc-600 hover:text-[#E1306C] transition duration-300 group bg-gray-50 p-1.5 rounded-xl border border-gray-100 shadow-sm">
                            <div class="bg-pink-50 text-[#E1306C] p-2 rounded-lg text-sm group-hover:bg-[#E1306C] group-hover:text-white transition duration-300"><i class="fa-brands fa-instagram"></i></div>
                            <div class="text-left">
                                <p class="text-[9px] text-zinc-400 uppercase tracking-wider font-black mb-0">Instagram</p>
                                <p class="text-[12px] font-black">@dawetdurianbarbarpwt</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="bg-[#39AE1F] text-center py-3 relative z-20 shadow-inner">
            <p class="font-bold text-white text-xs md:text-sm tracking-widest uppercase">
                &copy; {{ date('Y') }} <span class="text-[#FFD429] font-black italic">BAR BAR KULINER GROUP</span>. All Rights Reserved.
            </p>
        </div>

        <div class="relative z-10" style="width: 100%; height: 200px; background-image: url('{{ asset('image/footer.png') }}'); background-repeat: repeat-x; background-size: contain; background-position: bottom; margin-top: -10px;"></div>
    </footer>

    <script>
        // 1. LOGIKA LOADING BAR
        window.addEventListener('load', () => {
            const bar = document.getElementById('bar');
            const percentText = document.getElementById('percent');
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        document.body.classList.add('loaded');
                        setTimeout(() => { document.getElementById('loading-screen').style.display = 'none'; }, 500);
                    }, 300);
                } else {
                    width += 5; bar.style.width = width + '%'; percentText.innerText = width + '%';
                }
            }, 30);
        });

        // 2. LOGIKA HAMBURGER MENU MOBILE
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if (mobileMenu.classList.contains('hidden')) { menuIcon.classList.replace('fa-times', 'fa-bars'); } 
            else { menuIcon.classList.replace('fa-bars', 'fa-times'); }
        });

        // ==========================================
        // 3. MESIN KERANJANG (LOCAL STORAGE)
        // ==========================================
        let cartData = JSON.parse(localStorage.getItem('barbar_cart')) || [];

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function saveCart() {
            localStorage.setItem('barbar_cart', JSON.stringify(cartData));
        }

        // Buka tutup dropdown keranjang
        const cartBtn = document.getElementById('cartBtn');
        const cartDropdown = document.getElementById('cartDropdown');

        if(cartBtn && cartDropdown) {
            cartBtn.addEventListener('click', (e) => {
                e.stopPropagation(); 
                if (cartDropdown.classList.contains('hidden')) {
                    cartDropdown.classList.remove('hidden');
                    setTimeout(() => {
                        cartDropdown.classList.remove('opacity-0', 'scale-95');
                        cartDropdown.classList.add('opacity-100', 'scale-100');
                    }, 10);
                } else {
                    cartDropdown.classList.remove('opacity-100', 'scale-100');
                    cartDropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => { cartDropdown.classList.add('hidden'); }, 300); 
                }
            });

            document.addEventListener('click', (e) => {
                if (!cartBtn.contains(e.target) && !cartDropdown.contains(e.target) && !cartDropdown.classList.contains('hidden')) {
                    cartDropdown.classList.remove('opacity-100', 'scale-100');
                    cartDropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => { cartDropdown.classList.add('hidden'); }, 300);
                }
            });
        }

        // Tampilkan data keranjang ke Dropdown
        function renderCartHeader() {
            const container = document.getElementById('cartItemsContainer');
            if(!container) return;

            container.innerHTML = ''; 
            let totalHarga = 0; let totalBarang = 0;

            if (cartData.length === 0) {
                container.innerHTML = `<p class="text-center text-gray-400 text-xs py-4 font-bold">Keranjang masih kosong nih :(</p>`;
            } else {
                cartData.forEach((item, index) => {
                    totalHarga += item.price * item.qty;
                    totalBarang += item.qty;
                    container.innerHTML += `
                        <div class="flex gap-3">
                            <img src="${item.img}" class="w-16 h-16 rounded-xl object-cover border border-gray-100 shadow-sm" alt="Item">
                            <div class="flex-1 flex flex-col justify-between py-0.5">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-[13px] font-[800] text-zinc-800 leading-tight">${item.name}</h4>
                                    <button type="button" onclick="removeItem(${index})" class="text-gray-300 hover:text-red-500 transition"><i class="fas fa-trash-alt text-[12px]"></i></button>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-[13px] font-[900] text-[#39AE1F]">${formatRupiah(item.price)}</span>
                                    <div class="flex items-center bg-gray-100 rounded-lg p-0.5">
                                        <button type="button" onclick="changeQty(${index}, -1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-md text-gray-600 hover:text-red-500 shadow-sm transition"><i class="fas fa-minus text-[10px]"></i></button>
                                        <span class="w-7 text-center text-[12px] font-bold text-zinc-800">${item.qty}</span>
                                        <button type="button" onclick="changeQty(${index}, 1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-md text-gray-600 hover:text-[#39AE1F] shadow-sm transition"><i class="fas fa-plus text-[10px]"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }
            document.getElementById('cartSubtotal').innerText = formatRupiah(totalHarga);
            document.getElementById('cartItemCount').innerText = totalBarang + ' Item';
            const badge = document.getElementById('cartBadge');
            badge.innerText = totalBarang;
            badge.style.display = totalBarang > 0 ? 'block' : 'none';
        }

        // FUNGSI UTAMA: NAMBAH BARANG KE KERANJANG DARI TOMBOL BUY
        function addToCart(id, name, price, img) {
            const existingItem = cartData.find(item => item.id === id);
            if (existingItem) {
                existingItem.qty += 1;
            } else {
                cartData.push({id, name, price, img, qty: 1});
            }
            saveCart();
            renderCartHeader();
            
            // Buka keranjang otomatis biar keliatan nambah
            if (cartDropdown && cartDropdown.classList.contains('hidden')) {
                cartDropdown.classList.remove('hidden');
                setTimeout(() => {
                    cartDropdown.classList.remove('opacity-0', 'scale-95');
                    cartDropdown.classList.add('opacity-100', 'scale-100');
                }, 10);
            }
        }

        function removeItem(index) {
            if(event) event.stopPropagation();
            cartData.splice(index, 1);
            saveCart();
            renderCartHeader();
        }

        function changeQty(index, amount) {
            if(event) event.stopPropagation();
            if (cartData[index].qty + amount >= 1) {
                cartData[index].qty += amount;
                saveCart();
                renderCartHeader();
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            renderCartHeader();
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Bar Bar Es Duren</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        .loaded #loading-screen { opacity: 0; visibility: hidden; }

        /* ================= PENGATURAN UMUM ================= */
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0; background-color: #ffffff;
            overflow-x: hidden;
        }
        main { flex: 1; position: relative; overflow: hidden; }
        
        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat; position: relative; z-index: 100;
        }

        h1, h2, h3, h4, h5, h6, .loading-text, button, .font-outfit {
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

    @include('components.navbar')

    <main class="relative min-h-[60vh]">
        <div class="bg-[#FFD429] w-full py-6 shadow-md text-center relative z-20">
            <h1 class="text-white text-[40px] md:text-[50px] font-black uppercase tracking-tighter m-0">RIWAYAT PESANAN</h1>
        </div>

        <div class="max-w-4xl mx-auto px-4 py-12 relative z-20">
            <div class="flex justify-between items-center mb-8">
                <a href="/menu" class="text-[#39AE1F] font-black uppercase text-[13px] tracking-wider hover:-translate-x-1 transition duration-300 flex items-center gap-2 bg-green-50 px-4 py-2 rounded-xl border border-green-100 shadow-sm">
                    <i class="fas fa-arrow-left"></i> Belanja Lagi
                </a>
            </div>

            <div class="space-y-6">
                @forelse($orders as $order)
                    @php
                        // Menentukan status awal bawaan dari database (jika kosong, default ke 'menyiapkan')
                        $currentStatus = strtolower($order->status_pesanan ?? 'menyiapkan');
                    @endphp

                    <div id="order-card-{{ $order->order_id ?? $order->id }}" class="bg-white rounded-[25px] p-6 shadow-xl border-2 border-gray-100 flex flex-col gap-6 hover:scale-[1.01] transition duration-300 group">
                        
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-4">
                            <div class="w-full md:w-auto">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50 border border-gray-200 px-2 py-1 rounded-md">
                                    <i class="fas fa-receipt mr-1"></i> Order ID: #{{ $order->order_id ?? $order->id ?? 'Baru' }}
                                </span>
                                
                                <h3 class="text-2xl font-black text-zinc-800 uppercase tracking-tight mt-3">
                                    @php
                                        $daftarItem = is_string($order->items) ? json_decode($order->items, true) : $order->items;
                                    @endphp

                                    @if(is_array($daftarItem) && count($daftarItem) > 0)
                                        @foreach($daftarItem as $item)
                                            {{ $item['nama'] ?? $item['name'] ?? 'Menu' }} ({{ $item['qty'] ?? 1 }}x)@if(!$loop->last), @endif
                                        @endforeach
                                    @elseif(!empty($order->nama_menu))
                                        {{ $order->nama_menu }}
                                    @elseif(!empty($order->nama))
                                        {{ $order->nama }}
                                    @else
                                        Pesanan #{{ $order->order_id ?? $order->id }}
                                    @endif
                                </h3>
                                
                                <p class="text-lg text-[#39AE1F] font-black mt-1 bg-green-50 inline-block px-3 py-1 rounded-lg">
                                    Rp {{ number_format(($order->total_harga ?? 0), 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="w-full md:w-auto mt-4 md:mt-0 flex flex-col items-end gap-2">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-wider block">Simulasi Status Pengiriman:</span>
                                <div class="flex gap-1.5 w-full md:w-auto">
                                    <button type="button" onclick="simulasiStatus('{{ $order->order_id ?? $order->id }}', 'menyiapkan')" class="bg-gray-100 text-gray-700 hover:bg-green-100 hover:text-green-700 px-3 py-1.5 rounded-lg text-[11px] font-black uppercase tracking-wider transition shadow-sm border border-gray-200">
                                        Siapkan
                                    </button>
                                    <button type="button" onclick="simulasiStatus('{{ $order->order_id ?? $order->id }}', 'mengantar')" class="bg-gray-100 text-gray-700 hover:bg-orange-100 hover:text-orange-700 px-3 py-1.5 rounded-lg text-[11px] font-black uppercase tracking-wider transition shadow-sm border border-gray-200">
                                        Antar
                                    </button>
                                    <button type="button" onclick="simulasiStatus('{{ $order->order_id ?? $order->id }}', 'selesai')" class="bg-gray-100 text-gray-700 hover:bg-blue-100 hover:text-blue-700 px-3 py-1.5 rounded-lg text-[11px] font-black uppercase tracking-wider transition shadow-sm border border-gray-200">
                                        Sampai
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="relative px-2 py-2">
                            <div class="absolute top-5 left-8 right-8 h-1 bg-gray-200 rounded-full z-0"></div>

                            <div id="progress-line-{{ $order->order_id ?? $order->id }}" class="absolute top-5 left-8 h-1 bg-[#39AE1F] rounded-full z-0 transition-all duration-700 ease-in-out"
                                style="width: {{ $currentStatus == 'selesai' ? 'calc(100% - 4rem)' : ($currentStatus == 'mengantar' ? 'calc(50% - 2rem)' : '0%') }};">
                            </div>

                            <div class="relative z-10 flex justify-between items-center">
                                
                                <div class="flex flex-col items-center">
                                    <div id="node-menyiapkan-{{ $order->order_id ?? $order->id }}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 {{ ($currentStatus == 'menyiapkan' || $currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'bg-[#39AE1F] ring-4 ring-green-100' : 'bg-gray-300' }}">
                                        <i id="icon-menyiapkan-{{ $order->order_id ?? $order->id }}" class="fas fa-fire-burner {{ $currentStatus == 'menyiapkan' ? 'animate-bounce' : '' }}"></i>
                                    </div>
                                    <span id="text-menyiapkan-{{ $order->order_id ?? $order->id }}" class="font-outfit text-[11px] font-black uppercase mt-2 {{ ($currentStatus == 'menyiapkan' || $currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'text-[#39AE1F]' : 'text-gray-400' }}">Disiapkan</span>
                                </div>

                                <div class="flex flex-col items-center">
                                    <div id="node-mengantar-{{ $order->order_id ?? $order->id }}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 {{ ($currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'bg-orange-500 ring-4 ring-orange-100' : 'bg-gray-200 text-gray-400' }}">
                                        <i id="icon-mengantar-{{ $order->order_id ?? $order->id }}" class="fas fa-motorcycle {{ $currentStatus == 'mengantar' ? 'animate-pulse' : '' }}"></i>
                                    </div>
                                    <span id="text-mengantar-{{ $order->order_id ?? $order->id }}" class="font-outfit text-[11px] font-black uppercase mt-2 {{ ($currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'text-orange-500' : 'text-gray-400' }}">Diantar</span>
                                </div>

                                <div class="flex flex-col items-center">
                                    <div id="node-selesai-{{ $order->order_id ?? $order->id }}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 {{ $currentStatus == 'selesai' ? 'bg-blue-600 ring-4 ring-blue-100' : 'bg-gray-200 text-gray-400' }}">
                                        <i class="fas fa-house-chimney-check"></i>
                                    </div>
                                    <span id="text-selesai-{{ $order->order_id ?? $order->id }}" class="font-outfit text-[11px] font-black uppercase mt-2 {{ $currentStatus == 'selesai' ? 'text-blue-600' : 'text-gray-400' }}">Sampai</span>
                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-16 bg-white/80 backdrop-blur-sm rounded-[30px] shadow-lg border-2 border-dashed border-gray-200 relative z-20">
                        <i class="fas fa-box-open text-6xl text-gray-200 mb-4"></i>
                        <h3 class="text-2xl font-black text-zinc-700 uppercase tracking-tight">Belum Ada Pesanan</h3>
                        <p class="text-gray-500 font-bold text-sm mt-2 mb-6">Kamu belum pernah memesan apa-apa, bos. Yuk pesan sekarang!</p>
                        <a href="/menu" class="inline-block bg-[#39AE1F] text-white px-8 py-3 rounded-xl font-black uppercase tracking-widest text-sm hover:bg-green-700 transition shadow-md">
                             Lihat Menu
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <footer class="mt-8 relative z-30 bg-white border-t-4 border-[#FFD429]">
        <div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 md:grid-cols-3 gap-6 items-start text-center md:text-left">
            <div class="flex flex-col items-center space-y-3 mt-6 md:mt-0">
                <div class="flex flex-col items-start w-fit">
                    <h4 class="font-black text-lg uppercase text-black italic tracking-tight border-b-[3px] border-[#39AE1F] pb-1 inline-block mb-2">Menu Navigasi</h4>
                    <div class="flex flex-col space-y-1.5 w-full text-gray-500 font-bold text-[14px]">
                        <a href="/">Home</a>
                        <a href="/menu">Menu</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center text-center space-y-3">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-20 object-contain">
                <p class="text-gray-600 font-bold text-sm max-w-xs">"Bar Bar Es Duren Tanpa Batas!"</p>
            </div>
            <div class="flex flex-col items-center mt-6 md:mt-0">
                <h4 class="font-black text-lg uppercase text-black italic border-b-[3px] border-[#39AE1F] pb-1 mb-2">Hubungi Kami</h4>
                <p class="text-sm font-bold text-zinc-600">0858-4818-2655</p>
            </div>
        </div>
    </footer>

    <script>
        function simulasiStatus(id, status Baru) {
            const progressLine = document.getElementById('progress-line-' + id);
            
            // Ambil Element Node Bulatan
            const nodeSiap = document.getElementById('node-menyiapkan-' + id);
            const nodeAntar = document.getElementById('node-mengantar-' + id);
            const nodeSelesai = document.getElementById('node-selesai-' + id);
            
            // Ambil Element Tulisan Bawah
            const textSiap = document.getElementById('text-menyiapkan-' + id);
            const textAntar = document.getElementById('text-mengantar-' + id);
            const textSelesai = document.getElementById('text-selesai-' + id);
            
            // Ambil Element Icon-nya
            const iconSiap = document.getElementById('icon-menyiapkan-' + id);
            const iconAntar = document.getElementById('icon-mengantar-' + id);

            // Reset Kelas Animasi & Warna bawaan dulu biar gak tabrakan
            iconSiap.classList.remove('animate-bounce');
            iconAntar.classList.remove('animate-pulse');

            if (statusBaru === 'menyiapkan') {
                progressLine.style.width = '0%';
                
                // Nyalakan bulatan 1, matikan bulatan 2 & 3
                nodeSiap.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-[#39AE1F] ring-4 ring-green-100";
                nodeAntar.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-gray-200 text-gray-400";
                nodeSelesai.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-gray-200 text-gray-400";
                
                textSiap.className = "font-outfit text-[11px] font-black uppercase mt-2 text-[#39AE1F]";
                textAntar.className = "font-outfit text-[11px] font-black uppercase mt-2 text-gray-400";
                textSelesai.className = "font-outfit text-[11px] font-black uppercase mt-2 text-gray-400";
                
                iconSiap.classList.add('animate-bounce');
            } 
            else if (statusBaru === 'mengantar') {
                progressLine.style.width = 'calc(50% - 2rem)';
                
                // Nyalakan bulatan 1 & 2, matikan bulatan 3
                nodeSiap.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-[#39AE1F]";
                nodeAntar.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-orange-500 ring-4 ring-orange-100";
                nodeSelesai.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-gray-200 text-gray-400";
                
                textSiap.className = "font-outfit text-[11px] font-black uppercase mt-2 text-[#39AE1F]";
                textAntar.className = "font-outfit text-[11px] font-black uppercase mt-2 text-orange-500";
                textSelesai.className = "font-outfit text-[11px] font-black uppercase mt-2 text-gray-400";
                
                iconAntar.classList.add('animate-pulse');
            } 
            else if (statusBaru === 'selesai') {
                progressLine.style.width = 'calc(100% - 4rem)';
                
                // Nyalakan semua bulatan sampai ujung
                nodeSiap.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-[#39AE1F]";
                nodeAntar.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-orange-500";
                nodeSelesai.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 bg-blue-600 ring-4 ring-blue-100";
                
                textSiap.className = "font-outfit text-[11px] font-black uppercase mt-2 text-[#39AE1F]";
                textAntar.className = "font-outfit text-[11px] font-black uppercase mt-2 text-orange-500";
                textSelesai.className = "font-outfit text-[11px] font-black uppercase mt-2 text-blue-600";
            }
        }
    </script>

    <script>
        // Loading Screen Handler Bawaan
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
                    width += 5; 
                    if(bar) bar.style.width = width + '%'; 
                    if(percentText) percentText.innerText = width + '%';
                }
            }, 30);
        });
    </script>
</body>
</html>
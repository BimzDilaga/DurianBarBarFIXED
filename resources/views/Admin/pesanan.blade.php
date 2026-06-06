<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - Panel Admin Bar Bar</title>
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
        .loader-logo { width: 150px; margin-bottom: 30px; animation: bounce 1.5s infinite ease-in-out; }
        .progress-container { width: 250px; height: 10px; background-color: #f3f4f6; border-radius: 20px; overflow: hidden; position: relative; border: 2px solid #39AE1F; }
        .progress-bar { height: 100%; width: 0%; background: linear-gradient(to right, #39AE1F, #8CFF00); transition: width 0.3s ease; }
        .loading-text { margin-top: 15px; font-weight: 900; color: #39AE1F; font-size: 18px; font-style: italic; }
        @keyframes bounce { 0%, 100% { transform: translateY(0) scale(1); } 50% { transform: translateY(-20px) scale(1.1); } }
        .loaded #loading-screen { opacity: 0; visibility: hidden; }

        /* ================= PENGATURAN UMUM ================= */
        body { font-family: 'Plus Jakarta Sans', sans-serif; display: flex; flex-direction: column; min-height: 100vh; margin: 0; padding: 0; background-color: #f8f9fa; overflow-x: hidden; }
        main { flex: 1; position: relative; overflow: hidden; }
        .top-line { width: 100%; height: 45px; background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00); background-repeat: repeat; position: relative; z-index: 100; }
        .bg-pohon { position: absolute; top: 150px; right: 0px; width: 500px; height: auto; z-index: 1; opacity: 0.9; pointer-events: none; -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%); mask-image: linear-gradient(to bottom, black 60%, transparent 100%); }
        .bg-pohon-kiri { position: absolute; top: 150px; left: 0px; width: 500px; height: auto; z-index: 1; opacity: 0.9; pointer-events: none; transform: scaleX(-1); -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%); mask-image: linear-gradient(to bottom, black 60%, transparent 100%); }
        h1, h2, h3, h4, h5, h6, .loading-text, .font-outfit { font-family: 'Outfit', sans-serif !important; }
    </style>
</head>
<body class="bg-[#f8f9fa]">

    <div id="loading-screen">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="loader-logo">
        <div class="progress-container"><div class="progress-bar" id="bar"></div></div>
        <div class="loading-text" id="percent">0%</div>
    </div>

    <div class="top-line"></div>

    @include('components.navbar')

    <main class="relative pb-20">
        <div class="bg-[#FFD429] w-full py-6 shadow-md text-center relative z-20">
            <h1 class="text-white text-[40px] md:text-[50px] font-black uppercase tracking-tighter m-0">PANEL ADMIN</h1>
        </div>

        <img src="{{ asset('image/pohon-durian.png') }}" class="bg-pohon hidden xl:block" alt="Background Pohon Kanan">
        <img src="{{ asset('image/pohon-durian.png') }}" class="bg-pohon-kiri hidden xl:block" alt="Background Pohon Kiri">

        <div class="max-w-6xl mx-auto mt-10 px-4 relative z-10">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-[#39AE1F] text-green-800 p-4 rounded-xl mb-6 shadow-sm font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Daftar Pesanan Masuk</h2>
                    <p class="text-sm text-gray-500 font-semibold">Kelola dan update status pengiriman pesanan pelanggan.</p>
                </div>
                
                <a href="{{ url('/admin/produk') }}" class="bg-[#39AE1F] hover:bg-green-600 text-white font-bold py-2 px-6 rounded-xl shadow-md transition duration-300 flex items-center gap-2 uppercase tracking-wider text-sm">
                    <i class="fas fa-box-open"></i> Kelola Menu Produk
                </a>
            </div>

            <div class="space-y-6">
                @forelse($orders as $order)
                    @php
                        $currentStatus = strtolower($order->status_pesanan ?? 'menyiapkan');
                        $orderId = $order->order_id ?? $order->id;
                        $daftarItem = is_string($order->items) ? json_decode($order->items, true) : $order->items;
                    @endphp

                    <div id="order-card-{{ $orderId }}" class="bg-white rounded-[30px] p-6 md:p-8 shadow-lg border-2 border-gray-100 flex flex-col gap-6 hover:shadow-xl transition duration-300 relative overflow-hidden">
                        
                        <div class="absolute left-0 top-0 bottom-0 w-2 {{ $currentStatus == 'selesai' ? 'bg-blue-500' : ($currentStatus == 'mengantar' ? 'bg-orange-500' : 'bg-[#39AE1F]') }}"></div>

                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b-2 border-gray-50 pb-6 pl-4">
                            <div>
                                <span class="text-[11px] font-black text-white uppercase tracking-widest bg-zinc-800 px-3 py-1 rounded-md shadow-sm">
                                    <i class="fas fa-hashtag text-[10px] mr-1 text-[#FFD429]"></i>{{ $orderId }}
                                </span>
                                
                                <div class="mt-3 flex items-center gap-2 text-sm font-bold text-gray-500">
                                    <i class="fas fa-user-circle text-[#39AE1F]"></i> User ID: {{ $order->user_id ?? 'Guest' }}
                                    <span class="mx-1 text-gray-300">|</span>
                                    <i class="fas fa-calendar-alt text-[#39AE1F]"></i> {{ $order->created_at ? $order->created_at->format('d M Y, H:i') : 'Waktu tidak diketahui' }}
                                </div>

                                <h3 class="font-outfit text-xl md:text-2xl font-black text-gray-800 uppercase mt-2 leading-tight">
                                    @if(is_array($daftarItem) && count($daftarItem) > 0)
                                        @foreach($daftarItem as $item)
                                            {{ $item['nama'] ?? $item['name'] ?? 'Menu' }} 
                                            <span class="text-[#39AE1F]">({{ $item['qty'] ?? 1 }}x)</span>@if(!$loop->last), @endif
                                        @endforeach
                                    @else
                                        {{ $order->nama_menu ?? $order->nama ?? 'Pesanan Pelanggan' }}
                                    @endif
                                </h3>
                                <p class="text-[#FFD429] drop-shadow-sm font-black text-2xl mt-1 italic">
                                    Rp {{ number_format(($order->total_harga ?? 0), 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex flex-col gap-2 w-full md:w-auto shadow-inner">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block text-center md:text-left px-1">Ubah Status Pengiriman:</span>
                                
                                <div class="flex flex-wrap gap-2">
                                    <form action="{{ route('admin.updateStatus', $orderId) }}" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="status" value="menyiapkan">
                                        <button type="submit" class="bg-white text-gray-600 hover:bg-[#39AE1F] hover:text-white hover:border-[#39AE1F] px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition border-2 border-gray-200 shadow-sm flex items-center gap-1.5 {{ $currentStatus == 'menyiapkan' ? 'bg-green-50 border-green-400 text-green-600 shadow-inner' : '' }}">
                                            <i class="fas fa-fire-burner"></i> Siapkan
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.updateStatus', $orderId) }}" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="status" value="mengantar">
                                        <button type="submit" class="bg-white text-gray-600 hover:bg-orange-500 hover:text-white hover:border-orange-500 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition border-2 border-gray-200 shadow-sm flex items-center gap-1.5 {{ $currentStatus == 'mengantar' ? 'bg-orange-50 border-orange-400 text-orange-600 shadow-inner' : '' }}">
                                            <i class="fas fa-motorcycle"></i> Antar
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.updateStatus', $orderId) }}" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="bg-white text-gray-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition border-2 border-gray-200 shadow-sm flex items-center gap-1.5 {{ $currentStatus == 'selesai' ? 'bg-blue-50 border-blue-400 text-blue-600 shadow-inner' : '' }}">
                                            <i class="fas fa-check-circle"></i> Selesai
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="relative pt-4 pb-2 px-4 md:px-8">
                            <div class="absolute top-8 left-12 right-12 h-1.5 bg-gray-200 rounded-full z-0"></div>

                            <div id="progress-line-{{ $orderId }}" class="absolute top-8 left-12 h-1.5 bg-[#39AE1F] rounded-full z-0 transition-all duration-700 ease-in-out"
                                style="width: {{ $currentStatus == 'selesai' ? 'calc(100% - 6rem)' : ($currentStatus == 'mengantar' ? 'calc(50% - 3rem)' : '0%') }};">
                            </div>

                            <div class="relative z-10 flex justify-between items-center">
                                
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white shadow-lg transition-all duration-300 border-4 border-white {{ ($currentStatus == 'menyiapkan' || $currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'bg-[#39AE1F]' : 'bg-gray-300' }}">
                                        <i class="fas fa-fire-burner text-lg {{ $currentStatus == 'menyiapkan' ? 'animate-bounce' : '' }}"></i>
                                    </div>
                                    <span class="font-outfit text-[12px] font-black uppercase mt-3 {{ ($currentStatus == 'menyiapkan' || $currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'text-[#39AE1F]' : 'text-gray-400' }}">Disiapkan</span>
                                </div>

                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white shadow-lg transition-all duration-300 border-4 border-white {{ ($currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'bg-orange-500' : 'bg-gray-200 text-gray-400' }}">
                                        <i class="fas fa-motorcycle text-lg {{ $currentStatus == 'mengantar' ? 'animate-pulse' : '' }}"></i>
                                    </div>
                                    <span class="font-outfit text-[12px] font-black uppercase mt-3 {{ ($currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'text-orange-500' : 'text-gray-400' }}">Diantar</span>
                                </div>

                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white shadow-lg transition-all duration-300 border-4 border-white {{ $currentStatus == 'selesai' ? 'bg-blue-600' : 'bg-gray-200 text-gray-400' }}">
                                        <i class="fas fa-house-chimney-check text-lg"></i>
                                    </div>
                                    <span class="font-outfit text-[12px] font-black uppercase mt-3 {{ $currentStatus == 'selesai' ? 'text-blue-600' : 'text-gray-400' }}">Sampai</span>
                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-[40px] shadow-lg border-2 border-gray-100">
                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-box-open text-5xl text-gray-300"></i>
                        </div>
                        <h3 class="text-2xl font-black text-gray-800 uppercase font-outfit mb-2">Belum Ada Pesanan</h3>
                        <p class="text-gray-500 font-bold">Panel pesanan ini masih kosong. Tunggu pelanggan memesan menu Bar Bar!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <footer class="mt-12 relative z-30 bg-white border-t-4 border-[#FFD429]">
        <div class="bg-[#39AE1F] text-center py-3 relative z-20 shadow-inner">
            <p class="font-bold text-white text-xs md:text-sm tracking-widest uppercase">
                &copy; {{ date('Y') }} <span class="text-[#FFD429] font-black italic">BAR BAR KULINER GROUP</span>. All Rights Reserved.
            </p>
        </div>
    </footer>

    <script>
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
            }, 20);
        });
    </script>
    
    @include('components.cart-script')
</body>
</html>
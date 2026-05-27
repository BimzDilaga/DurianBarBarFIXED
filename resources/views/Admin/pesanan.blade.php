<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Manajemen Pesanan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;800;900&family=Plus+Jakarta+Sans:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <header class="bg-zinc-900 text-white py-5 px-6 shadow-md flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-10">
            <h1 class="font-outfit text-xl font-black uppercase tracking-wider text-[#FFD429]">BAR BAR CONTROL PANEL</h1>
        </div>
        <span class="bg-red-500 text-white text-xs font-black px-3 py-1 rounded-full uppercase tracking-widest animate-pulse">
            <i class="fas fa-user-shield mr-1"></i> Mode Admin
        </span>
        <a href="{{ url('/admin/produk') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-bold rounded-lg shadow-sm transition duration-200">
    <i class="fas fa-box-open text-md"></i> 
    Kembali ke Kelola Produk
</a>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h2 class="font-outfit text-3xl font-black text-zinc-800 uppercase tracking-tight">Daftar Pesanan Masuk</h2>
            <p class="text-zinc-500 font-medium text-sm mt-1">Kelola dan update status pengiriman pesanan es duren pelanggan di bawah ini.</p>
        </div>

        <div class="space-y-6">
            @forelse($orders as $order)
                @php
                    $currentStatus = strtolower($order->status_pesanan ?? 'menyiapkan');
                    $orderId = $order->order_id ?? $order->id;
                @endphp

                <div id="order-card-{{ $orderId }}" class="bg-white rounded-2xl p-6 shadow-md border border-slate-100 flex flex-col gap-6">
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-4">
                        <div>
                            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider bg-slate-100 px-2 py-1 rounded">
                                #ID: {{ $orderId }}
                            </span>
                            <h3 class="font-outfit text-xl font-black text-zinc-800 uppercase mt-2">
                                @php
                                    $daftarItem = is_string($order->items) ? json_decode($order->items, true) : $order->items;
                                @endphp
                                @if(is_array($daftarItem) && count($daftarItem) > 0)
                                    @foreach($daftarItem as $item)
                                        {{ $item['nama'] ?? $item['name'] ?? 'Menu' }} ({{ $item['qty'] ?? 1 }}x)@if(!$loop->last), @endif
                                    @endforeach
                                @else
                                    {{ $order->nama_menu ?? $order->nama ?? 'Pesanan Pelanggan' }}
                                @endif
                            </h3>
                            <p class="text-[#39AE1F] font-extrabold text-base mt-1">
                                Rp {{ number_format(($order->total_harga ?? 0), 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200 flex flex-col gap-1.5 w-full md:w-auto">
    <span class="text-[10px] font-black text-zinc-400 uppercase tracking-wider block text-center md:text-left px-1">Ubah Status Pengiriman:</span>
    
    <div class="flex gap-1">
        <form action="{{ route('admin.updateStatus', $orderId) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="menyiapkan">
            <button type="submit" class="bg-white text-zinc-700 hover:bg-green-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider transition border border-slate-200 shadow-sm flex items-center gap-1 {{ $currentStatus == 'menyiapkan' ? 'bg-green-50 border-green-300 text-green-600' : '' }}">
                <i class="fas fa-fire-burner text-xs"></i> Siapkan
            </button>
        </form>

        <form action="{{ route('admin.updateStatus', $orderId) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="mengantar">
            <button type="submit" class="bg-white text-zinc-700 hover:bg-orange-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider transition border border-slate-200 shadow-sm flex items-center gap-1 {{ $currentStatus == 'mengantar' ? 'bg-orange-50 border-orange-300 text-orange-600' : '' }}">
                <i class="fas fa-motorcycle text-xs"></i> Antar
            </button>
        </form>

        <form action="{{ route('admin.updateStatus', $orderId) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="selesai">
            <button type="submit" class="bg-white text-zinc-700 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider transition border border-slate-200 shadow-sm flex items-center gap-1 {{ $currentStatus == 'selesai' ? 'bg-blue-50 border-blue-300 text-blue-600' : '' }}">
                <i class="fas fa-check-circle text-xs"></i> Sampai
            </button>
        </form>
    </div>
</div>
                    </div>

                    <div class="relative px-2 py-2 bg-slate-50 rounded-xl border border-slate-100 p-4">
                        <div class="absolute top-7 left-8 right-8 h-1 bg-slate-200 rounded-full z-0"></div>

                        <div id="progress-line-{{ $orderId }}" class="absolute top-7 left-8 h-1 bg-[#39AE1F] rounded-full z-0 transition-all duration-500 ease-in-out"
                            style="width: {{ $currentStatus == 'selesai' ? 'calc(100% - 4rem)' : ($currentStatus == 'mengantar' ? 'calc(50% - 2rem)' : '0%') }};">
                        </div>

                        <div class="relative z-10 flex justify-between items-center">
                            
                            <div class="flex flex-col items-center">
                                <div id="node-menyiapkan-{{ $orderId }}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 {{ ($currentStatus == 'menyiapkan' || $currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'bg-[#39AE1F]' : 'bg-slate-300' }}">
                                    <i id="icon-menyiapkan-{{ $orderId }}" class="fas fa-fire-burner {{ $currentStatus == 'menyiapkan' ? 'animate-bounce' : '' }}"></i>
                                </div>
                                <span id="text-menyiapkan-{{ $orderId }}" class="font-outfit text-[11px] font-black uppercase mt-2 {{ ($currentStatus == 'menyiapkan' || $currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'text-[#39AE1F]' : 'text-slate-400' }}">Disiapkan</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div id="node-mengantar-{{ $orderId }}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 {{ ($currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'bg-orange-500' : 'bg-slate-200 text-slate-400' }}">
                                    <i id="icon-mengantar-{{ $orderId }}" class="fas fa-motorcycle {{ $currentStatus == 'mengantar' ? 'animate-pulse' : '' }}"></i>
                                </div>
                                <span id="text-mengantar-{{ $orderId }}" class="font-outfit text-[11px] font-black uppercase mt-2 {{ ($currentStatus == 'mengantar' || $currentStatus == 'selesai') ? 'text-orange-500' : 'text-slate-400' }}">Diantar</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div id="node-selesai-{{ $orderId }}" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md transition-all duration-300 {{ $currentStatus == 'selesai' ? 'bg-blue-600' : 'bg-slate-200 text-slate-400' }}">
                                    <i class="fas fa-house-chimney-check"></i>
                                </div>
                                <span id="text-selesai-{{ $orderId }}" class="font-outfit text-[11px] font-black uppercase mt-2 {{ $currentStatus == 'selesai' ? 'text-blue-600' : 'text-slate-400' }}">Sampai</span>
                            </div>

                        </div>
                    </div>

                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-slate-200">
                    <i class="fas fa-ban text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-500 font-bold">Belum ada pesanan masuk hari ini.</p>
                </div>
            @endforelse
        </div>
    </main>

    <script>
        function updateStatus(id, statusBaru) {
            // Ambil CSRF Token Laravel
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Opsional: Langsung kirim perubahan status via FETCH ke server Laravel kamu
            // Sesuaikan url '/admin/order/update-status' dengan route backend aslimu.
            fetch(`/admin/order/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ order_id: id, status: statusBaru })
            })
            .then(res => {
                // Jalankan animasi visual jika update sukses
                updateVisualDOM(id, statusBaru);
            })
            .catch(err => console.error("Gagal mengupdate status database: ", err));
        }

        // Fungsi khusus pengatur animasi DOM visual setelah klik tombol aksi
        function updateVisualDOM(id, statusBaru) {
            const progressLine = document.getElementById('progress-line-' + id);
            const nodeSiap = document.getElementById('node-menyiapkan-' + id);
            const nodeAntar = document.getElementById('node-mengantar-' + id);
            const nodeSelesai = document.getElementById('node-selesai-' + id);
            const textSiap = document.getElementById('text-menyiapkan-' + id);
            const textAntar = document.getElementById('text-mengantar-' + id);
            const textSelesai = document.getElementById('text-selesai-' + id);
            const iconSiap = document.getElementById('icon-menyiapkan-' + id);
            const iconAntar = document.getElementById('icon-mengantar-' + id);

            iconSiap.classList.remove('animate-bounce');
            iconAntar.classList.remove('animate-pulse');

            if (statusBaru === 'menyiapkan') {
                progressLine.style.width = '0%';
                nodeSiap.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-[#39AE1F]";
                nodeAntar.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-slate-200 text-slate-400";
                nodeSelesai.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-slate-200 text-slate-400";
                textSiap.className = "font-outfit text-[11px] font-black uppercase mt-2 text-[#39AE1F]";
                textAntar.className = "font-outfit text-[11px] font-black uppercase mt-2 text-slate-400";
                textSelesai.className = "font-outfit text-[11px] font-black uppercase mt-2 text-slate-400";
                iconSiap.classList.add('animate-bounce');
            } 
            else if (statusBaru === 'mengantar') {
                progressLine.style.width = 'calc(50% - 2rem)';
                nodeSiap.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-[#39AE1F]";
                nodeAntar.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-orange-500";
                nodeSelesai.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-slate-200 text-slate-400";
                textSiap.className = "font-outfit text-[11px] font-black uppercase mt-2 text-[#39AE1F]";
                textAntar.className = "font-outfit text-[11px] font-black uppercase mt-2 text-orange-500";
                textSelesai.className = "font-outfit text-[11px] font-black uppercase mt-2 text-slate-400";
                iconAntar.classList.add('animate-pulse');
            } 
            else if (statusBaru === 'selesai') {
                progressLine.style.width = 'calc(100% - 4rem)';
                nodeSiap.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-[#39AE1F]";
                nodeAntar.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-orange-500";
                nodeSelesai.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-blue-600";
                textSiap.className = "font-outfit text-[11px] font-black uppercase mt-2 text-[#39AE1F]";
                textAntar.className = "font-outfit text-[11px] font-black uppercase mt-2 text-orange-500";
                textSelesai.className = "font-outfit text-[11px] font-black uppercase mt-2 text-blue-600";
            }
        }
    </script>
</body>
</html>
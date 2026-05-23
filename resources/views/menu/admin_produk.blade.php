<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Bar Bar Es Duren</title>
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; display: flex; flex-direction: column; min-height: 100vh; margin: 0; padding: 0; background-color: #ffffff; overflow-x: hidden; }
        main { flex: 1; position: relative; overflow: hidden; }
        .top-line { width: 100%; height: 45px; background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00); background-repeat: repeat; position: relative; z-index: 100; }
        .bg-pohon { position: absolute; top: 150px; right: 0px; width: 500px; height: auto; z-index: 1; opacity: 0.9; pointer-events: none; -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%); mask-image: linear-gradient(to bottom, black 60%, transparent 100%); }
        .bg-pohon-kiri { position: absolute; top: 150px; left: 0px; width: 500px; height: auto; z-index: 1; opacity: 0.9; pointer-events: none; transform: scaleX(-1); -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%); mask-image: linear-gradient(to bottom, black 60%, transparent 100%); }
        h1, h2, h3, h4, h5, h6, .loading-text { font-family: 'Outfit', sans-serif !important; }
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

        <img src="{{ asset('image/pohon-durian.png') }}" class="bg-pohon" alt="Background Pohon Kanan">
        <img src="{{ asset('image/pohon-durian.png') }}" class="bg-pohon-kiri" alt="Background Pohon Kiri">

        <div class="max-w-7xl mx-auto mt-10 px-4 relative z-10">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 tracking-tight">Manajemen Produk</h2>
                        <p class="text-sm text-gray-500 font-semibold">Atur stok dan daftar menu Bar Bar Es secara langsung</p>
                    </div>
                    
                    <div class="flex gap-3">
                        <button id="btn-save-all" onclick="simpanSemuaStok()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 flex items-center gap-2">
                            <i class="fas fa-save"></i> Simpan Semua Stok
                        </button>
                        <button onclick="openModal()" class="bg-[#39AE1F] hover:bg-green-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition duration-300 flex items-center gap-2">
                            <i class="fas fa-plus"></i> Tambah Menu
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="w-full text-left border-collapse bg-white">
                        <thead class="bg-gray-50 border-b-2 border-gray-200 text-gray-700 text-sm uppercase tracking-wider font-bold">
                            <tr>
                                <th class="p-4 w-24">Gambar</th>
                                <th class="p-4">Nama Produk</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Harga</th>
                                <th class="p-4 text-center w-40">Sisa Stok</th>
                                <th class="p-4 text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 font-semibold text-sm">
                            
                            @php
                                $groupedMenus = collect($menus)->groupBy('kategori');
                            @endphp

                            @forelse($groupedMenus as $kategori => $items)
                                <tr class="bg-green-50/50 border-y-2 border-gray-100">
                                    <td colspan="6" class="p-3">
                                        <div class="flex items-center gap-2">
                                            <div class="bg-[#39AE1F] text-white p-1.5 rounded-lg shadow-sm">
                                                <i class="fas fa-tags text-xs"></i>
                                            </div>
                                            <span class="font-black text-gray-800 uppercase tracking-widest text-[15px]">
                                                {{ str_replace('-', ' ', $kategori) }}
                                            </span>
                                            <span class="bg-white text-gray-500 px-2 py-0.5 rounded-full text-[11px] border shadow-sm ml-2">
                                                {{ $items->count() }} Menu
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($items as $product)
                                <tr class="hover:bg-gray-50 transition duration-200 border-b border-gray-50">
                                    <td class="p-4">
                                        @if($product->gambar)
                                            <img src="{{ asset('image/' . $product->gambar) }}" alt="{{ $product->nama }}" class="w-16 h-16 object-cover rounded-xl border border-gray-200 shadow-sm">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-xl flex items-center justify-center text-xs text-gray-500 font-bold">No Img</div>
                                        @endif
                                    </td>
                                    
                                    <td class="p-4 text-[16px] font-black text-gray-800">
                                        {{ $product->nama }}
                                        @if($product->stock <= 0)
                                            <span class="ml-2 bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded-md uppercase tracking-wider">Habis</span>
                                        @endif
                                    </td>
                                    
                                    <td class="p-4">
                                        <span class="bg-[#FFD429]/20 text-[#D4AF37] px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider border border-[#FFD429]/50">
                                            {{ $product->kategori }}
                                        </span>
                                    </td>
                                    
                                    <td class="p-4 text-[#39AE1F] font-black text-[15px]">
                                        Rp {{ number_format($product->harga_baru, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="p-4">
                                        <form action="{{ url('/admin/produk/update-stok/' . $product->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                            @csrf
                                            <input type="number" name="stock" data-id="{{ $product->id }}" value="{{ $product->stock ?? 0 }}" class="input-stok-massal w-16 px-2 py-1.5 text-center border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#39AE1F] focus:ring-1 focus:ring-[#39AE1F] transition font-bold" min="0">
                                            <button type="submit" class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white p-2 rounded-lg transition duration-300 shadow-sm" title="Update Stok Ini Saja">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <td class="p-4 text-center">
                                        <form action="{{ url('/admin/produk/hapus/' . $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $product->nama }} dari database?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg transition duration-300 shadow-sm font-bold text-xs uppercase tracking-wider">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-gray-400 font-bold">
                                    <i class="fas fa-box-open text-4xl mb-3 text-gray-300"></i>
                                    <p>Belum ada produk apa-apa di database bos.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        
        <div id="modalTambah" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
            <div class="bg-white rounded-2xl shadow-2xl w-11/12 md:w-3/4 max-w-2xl max-h-[90vh] overflow-y-auto transform scale-95 transition-transform duration-300 p-6 relative">
                <div class="flex justify-between items-center mb-5 border-b pb-3">
                    <h3 class="text-2xl font-black text-gray-800">Tambah Menu Baru</h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-red-500 text-2xl font-bold transition">&times;</button>
                </div>
                <form action="{{ url('/admin/produk/tambah') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Produk</label>
                            <input type="text" name="nama" required class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F]">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" required class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F]">
                                <option value="es-durian">Es Durian</option>
                                <option value="mie-ayam">Mie Ayam</option>
                                <option value="es-dawet">Es Dawet</option>
                                <option value="es-teler">Es Teler</option>
                                <option value="cemilan">Cemilan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Harga Baru (Rp)</label>
                            <input type="number" name="harga_baru" required class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F]">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Harga Lama (Coret)</label>
                            <input type="number" name="harga_lama" value="0" class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F]">
                            <span class="text-[10px] text-gray-400">*Isi 0 jika tidak ada diskon</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Stok Awal</label>
                        <input type="number" name="stock" value="0" min="0" required class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F]">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Warna Background (Hex)</label>
                        <input type="text" name="warna_bg" value="#FFC107" required class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F]">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="2" required class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F]"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Upload Gambar</label>
                        <input type="file" name="gambar" accept="image/*" required class="w-full px-4 py-2 border rounded-xl focus:ring-[#39AE1F] focus:border-[#39AE1F] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-green-50 file:text-[#39AE1F] hover:file:bg-green-100 transition">
                    </div>
                    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeModal()" class="px-6 py-2 rounded-xl text-gray-500 font-bold hover:bg-gray-100 transition">Batal</button>
                        <button type="submit" class="bg-[#39AE1F] hover:bg-green-600 text-white font-bold py-2 px-6 rounded-xl shadow-md transition">
                            <i class="fas fa-save mr-2"></i> Simpan Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // JS Untuk Submit Semua Stok Sekaligus
        function simpanSemuaStok() {
            // Ubah teks tombol biar ada loading
            const btn = document.getElementById('btn-save-all');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            // Bikin form rahasia di background
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url("/admin/produk/update-stok-massal") }}';

            // Masukin token keamanan Laravel
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            // Ambil SEMUA kotak input yang punya class 'input-stok-massal'
            const inputs = document.querySelectorAll('.input-stok-massal');
            inputs.forEach(input => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                // Panggil ID produk dan nominal stoknya
                hiddenInput.name = `stocks[${input.getAttribute('data-id')}]`;
                hiddenInput.value = input.value;
                form.appendChild(hiddenInput);
            });

            // Jalankan formnya ke server
            document.body.appendChild(form);
            form.submit();
        }

        // Logic Buka Tutup Modal
        const modal = document.getElementById('modalTambah');
        const modalContent = modal.querySelector('div');
        function openModal() { modal.classList.remove('hidden'); modal.classList.add('flex'); setTimeout(() => { modalContent.classList.remove('scale-95'); modalContent.classList.add('scale-100'); }, 10); }
        function closeModal() { modalContent.classList.remove('scale-100'); modalContent.classList.add('scale-95'); setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300); }

        // Logic Loading Screen
        document.addEventListener('DOMContentLoaded', () => {
            const bar = document.getElementById('bar');
            const percentText = document.getElementById('percent');
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);
                    setTimeout(() => { document.body.classList.add('loaded'); setTimeout(() => { document.getElementById('loading-screen').style.display = 'none'; }, 500); }, 300);
                } else {
                    width += 5; 
                    if(bar) bar.style.width = width + '%'; 
                    if(percentText) percentText.innerText = width + '%';
                }
            }, 20);
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Bar Bar Es Duren</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; display: flex; flex-direction: column; min-height: 100vh; background-color: #f1f5f9; overflow-x: hidden; } 
        main { flex: 1; }
        .top-line { width: 100%; height: 45px; background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00); background-repeat: repeat; }
        h1, h2, h3, h4, h5, h6, button, select, input, textarea { font-family: 'Outfit', sans-serif !important; }
        .nav-link::after { content: ''; position: absolute; width: 0; height: 3px; bottom: 0; left: 50%; background-color: #39AE1F; transition: width 0.3s ease, left 0.3s ease; }
        .nav-link:hover::after { width: 100%; left: 0; }
        select::-webkit-scrollbar { width: 8px; }
        select::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        select::-webkit-scrollbar-thumb:hover { background: #39AE1F; }
    </style>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    <div class="top-line"></div>
    
    @include('components.navbar')

    <div class="bg-gradient-to-r from-[#FFC107] to-[#FF9800] w-full py-10 shadow-lg text-center relative overflow-hidden border-b-4 border-[#39AE1F]">
        <h1 class="text-white text-[50px] font-black uppercase tracking-tighter m-0 drop-shadow-md relative z-10">Checkout</h1>
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
    </div>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="bg-white p-8 md:p-10 rounded-[30px] border-t-[12px] border-[#39AE1F] shadow-2xl relative">
                <h3 class="text-2xl font-black text-gray-800 mb-8 flex items-center gap-4 uppercase border-b-2 border-gray-100 pb-4">
                    <span class="bg-gradient-to-br from-[#39AE1F] to-green-600 text-white w-12 h-12 flex items-center justify-center rounded-2xl shadow-md"><i class="fas fa-truck text-xl"></i></span> 
                    Alamat Pengiriman
                </h3>
                
                <div class="space-y-5">
                    <div class="relative group">
                        <i class="fas fa-map-marked-alt absolute left-4 top-4 text-gray-400 group-hover:text-[#39AE1F] transition"></i>
                        <select id="provinsi" onchange="updateKabupaten()" class="w-full bg-slate-50 border-2 border-gray-100 rounded-2xl pl-12 pr-4 py-3.5 font-bold text-gray-700 focus:bg-white focus:border-[#39AE1F] focus:ring-4 focus:ring-green-50 outline-none transition-all cursor-pointer">
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Daerah Istimewa Yogyakarta">Daerah Istimewa Yogyakarta</option>
                        </select>
                    </div>
                    
                    <div class="relative group">
                        <i class="fas fa-city absolute left-4 top-4 text-gray-400 group-hover:text-[#39AE1F] transition"></i>
                        <select id="kabupaten" onchange="updateOutlet()" class="w-full bg-slate-50 border-2 border-gray-100 rounded-2xl pl-12 pr-4 py-3.5 font-bold text-gray-700 focus:bg-white focus:border-[#39AE1F] focus:ring-4 focus:ring-green-50 outline-none transition-all cursor-pointer">
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                    </div>

                    <div class="relative group">
                        <i class="fas fa-store absolute left-4 top-4 text-gray-400 group-hover:text-[#39AE1F] transition"></i>
                        <select id="outlet" class="w-full bg-slate-50 border-2 border-gray-100 rounded-2xl pl-12 pr-4 py-3.5 font-bold text-[13px] md:text-sm text-gray-700 focus:bg-white focus:border-[#39AE1F] focus:ring-4 focus:ring-green-50 outline-none appearance-none transition-all cursor-pointer">
                            <option value="">Pilih Kabupaten/Kota Dulu Untuk Melihat Outlet</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <input type="text" id="desa" placeholder="Kecamatan/Desa" class="w-full bg-slate-50 border-2 border-gray-100 rounded-2xl px-6 py-3.5 font-bold text-gray-700 focus:bg-white focus:border-[#39AE1F] focus:ring-4 focus:ring-green-50 outline-none transition-all placeholder-gray-400">
                        <input type="text" id="kodepos" placeholder="Kode Pos" class="w-full bg-slate-50 border-2 border-gray-100 rounded-2xl px-6 py-3.5 font-bold text-gray-700 focus:bg-white focus:border-[#39AE1F] focus:ring-4 focus:ring-green-50 outline-none transition-all placeholder-gray-400">
                    </div>
                    
                    <textarea id="alamat_detail" placeholder="Alamat Lengkap (Jl. Nama, No Rumah, Patokan, dll)" class="w-full bg-slate-50 border-2 border-gray-100 rounded-2xl px-6 py-4 font-bold text-gray-700 h-28 focus:bg-white focus:border-[#39AE1F] focus:ring-4 focus:ring-green-50 outline-none transition-all placeholder-gray-400 resize-none"></textarea>
                </div>
            </div>

            <div class="bg-white p-8 md:p-10 rounded-[30px] border-t-[12px] border-[#FFC107] shadow-2xl flex flex-col h-full">
                <h3 class="text-2xl font-black text-gray-800 mb-8 flex items-center gap-4 uppercase border-b-2 border-gray-100 pb-4">
                    <span class="bg-gradient-to-br from-[#FFC107] to-orange-400 text-white w-12 h-12 flex items-center justify-center rounded-2xl shadow-md"><i class="fas fa-shopping-basket text-xl"></i></span> 
                    Rincian Pesanan
                </h3>
                
                @php 
                    $totalHarga = 0; 
                    $displayItems = [];

                    if(isset($buyNowData)) {
                        $parsedData = json_decode($buyNowData, true);
                        if(is_array($parsedData) && count($parsedData) > 0) {
                            $item = $parsedData[0];
                            $gambarPath = parse_url($item['image'], PHP_URL_PATH);
                            $gambarFile = basename($gambarPath);

                            $displayItems[$item['id']] = [
                                'nama' => $item['name'],
                                'harga_baru' => $item['price'],
                                'quantity' => $item['qty'],
                                'gambar' => $gambarFile
                            ];
                        }
                    } else {
                        $displayItems = session('cart', []);
                    }
                @endphp

                <div id="keranjang-container" class="flex-grow overflow-y-auto max-h-[350px] pr-2 space-y-4 mb-6">
                    @foreach($displayItems as $id => $details)
                        @php $totalHarga += $details['harga_baru'] * $details['quantity']; @endphp
                        
                        <div id="chk-produk-{{ $id }}" class="chk-product-item flex items-center gap-4 bg-slate-50 p-3.5 rounded-2xl border border-gray-200 hover:border-[#FFC107] hover:shadow-md transition-all duration-300 group" data-price="{{ $details['harga_baru'] }}">
                            <div class="bg-white p-1 rounded-xl shadow-sm border border-gray-100">
                                <img src="{{ asset('image/' . $details['gambar']) }}" class="w-16 h-16 object-contain rounded-lg group-hover:scale-105 transition duration-300">
                            </div>
                            <div class="flex-grow">
                                <h4 class="chk-nama-produk font-black uppercase text-gray-800 text-[15px] leading-tight mb-1">{{ $details['nama'] }}</h4>
                                <p class="text-[#39AE1F] font-bold text-[14px]">Rp {{ number_format($details['harga_baru'], 0, ',', '.') }}</p>
                            </div>
                            
                            <div class="flex items-center gap-1 bg-white px-2 py-1.5 rounded-full border border-gray-200 shadow-sm">
                                <button type="button" onclick="updateChkQty('{{ $id }}', 'kurang')" class="text-red-500 font-black hover:bg-red-50 w-7 h-7 rounded-full flex items-center justify-center transition">-</button>
                                <span class="chk-qty-val font-black w-6 text-center text-gray-700 text-sm" id="chk-qty-{{ $id }}">{{ $details['quantity'] }}</span>
                                <button type="button" onclick="updateChkQty('{{ $id }}', 'beli')" class="text-green-500 font-black hover:bg-green-50 w-7 h-7 rounded-full flex items-center justify-center transition">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="/menu" class="block w-full text-center border-2 border-dashed border-gray-300 bg-gray-50 py-3 rounded-2xl font-bold text-gray-500 hover:bg-green-50 hover:border-[#39AE1F] hover:text-[#39AE1F] transition-all mb-4">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Produk Lain
                </a>

                <div class="mb-6 relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-[#FFC107] to-orange-400 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl">
                        <textarea id="catatan_pesanan" placeholder="Catatan pesanan (Misal: mie ayam pedas, es dipisah, dll...)" class="w-full bg-slate-50 border-2 border-gray-100 rounded-2xl px-5 py-4 font-bold text-gray-700 h-24 focus:bg-white focus:border-[#FFC107] focus:ring-4 focus:ring-yellow-50 outline-none transition-all placeholder-gray-400 resize-none"></textarea>
                        <i class="fas fa-edit absolute right-4 top-4 text-gray-300 group-hover:text-[#FFC107] transition"></i>
                    </div>
                </div>

                <div class="mt-auto p-6 bg-gradient-to-br from-[#1a1a1a] to-[#2d2d2d] rounded-3xl text-white shadow-xl relative overflow-hidden border border-gray-800">
                    <i class="fas fa-wallet absolute -right-6 -top-6 text-[100px] text-white opacity-5 rotate-12"></i>
                    
                    <div class="flex justify-between items-center mb-6 relative z-10 border-b border-gray-600 pb-4">
                        <span class="text-lg font-black uppercase text-gray-400 tracking-wider">Total Tagihan</span>
                        <span id="total-harga-display" class="text-[#FFC107] text-3xl font-black tracking-tight drop-shadow-md">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>
                    
                    <button type="button" id="tombol-bayar" class="w-full relative z-10 bg-gradient-to-r from-[#39AE1F] to-[#2b8a16] py-4 rounded-2xl font-black text-[17px] tracking-wider uppercase hover:from-[#2b8a16] hover:to-[#1e610f] transition-all shadow-lg shadow-green-900/40 hover:scale-[1.02]">
                        <i class="fas fa-lock mr-2 text-green-200"></i> BAYAR SEKARANG
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        // --- 1. DATA WILAYAH & OUTLET ---
        const dataKab = {
            "Jawa Tengah": ["Kabupaten Banjarnegara", "Kabupaten Banyumas", "Kabupaten Batang", "Kabupaten Blora", "Kabupaten Boyolali", "Kabupaten Brebes", "Kabupaten Cilacap", "Kabupaten Demak", "Kabupaten Grobogan", "Kabupaten Jepara", "Kabupaten Karanganyar", "Kabupaten Kebumen", "Kabupaten Kendal", "Kabupaten Klaten", "Kabupaten Kudus", "Kabupaten Magelang", "Kabupaten Pati", "Kabupaten Pekalongan", "Kabupaten Pemalang", "Kabupaten Purbalingga", "Kabupaten Purworejo", "Kabupaten Rembang", "Kabupaten Semarang", "Kabupaten Sragen", "Kabupaten Sukoharjo", "Kabupaten Tegal", "Kabupaten Temanggung", "Kabupaten Wonogiri", "Kabupaten Wonosobo", "Kota Magelang", "Kota Pekalongan", "Kota Salatiga", "Kota Semarang", "Kota Surakarta", "Kota Tegal"],
            "Jawa Barat": ["Kabupaten Bandung", "Kabupaten Bandung Barat", "Kabupaten Bekasi", "Kabupaten Bogor", "Kabupaten Ciamis", "Kabupaten Cianjur", "Kabupaten Cirebon", "Kabupaten Garut", "Kabupaten Indramayu", "Kabupaten Karawang", "Kabupaten Kuningan", "Kabupaten Majalengka", "Kabupaten Pangandaran", "Kabupaten Purwakarta", "Kabupaten Subang", "Kabupaten Sukabumi", "Kabupaten Sumedang", "Kabupaten Tasikmalaya", "Kota Bandung", "Kota Banjar", "Kota Bekasi", "Kota Bogor", "Kota Cimahi", "Kota Cirebon", "Kota Depok", "Kota Sukabumi", "Kota Tasikmalaya"],
            "Jawa Timur": ["Kabupaten Bangkalan", "Kabupaten Banyuwangi", "Kabupaten Blitar", "Kabupaten Bojonegoro", "Kabupaten Bondowoso", "Kabupaten Gresik", "Kabupaten Jember", "Kabupaten Jombang", "Kabupaten Kediri", "Kabupaten Lamongan", "Kabupaten Lumajang", "Kabupaten Madiun", "Kabupaten Magetan", "Kabupaten Malang", "Kabupaten Mojokerto", "Kabupaten Nganjuk", "Kabupaten Ngawi", "Kabupaten Pacitan", "Kabupaten Pamekasan", "Kabupaten Pasuruan", "Kabupaten Ponorogo", "Kabupaten Probolinggo", "Kabupaten Sampang", "Kabupaten Sidoarjo", "Kabupaten Situbondo", "Kabupaten Sumenep", "Kabupaten Trenggalek", "Kabupaten Tuban", "Kabupaten Tulungagung", "Kota Batu", "Kota Blitar", "Kota Kediri", "Kota Madiun", "Kota Malang", "Kota Mojokerto", "Kota Pasuruan", "Kota Probolinggo", "Kota Surabaya"],
            "Daerah Istimewa Yogyakarta": ["Kabupaten Bantul", "Kabupaten Gunungkidul", "Kabupaten Kulon Progo", "Kabupaten Sleman", "Kota Yogyakarta"]
        };

        const dataSemuaOutlet = [
            { prov: "Jawa Tengah", kab: "Kabupaten Banyumas", text: "1. Es Dawet Durian bar bar - Ajibarang" },
            { prov: "Jawa Tengah", kab: "Kabupaten Cilacap", text: "2. Dawet Durian bar bar - Cilacap (Kawungaten)" },
            { prov: "Jawa Tengah", kab: "Kabupaten Cilacap", text: "3. Dawet durian bar bar raben - Cilacap" },
            { prov: "Jawa Tengah", kab: "Kabupaten Cilacap", text: "4. Dawet durian bar bar Sultan - Cilacap (Kroya)" },
            { prov: "Jawa Tengah", kab: "Kabupaten Kebumen", text: "5. Dawet durian bar bar sultan - Kebumen" },
            { prov: "Daerah Istimewa Yogyakarta", kab: "Kabupaten Sleman", text: "6. Es Dawet durian bar bar Outlet 1 - Yogyakarta (Gamping)" },
            { prov: "Daerah Istimewa Yogyakarta", kab: "Kabupaten Sleman", text: "7. Dawet durian bar bar Maguwoharjo - Yogyakarta" },
            { prov: "Jawa Tengah", kab: "Kabupaten Klaten", text: "8. Dawet durian bar bar Prambanan - Klaten" },
            { prov: "Jawa Tengah", kab: "Kabupaten Magelang", text: "9. Dawet durian bar bar magelang Blondo" },
            { prov: "Jawa Tengah", kab: "Kabupaten Magelang", text: "10. Dawet durian bar bar magelang" },
            { prov: "Jawa Tengah", kab: "Kabupaten Banjarnegara", text: "11. Radja es teler sultan & Dawet durian bar bar - Banjarnegara" },
            { prov: "Jawa Tengah", kab: "Kabupaten Banjarnegara", text: "12. Dawet durian bar bar & Raja Es teler Sultan - Banjarnegara (Klampok)" },
            { prov: "Jawa Tengah", kab: "Kabupaten Banyumas", text: "13. Dawet durian bar bar & radja es teler sultan - Purwokerto Utara" },
            { prov: "Jawa Tengah", kab: "Kota Semarang", text: "14. Dawet durian bar bar - Semarang (Pedurungan)" },
            { prov: "Jawa Tengah", kab: "Kabupaten Cilacap", text: "15. Dawet durian bar bar Majenang - Cilacap" },
            { prov: "Jawa Tengah", kab: "Kabupaten Brebes", text: "16. Dawet Durian Barbar Jatibarang - Brebes" },
            { prov: "Jawa Tengah", kab: "Kabupaten Tegal", text: "17. Dawet durian barbar Slawi - Tegal" },
            { prov: "Jawa Tengah", kab: "Kabupaten Brebes", text: "18. Dawet Durian barbar - Brebes" },
            { prov: "Jawa Tengah", kab: "Kota Tegal", text: "19. Dawet durian barbar Tegal - Kota Tegal" },
            { prov: "Jawa Tengah", kab: "Kabupaten Pemalang", text: "20. Dawet Durian Bar Bar Kaligelang - Pemalang" },
            { prov: "Jawa Tengah", kab: "Kabupaten Pemalang", text: "21. Dawet durian Bar bar Comal - Pemalang" },
            { prov: "Jawa Tengah", kab: "Kota Pekalongan", text: "22. Dawet durian barbar rajanya es durian - Kota Pekalongan" },
            { prov: "Jawa Tengah", kab: "Kabupaten Batang", text: "23. Dawet Durian barbar & rajanya es teler sultan Batang" },
            { prov: "Jawa Tengah", kab: "Kabupaten Pekalongan", text: "24. Es Dawet durian barbar Tambor - Kajen Pekalongan" }
        ];

        function updateKabupaten() {
            const prov = document.getElementById('provinsi').value;
            const kabSelect = document.getElementById('kabupaten');
            
            kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            if(dataKab[prov]) {
                dataKab[prov].forEach(k => {
                    let opt = document.createElement('option'); opt.value = k; opt.innerHTML = k; kabSelect.appendChild(opt);
                });
            }
            updateOutlet(); 
        }

        function updateOutlet() {
            const prov = document.getElementById('provinsi').value;
            const kab = document.getElementById('kabupaten').value;
            const outletSelect = document.getElementById('outlet');
            
            outletSelect.innerHTML = ''; 
            
            if (kab === "") {
                outletSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota Dulu Untuk Melihat Outlet</option>';
                return;
            }

            let outletFiltered = dataSemuaOutlet.filter(outlet => outlet.kab === kab);
            let message = "Pilih Outlet Terdekat Dengan Anda";

            if (outletFiltered.length === 0) {
                outletFiltered = dataSemuaOutlet.filter(outlet => outlet.prov === prov);
                message = "Outlet belum ada di kota ini. Ini cabang terdekat di Provinsi Anda:";
            }

            if (outletFiltered.length === 0) {
                outletFiltered = dataSemuaOutlet;
                message = "Outlet belum ada di wilayah Anda. Silakan pilih cabang alternatif:";
            }

            let defaultOpt = document.createElement('option');
            defaultOpt.value = "";
            defaultOpt.innerHTML = message;
            outletSelect.appendChild(defaultOpt);

            outletFiltered.forEach(outlet => {
                let opt = document.createElement('option'); 
                opt.value = outlet.text; 
                opt.innerHTML = outlet.text; 
                outletSelect.appendChild(opt);
            });
        }

        // --- 3. LOGIKA TAMBAH/KURANG (ANTI-BENTROK DENGAN NAVBAR) ---
        function updateChkQty(id, action) {
            let qtyElement = document.getElementById('chk-qty-' + id);
            let productElement = document.getElementById('chk-produk-' + id);
            let currentQty = parseInt(qtyElement.innerText);
            
            let newQty = action === 'beli' ? currentQty + 1 : currentQty - 1;

            if (newQty <= 0) {
                productElement.remove();
            } else {
                qtyElement.innerText = newQty;
            }

            recalculateTotal();

            fetch('/' + action + '/' + id, { method: 'GET' })
                .catch(error => console.log('Gagal update session:', error));
        }

        function recalculateTotal() {
            let total = 0;
            let items = document.querySelectorAll('.chk-product-item');
            
            items.forEach(item => {
                let price = parseInt(item.getAttribute('data-price'));
                let qty = parseInt(item.querySelector('.chk-qty-val').innerText);
                total += (price * qty);
            });

            document.getElementById('total-harga-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        // --- 4. VALIDASI & PEMBAYARAN VIA AJAX ---
        document.getElementById('tombol-bayar').onclick = async function (e) {
            e.preventDefault(); 

            const fields = ['provinsi', 'kabupaten', 'outlet', 'desa', 'alamat_detail'];
            for (let f of fields) { 
                let val = document.getElementById(f).value;
                if (!val) { 
                    alert("Waduh bos, alamat dan outlet terdekat diisi dulu biar nggak nyasar!"); 
                    return; 
                } 
            }
            
            let totalText = document.getElementById('total-harga-display').innerText;
            if(totalText === 'Rp 0') {
                alert("Keranjang kosong bos! Tambah produk dulu ya.");
                return;
            }

            const payload = {
                provinsi: document.getElementById('provinsi').value,
                kabupaten: document.getElementById('kabupaten').value,
                outlet: document.getElementById('outlet').value,
                desa: document.getElementById('desa').value,
                kodepos: document.getElementById('kodepos').value,
                alamat_detail: document.getElementById('alamat_detail').value,
                catatan: document.getElementById('catatan_pesanan') ? document.getElementById('catatan_pesanan').value : '',
                items: []
            };

            // Mengambil barang berdasarkan Class yang kebal bentrok
            document.querySelectorAll('.chk-product-item').forEach(item => {
                const idFull = item.getAttribute('id');
                const id = idFull.replace('chk-produk-', ''); 
                const harga = parseInt(item.getAttribute('data-price'));
                const qty = parseInt(item.querySelector('.chk-qty-val').innerText);
                const nama = item.querySelector('.chk-nama-produk').innerText;

                payload.items.push({ id: id, nama: nama, harga_baru: harga, quantity: qty });
            });

            const btn = document.getElementById('tombol-bayar');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> MEMPROSES...';
            btn.disabled = true;

            try {
                const response = await fetch('/proses-checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest', 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'ngrok-skip-browser-warning': '69420'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                window.snap.pay(data.snap_token, {
                    onSuccess: function(result){ 
                        let orderId = result.order_id || result.id;
                        
                        fetch('/api/midtrans-callback', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'ngrok-skip-browser-warning': '69420'
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                transaction_status: 'settlement',
                                status_code: '200'
                            })
                        })
                        .then(() => {
                            window.location.href = "/pembayaran-sukses"; 
                        })
                        .catch(err => {
                            console.error("Gagal bypass callback:", err);
                            window.location.href = "/pembayaran-sukses";
                        });
                    },
                    onPending: function(result){ 
                        alert("Menunggu pembayaran Anda..."); 
                        window.location.href = "/riwayat";
                    },
                    onError: function(result){ 
                        alert("Pembayaran gagal!"); 
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    },
                    onClose: function(){ 
                        alert("Popup ditutup tanpa menyelesaikan pembayaran."); 
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                });
            } catch (error) {
                btn.innerHTML = originalText;
                btn.disabled = false;
                alert('Terjadi kesalahan jaringan atau server.');
                console.error(error);
            }
        };
    </script>

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
    </footer>
</body>
</html>
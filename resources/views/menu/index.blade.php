<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Menu - Bar Bar Es Duren</title>
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

        .logo-glow {
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .logo-glow::before {
            content: ''; position: absolute; width: 130px; height: 130px;
            background: radial-gradient(circle, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 70%);
            border-radius: 50%; z-index: -1;
        }

        /* BACKGROUND ASSET POHON */
        .bg-pohon {
            position: absolute; top: 150px; right: 0px; width: 500px; height: auto;
            z-index: 1; opacity: 0.9; pointer-events: none; 
            -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
            mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
        }

        .bg-pohon-kiri {
            position: absolute; top: 150px; left: 0px; width: 500px; height: auto;
            z-index: 1; opacity: 0.9; pointer-events: none; transform: scaleX(-1);
            -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
            mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
        }

        h1, h2, h3, h4, h5, h6, .loading-text {
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

    <main class="relative">
        <div class="bg-[#FFD429] w-full py-6 shadow-md text-center relative z-20">
            <h1 class="text-white text-[50px] font-black uppercase tracking-tighter m-0">MENU</h1>
        </div>

        <img src="{{ asset('image/pohon-durian.png') }}" class="bg-pohon" alt="Background Pohon Kanan">
        <img src="{{ asset('image/pohon-durian.png') }}" class="bg-pohon-kiri" alt="Background Pohon Kiri">

        <div class="max-w-4xl mx-auto mt-16 mb-20 px-4 relative z-10">
            <div class="flex flex-wrap justify-center gap-12 md:gap-20">
                <a href="/menu/es-durian" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/EsDurianMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase tracking-tighter group-hover:text-[#39AE1F] transition">Es Durian</h3>
                </a>

                <a href="/menu/mie-ayam" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/MieAyamMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-120 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase tracking-tighter group-hover:text-[#39AE1F] transition">Mie Ayam</h3>
                </a>

                <a href="/menu/es-dawet" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/EsDawetMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase tracking-tighter group-hover:text-[#39AE1F] transition">Es Dawet</h3>
                </a>
            </div>

            <div class="flex flex-wrap justify-center gap-12 md:gap-28 mt-12 md:mt-16">
                <a href="/menu/cemilan" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/CemilanMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase tracking-tighter group-hover:text-[#39AE1F] transition">Cemilan</h3>
                </a>

                <a href="/menu/es-teler" class="flex flex-col items-center group transition">
                    <div class="bg-[#39AE1F] w-40 h-40 md:w-48 md:h-48 rounded-full flex items-center justify-center shadow-lg group-hover:-translate-y-3 transition duration-300 border-4 border-white">
                        <img src="{{ asset('image/EsTelerMenu.png') }}" class="w-28 h-28 md:w-32 md:h-32 object-contain drop-shadow-md group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="mt-6 text-2xl font-black text-gray-700 uppercase tracking-tighter group-hover:text-[#39AE1F] transition">Es Teler</h3>
                </a>
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

        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        if(menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                if (mobileMenu.classList.contains('hidden')) { menuIcon.classList.replace('fa-times', 'fa-bars'); } 
                else { menuIcon.classList.replace('fa-bars', 'fa-times'); }
            });
        }

        let cartData = JSON.parse(localStorage.getItem('barbar_cart')) || [];

        function formatRupiah(angka) { return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }
        function saveCart() { localStorage.setItem('barbar_cart', JSON.stringify(cartData)); }

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
            if(badge) {
                badge.innerText = totalBarang;
                badge.style.display = totalBarang > 0 ? 'block' : 'none';
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

        window.addEventListener('DOMContentLoaded', () => { renderCartHeader(); });
    </script>
</body>
</html>
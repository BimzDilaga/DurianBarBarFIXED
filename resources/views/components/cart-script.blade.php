@once
<form id="formSyncCart" action="/sync-cart" method="POST" class="hidden">
    @csrf
    <input type="hidden" id="cartDataInput" name="cart_data">
</form>

<script>
    // ==========================================
    // SCRIPT MOBILE MENU
    // ==========================================
   
    var menuBtn = document.getElementById('menuBtn');
    var mobileMenu = document.getElementById('mobileMenu');
    var menuIcon = document.getElementById('menuIcon');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if (mobileMenu.classList.contains('hidden')) { menuIcon.classList.replace('fa-times', 'fa-bars'); } 
            else { menuIcon.classList.replace('fa-bars', 'fa-times'); }
        });
    }

    // ==========================================
    // MESIN UTAMA KERANJANG (LOCAL STORAGE)
    // ==========================================
    var cartData = JSON.parse(localStorage.getItem('barbar_cart')) || [];

    function formatRupiah(angka) { return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }
    function saveCart() { localStorage.setItem('barbar_cart', JSON.stringify(cartData)); }

    var cartBtn = document.getElementById('cartBtn');
    var cartDropdown = document.getElementById('cartDropdown');

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
        var container = document.getElementById('cartItemsContainer');
        if(!container) return;

        container.innerHTML = ''; 
        var totalHarga = 0; var totalBarang = 0;

        if (cartData.length === 0) {
            container.innerHTML = `<p class="text-center text-gray-400 text-xs py-4 font-bold">Keranjang masih kosong nih :(</p>`;
        } else {
            cartData.forEach((item, index) => {
                totalHarga += item.price * item.qty;
                totalBarang += item.qty;
                container.innerHTML += `
                    <div class="flex gap-3 cart-item">
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
        var badge = document.getElementById('cartBadge');
        if(badge) {
            badge.innerText = totalBarang;
            badge.style.display = totalBarang > 0 ? 'block' : 'none';
        }
    }

    function addToCart(id, name, price, img) {
        var existingItem = cartData.find(item => item.id === id);
        if (existingItem) {
            existingItem.qty += 1; 
        } else {
            cartData.push({id, name, price, img, qty: 1}); 
        }
        saveCart(); renderCartHeader();
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
        saveCart(); renderCartHeader();
    }

    function changeQty(index, amount) {
        if(event) event.stopPropagation();
        if (cartData[index].qty + amount >= 1) {
            cartData[index].qty += amount;
            saveCart(); renderCartHeader();
        }
    }

    function prosesCheckout() {
        if (cartData.length === 0) {
            alert('Keranjang masih kosong nih, yuk jajan dulu!');
            return;
        }
        var cartJsonString = JSON.stringify(cartData);
        document.getElementById('cartDataInput').value = cartJsonString;
        document.getElementById('formSyncCart').submit();
    }

    // ==========================================
    // MESIN ANIMASI LOADING SCREEN (0% - 100%)
    // ==========================================
    var loadingScreen = document.getElementById('loading-screen');
    
    if (loadingScreen) {
        // Trik detektif 1: Mencari elemen teks persentase "0%"
        var allElements = loadingScreen.getElementsByTagName('*');
        var loadingTextElement = null;
        for (var i = 0; i < allElements.length; i++) {
            if (allElements[i].innerText && allElements[i].innerText.trim() === '0%') {
                loadingTextElement = allElements[i];
                break;
            }
        }

        // Trik detektif 2: Mencari elemen garis (bar)
        var loadingBarElement = document.getElementById('bar') || loadingScreen.querySelector('.progress-bar');
        
        var progress = 0;
        
        // Bikin timer yang jalan sangat cepat
        var interval = setInterval(function() {
            // Angka naik acak (1 sampai 4) biar kelihatan natural
            progress += Math.floor(Math.random() * 4) + 1; 
            
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval); 
                
                // Kalau sudah 100%, pudarkan layar
                setTimeout(function() {
                    loadingScreen.style.opacity = '0';
                    loadingScreen.style.transition = 'opacity 0.4s ease'; 
                    
                    setTimeout(function() {
                        loadingScreen.style.display = 'none';
                        document.body.style.overflow = 'auto'; 
                    }, 400); 
                }, 200);
            }
            
            // 1. UPDATE ANGKA
            if (loadingTextElement) {
                loadingTextElement.innerText = progress + '%';
            }

            // 2. UPDATE PANJANG GARIS (Ini yang bikin hijau-hijaunya jalan!)
            if (loadingBarElement) {
                loadingBarElement.style.width = progress + '%';
            }
            
        }, 20); // Kecepatan loading (20 milidetik per frame)
    } else {
        document.body.style.overflow = 'auto';
    }

    
    window.addEventListener('DOMContentLoaded', () => { renderCartHeader(); });

    // ==========================================
// LOGIC TOMBOL PENCARIAN (SEARCH TOGGLE)
// ==========================================
var searchToggle = document.getElementById('searchToggle');
var searchBox = document.getElementById('searchBox');
var searchInput = document.getElementById('searchInput');

if (searchToggle && searchBox) {
    // Klik tombol untuk buka/tutup
    searchToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        searchBox.classList.toggle('hidden');
        if (!searchBox.classList.contains('hidden')) {
            searchInput.focus(); // Otomatis fokus ke input kalau dibuka
        }
    });

    // Menutup pencarian jika klik di luar box
    document.addEventListener('click', function(e) {
        if (!searchBox.contains(e.target) && e.target !== searchToggle) {
            searchBox.classList.add('hidden');
        }
    });
}

// ==========================================
// MESIN PENYARING MENU (UPDATE)
// ==========================================
var searchInput = document.getElementById('searchInput');

if (searchInput) {
    searchInput.addEventListener('keyup', function() {
        var filter = this.value.toLowerCase();
        
        // Kita targetkan semua link yang mengarah ke menu (/menu/...)
        // Ini lebih akurat daripada mencari class yang mungkin salah
        var menuItems = document.querySelectorAll('a[href^="/menu/"]'); 

        menuItems.forEach(function(item) {
            // Kita cari tulisan di dalam tag <h3> yang ada di dalam link tersebut
            var titleElement = item.querySelector('h3');
            if (titleElement) {
                var title = titleElement.innerText.toLowerCase();
                
                // Cek apakah judul menu mengandung teks yang diketik
                if (title.includes(filter)) {
                    item.style.display = "flex"; // Tampilkan kembali
                } else {
                    item.style.display = "none"; // Sembunyikan
                }
            }
        });
    });
}

</script>


@endonce
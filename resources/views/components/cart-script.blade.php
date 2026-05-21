<script>
    // ==========================================
    // SCRIPT MOBILE MENU
    // ==========================================
   
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
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
        const badge = document.getElementById('cartBadge');
        if(badge) {
            badge.innerText = totalBarang;
            badge.style.display = totalBarang > 0 ? 'block' : 'none';
        }
    }

    function addToCart(id, name, price, img) {
        const existingItem = cartData.find(item => item.id === id);
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
        const cartJsonString = JSON.stringify(cartData);
        document.getElementById('cartDataInput').value = cartJsonString;
        document.getElementById('formSyncCart').submit();
    }

    window.addEventListener('DOMContentLoaded', () => { renderCartHeader(); });
</script>
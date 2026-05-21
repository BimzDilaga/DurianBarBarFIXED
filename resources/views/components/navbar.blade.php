<header class="sticky top-0 bg-white/95 backdrop-blur-md py-4 shadow-sm border-b border-gray-100 z-50 transition duration-300">
    <div class="container mx-auto max-w-7xl px-6 flex justify-between items-center">
        
        <div class="logo-glow">
            <a href="/" class="block transform hover:scale-105 transition duration-300">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[80px] md:h-[90px] object-contain">
            </a>
        </div>

        <nav class="hidden md:block">
            <ul class="flex space-x-10 text-[15px] font-[900] text-zinc-700 uppercase tracking-wider">
                <li><a href="/" class="nav-link {{ request()->is('/') ? 'text-[#39AE1F] border-b-[3px] border-[#39AE1F] pb-1' : 'hover:text-[#39AE1F]' }} transition duration-300">Home</a></li>
                
                <li><a href="/menu" class="nav-link {{ request()->is('menu*') || request()->is('detail*') ? 'text-[#39AE1F] border-b-[3px] border-[#39AE1F] pb-1' : 'hover:text-[#39AE1F]' }} transition duration-300">Menu</a></li>
                
                <li><a href="/outlet" class="nav-link {{ request()->is('outlet') ? 'text-[#39AE1F] border-b-[3px] border-[#39AE1F] pb-1' : 'hover:text-[#39AE1F]' }} transition duration-300">Outlet</a></li>
                
                <li><a href="/about" class="nav-link {{ request()->is('about') ? 'text-[#39AE1F] border-b-[3px] border-[#39AE1F] pb-1' : 'hover:text-[#39AE1F]' }} transition duration-300">About Us</a></li>
                
                <li><a href="/contact" class="nav-link {{ request()->is('contact') ? 'text-[#39AE1F] border-b-[3px] border-[#39AE1F] pb-1' : 'hover:text-[#39AE1F]' }} transition duration-300">Contact Us</a></li>
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
                            
                            <form id="formSyncCart" action="/checkout" method="POST" class="hidden">
                                @csrf
                                <input type="hidden" name="cart_data" id="cartDataInput">
                            </form>

                            <button type="button" onclick="prosesCheckout()" class="block w-full bg-[#39AE1F] text-white text-center py-2.5 rounded-xl font-[900] uppercase tracking-wider text-[13px] hover:bg-green-700 transition shadow-md italic">
                                Lanjut Checkout
                            </button>
                            
                            <a href="/menu" class="block w-full bg-green-50 text-[#39AE1F] border border-[#39AE1F] text-center py-2 rounded-xl font-[800] uppercase tracking-wider text-[12px] hover:bg-[#39AE1F] hover:text-white transition italic">
                                + Tambah Menu Lain
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
            <li><a href="/" class="block px-8 py-3 {{ request()->is('/') ? 'bg-green-50 text-[#39AE1F] border-l-4 border-[#39AE1F]' : 'hover:bg-gray-50 hover:text-[#39AE1F]' }} transition">Home</a></li>
            
            <li><a href="/menu" class="block px-8 py-3 {{ request()->is('menu*') || request()->is('detail*') ? 'bg-green-50 text-[#39AE1F] border-l-4 border-[#39AE1F]' : 'hover:bg-gray-50 hover:text-[#39AE1F]' }} transition">Menu</a></li>
            
            <li><a href="/outlet" class="block px-8 py-3 {{ request()->is('outlet') ? 'bg-green-50 text-[#39AE1F] border-l-4 border-[#39AE1F]' : 'hover:bg-gray-50 hover:text-[#39AE1F]' }} transition">Outlet</a></li>
            
            <li><a href="/about" class="block px-8 py-3 {{ request()->is('about') ? 'bg-green-50 text-[#39AE1F] border-l-4 border-[#39AE1F]' : 'hover:bg-gray-50 hover:text-[#39AE1F]' }} transition">About Us</a></li>
            
            <li><a href="/contact" class="block px-8 py-3 {{ request()->is('contact') ? 'bg-green-50 text-[#39AE1F] border-l-4 border-[#39AE1F]' : 'hover:bg-gray-50 hover:text-[#39AE1F]' }} transition">Contact Us</a></li>
        </ul>
    </nav>
</header>

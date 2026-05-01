<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap');
        
        /* FLEXBOX SETUP BIAR FOOTER NEMPEL BAWAH */
        body { 
            font-family: 'Nunito', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh; 
            margin: 0; padding: 0; background-color: #ffffff; color: #333;
        }
        main { flex: 1; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

        /* HEADER & NAVBAR */
        .top-line {
            width: 100%; height: 45px;
            background: linear-gradient(to bottom, #39AE1F, #8CFF00);
            position: relative; z-index: 99;
        }
        header { padding: 15px 0; background: white; border-bottom: 1px solid #eee; }
        .navbar { display: flex; justify-content: space-between; align-items: center; }
        .logo-area img { height: 70px; }
        nav ul { display: flex; list-style: none; gap: 25px; margin: 0; padding: 0; }
        nav ul li a { text-decoration: none; color: #555; font-weight: 800; font-size: 14px; text-transform: uppercase; transition: 0.3s;}
        nav ul li a:hover { color: #44AD24; }
        nav ul li a.active { color: #333; border-bottom: 3px solid #333; padding-bottom: 5px; } /* Garis bawah hitam sesuai gambar */
        .user-profile a { font-size: 35px; color: #44AD24; transition: transform 0.3s; display: block; }
        .user-profile a:hover { transform: scale(1.1); }

        .bg-yellow-barbar { background-color: #FFC107; }
        
        /* FOOTER */
        footer { padding: 50px 0 0 0; background: white; margin-top: 50px; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; align-items: start; }
        .footer-links h4, .footer-social h4 { font-weight: 900; margin-bottom: 20px; }
        .footer-logo img { height: 90px; opacity: 0.4; filter: grayscale(1); margin: 0 auto; display: block; }
        .social-icons { display: flex; justify-content: flex-end; gap: 20px; font-size: 30px; }
        .pattern-bg { 
            height: 100px; margin-top: 30px;
            background-color: #fffbeb; 
            background-image: radial-gradient(#fde047 20%, transparent 20%); 
            background-size: 30px 30px; 
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="top-line"></div>
    <header>
        <div class="container navbar">
            <div class="logo-area">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Barbar">
            </div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/menu">Menu</a></li>
                    <li><a href="#">Outlet</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="/contact" class="active">Contact Us</a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <a href="/profile"><i class="fas fa-circle-user"></i></a>
            </div>
        </div>
    </header>

    <main>
        <!-- Banner Kuning -->
        <div class="bg-yellow-barbar w-full py-5 shadow-sm">
            <h1 class="text-center text-white text-5xl font-black m-0 tracking-wide">Contact Us Here</h1>
        </div>

        <!-- Form Layout (Label di Kiri, Input di Kanan) -->
        <div class="max-w-4xl mx-auto mt-16 mb-20 px-8">
            <form action="#" method="POST" class="space-y-8">
                @csrf
                
                <!-- Row: Name -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3">Name</label>
                    <input type="text" name="name" placeholder="Input ur name" 
                           value="{{ auth()->check() ? auth()->user()->name : '' }}"
                           class="w-full md:w-2/3 border border-gray-400 px-4 py-2 text-gray-700 font-bold focus:outline-none focus:border-green-500">
                </div>

                <!-- Row: Phone -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3">Phone</label>
                    <div class="flex w-full md:w-2/3">
                        <span class="bg-gray-200 border border-gray-400 border-r-0 px-4 py-2 font-bold text-gray-700">+62</span>
                        <input type="text" name="phone" placeholder="Example:82192010" 
                               class="w-full border border-gray-400 px-4 py-2 text-gray-700 font-bold focus:outline-none focus:border-green-500">
                    </div>
                </div>

                <!-- Row: Email -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3">Email</label>
                    <input type="email" name="email" placeholder="Input ur email addres" 
                           value="{{ auth()->check() ? auth()->user()->email : '' }}"
                           class="w-full md:w-2/3 border border-gray-400 px-4 py-2 text-gray-700 font-bold focus:outline-none focus:border-green-500">
                </div>

                <!-- Row: Category -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3">Category</label>
                    <select name="category" class="w-full md:w-2/3 border border-gray-400 px-4 py-2 text-gray-500 font-bold focus:outline-none focus:border-green-500">
                        <option value="">Select a Category</option>
                        <option value="saran">Kritik & Saran</option>
                        <option value="pesanan">Pemesanan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Row: Message -->
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 pt-2">What Do You Want To tell</label>
                    <textarea name="message" rows="5" 
                              class="w-full md:w-2/3 border border-gray-400 px-4 py-2 text-gray-700 font-bold focus:outline-none focus:border-green-500 resize-none"></textarea>
                </div>

                <!-- Row: Button SEND -->
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <div class="hidden md:block w-1/3"></div> <!-- Spacer untuk mendorong tombol ke kanan sejajar dengan input -->
                    <div class="w-full md:w-2/3">
                        <button type="submit" class="bg-[#00a82d] text-white font-black py-2 px-8 rounded-[20px] hover:bg-green-700 transition tracking-wider">
                            SEND
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container footer-grid">
            <div class="footer-links">
                <p class="font-black text-gray-600 mb-2 text-sm"><a href="#">About Us</a></p>
                <p class="font-black text-gray-600 text-sm"><a href="/contact">Contact Us</a></p>
            </div>
            <div class="footer-logo">
                <img src="{{ asset('image/logo.png') }}" alt="Footer Logo">
            </div>
            <div class="footer-social">
                <h4 class="font-black text-xl mb-4 text-gray-900">FOLLOW US</h4>
                <div class="social-icons justify-start">
                    <i class="fab fa-instagram" style="color: #E1306C;"></i>
                    <i class="fab fa-tiktok" style="color: #000000;"></i>
                    <i class="fab fa-whatsapp" style="color: #25D366;"></i>
                </div>
            </div>
        </div>
        <div class="pattern-bg"></div>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bar Bar Es Duren</title>
    <!-- TAILWIND & FONTS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        /* KONSISTENSI STYLE BAR BAR */
        body { 
            font-family: 'Montserrat', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh; 
            margin: 0; padding: 0; background-color: #ffffff; color: #333;
            overflow-x: hidden;
        }
        main { flex: 1; }

        /* TOP LINE DENGAN TEKSTUR */
        .top-line {
            width: 100%; height: 45px;
            background-image: url("{{ asset('image/texture.png') }}"), linear-gradient(to bottom, #39AE1F, #8CFF00);
            background-repeat: repeat;
            position: relative; z-index: 99;
        }

        /* NAVBAR SINKRON */
        nav ul li a { transition: 0.3s; font-size: 12px; }
        nav ul li a:hover { color: #FFC107; }

        /* FOOTER LOOPING SESUAI LANDING PAGE */
        .footer-loop {
            width: 100%; height: 150px;
            background-image: url('{{ asset('image/footer.png') }}');
            background-repeat: repeat-x;
            background-size: contain;
            background-position: bottom;
        }
    </style>
</head>
<body>

    <!-- TOP LINE -->
    <div class="top-line"></div>

    <!-- NAVBAR UTAMA -->
    <nav class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center w-full">
        <img src="{{ asset('image/logo.png') }}" alt="Bar Bar Es Duren" class="h-16">
        
        <ul class="hidden md:flex gap-8 text-gray-800 font-black text-xs uppercase tracking-wider">
            <li><a href="/" class="hover:text-yellow-500">Home</a></li>
            <li><a href="/menu" class="hover:text-yellow-500">Menu</a></li>
            <li><a href="/outlet" class="hover:text-yellow-500">Outlet</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="text-yellow-500">Contact Us</a></li>
        </ul>

        <div class="text-[#39AE1F] text-4xl">
            <a href="/profile" class="hover:scale-110 transition duration-300 inline-block">
                <i class="fas fa-user-circle"></i>
            </a>
        </div>
    </nav>

    <main>
        <!-- BANNER JUDUL -->
        <div class="bg-[#FFC107] w-full py-6 shadow-sm">
            <h1 class="text-center text-white text-5xl font-black italic uppercase tracking-tighter">Contact Us Here</h1>
        </div>

        <!-- FORM LAYOUT -->
        <div class="max-w-4xl mx-auto mt-16 mb-20 px-8">
            <form action="#" method="POST" class="space-y-8">
                @csrf
                
                <!-- Row: Name -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 italic uppercase">Name</label>
                    <input type="text" name="name" placeholder="Input ur name" 
                           class="w-full md:w-2/3 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F]">
                </div>

                <!-- Row: Phone -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 italic uppercase">Phone</label>
                    <div class="flex w-full md:w-2/3">
                        <span class="bg-gray-100 border-2 border-gray-200 border-r-0 rounded-l-xl px-4 py-3 font-black text-gray-500">+62</span>
                        <input type="text" name="phone" placeholder="82192010" 
                               class="w-full border-2 border-gray-200 rounded-r-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F]">
                    </div>
                </div>

                <!-- Row: Email -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 italic uppercase">Email</label>
                    <input type="email" name="email" placeholder="Input ur email address" 
                           class="w-full md:w-2/3 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F]">
                </div>

                <!-- Row: Message -->
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <label class="font-black text-lg text-gray-900 w-full md:w-1/3 pt-2 italic uppercase">What Do You Want To Tell</label>
                    <textarea name="message" rows="5" placeholder="Tulis pesan barbar kamu di sini..."
                              class="w-full md:w-2/3 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 font-bold focus:outline-none focus:border-[#39AE1F] resize-none"></textarea>
                </div>

                <!-- Row: Button SEND -->
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <div class="hidden md:block w-1/3"></div>
                    <div class="w-full md:w-2/3">
                        <button type="submit" class="bg-[#39AE1F] text-white font-black py-3 px-12 rounded-[20px] hover:bg-green-700 transition tracking-tighter italic">
                            SEND IT!
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- FOOTER KONSISTEN (LOOPING IMAGE) -->
    <footer class="w-full mt-20">
        <div class="footer-loop"></div>
    </footer>

</body>
</html>
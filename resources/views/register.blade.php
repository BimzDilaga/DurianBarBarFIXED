<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
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

        /* ================= STYLE HALAMAN DAFTAR ================= */
        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: #f3f4f6; 
            background-image: url("{{ asset('image/texture.png') }}"); 
            background-blend-mode: multiply;
            overflow: hidden; /* Biar gak bisa scroll pas loading */
        }
        .loaded { overflow: auto; }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen p-4 relative">

    <div id="loading-screen">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="loader-logo">
        <div class="progress-container">
            <div class="progress-bar" id="bar"></div>
        </div>
        <div class="loading-text" id="percent">0%</div>
    </div>

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#39AE1F] opacity-20 blur-[100px] rounded-full z-0"></div>

    <div class="bg-white p-8 md:p-10 rounded-[40px] shadow-2xl w-full max-w-md border-2 border-gray-100 relative z-10">
        
        <div class="flex justify-center mb-4">
            <img src="{{ asset('image/Logo.png') }}" alt="Logo Bar Bar" class="h-20 object-contain drop-shadow-md">
        </div>

        <h1 class="text-3xl font-black text-center mb-6 italic uppercase tracking-tighter text-black">
            Buat Akun
        </h1>
        
        <div class="flex bg-gray-100 p-1 rounded-2xl mb-8 shadow-inner">
            <a href="/login" class="flex-1 text-center py-3 font-bold text-gray-500 rounded-xl hover:bg-white hover:text-[#39AE1F] hover:shadow-sm transition">
                Login
            </a>
            <a href="/register" class="flex-1 text-center py-3 font-black text-black bg-[#FFD429] rounded-xl shadow-md transition">
                Daftar
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 shadow-sm">
                <ul class="list-disc list-inside font-bold text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="/register" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}" 
                    class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl font-bold text-gray-800 focus:bg-white focus:border-[#39AE1F] focus:outline-none transition">
            </div>
            <div>
                <input type="email" name="email" placeholder="Alamat Email" required value="{{ old('email') }}" 
                    class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl font-bold text-gray-800 focus:bg-white focus:border-[#39AE1F] focus:outline-none transition">
            </div>
            
            <!-- TAMBAHAN INPUT NOMOR HP -->
            <div>
                <input type="tel" name="no_hp" placeholder="Nomor HP / WhatsApp" required value="{{ old('no_hp') }}" 
                    class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl font-bold text-gray-800 focus:bg-white focus:border-[#39AE1F] focus:outline-none transition">
            </div>
            <!-- ======================= -->

            <div>
                <input type="password" name="password" placeholder="Password (Min. 6 karakter)" required 
                    class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl font-bold text-gray-800 focus:bg-white focus:border-[#39AE1F] focus:outline-none transition">
            </div>
            <div>
                <input type="password" name="password_confirmation" placeholder="Ulangi Password" required 
                    class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl font-bold text-gray-800 focus:bg-white focus:border-[#39AE1F] focus:outline-none transition">
            </div>
            
            <button type="submit" class="w-full bg-[#39AE1F] hover:bg-green-700 text-white font-black text-lg py-4 rounded-2xl uppercase italic tracking-widest shadow-lg hover:-translate-y-1 transition duration-300 mt-4">
                Daftar Sekarang
            </button>
        </form>
        
        <p class="text-center mt-8 font-bold text-gray-500">
            Sudah punya akun? <a href="/login" class="text-[#39AE1F] hover:text-green-700 border-b-2 border-[#39AE1F] pb-0.5 transition">Login di sini</a>
        </p>
    </div>

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
                        setTimeout(() => {
                            document.getElementById('loading-screen').style.display = 'none';
                        }, 500);
                    }, 300);
                } else {
                    width += 5;
                    bar.style.width = width + '%';
                    percentText.innerText = width + '%';
                }
            }, 30);
        });
    </script>
    @include('components.cart-script')
</body>
</html>
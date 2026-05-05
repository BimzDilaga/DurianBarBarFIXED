<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Bar Bar Es Duren</title>
    <!-- Tailwind CSS & Font -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: #f3f4f6; /* Abu-abu terang biar bersih */
            background-image: url("{{ asset('image/texture.png') }}"); /* Tambahan tekstur tipis kalau mau */
            background-blend-mode: multiply;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen p-4 relative">

    <!-- Efek Glow Hijau di Background -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#39AE1F] opacity-20 blur-[100px] rounded-full z-0"></div>

    <!-- KOTAK FORM -->
    <div class="bg-white p-8 md:p-10 rounded-[40px] shadow-2xl w-full max-w-md border-2 border-gray-100 relative z-10">
        
        <!-- Logo Kecil di Atas Form (Opsional, hapus kalau nggak perlu) -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('image/logo.png') }}" alt="Logo Bar Bar" class="h-20 object-contain drop-shadow-md">
        </div>

        <h1 class="text-3xl font-black text-center mb-6 italic uppercase tracking-tighter text-black">
            Buat Akun
        </h1>
        
        <!-- TAB GROUP (LOGIN / DAFTAR) -->
        <div class="flex bg-gray-100 p-1 rounded-2xl mb-8 shadow-inner">
            <a href="/login" class="flex-1 text-center py-3 font-bold text-gray-500 rounded-xl hover:bg-white hover:text-[#39AE1F] hover:shadow-sm transition">
                Login
            </a>
            <a href="/register" class="flex-1 text-center py-3 font-black text-black bg-[#FFD429] rounded-xl shadow-md transition">
                Daftar
            </a>
        </div>

        <!-- ALERT ERROR -->
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 shadow-sm">
                <ul class="list-disc list-inside font-bold text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- FORM INPUT -->
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
        
        <!-- LINK KE LOGIN -->
        <p class="text-center mt-8 font-bold text-gray-500">
            Sudah punya akun? <a href="/login" class="text-[#39AE1F] hover:text-green-700 border-b-2 border-[#39AE1F] pb-0.5 transition">Login di sini</a>
        </p>
    </div>
</body>
</html>
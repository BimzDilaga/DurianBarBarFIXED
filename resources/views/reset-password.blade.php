<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: #f3f4f6; 
            background-image: url("{{ asset('image/texture.png') }}"); 
            background-blend-mode: multiply;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen p-4 relative">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#39AE1F] opacity-20 blur-[100px] rounded-full z-0"></div>

    <div class="bg-white p-8 md:p-10 rounded-[40px] shadow-2xl w-full max-w-md border-2 border-gray-100 relative z-10">
        
        <div class="flex justify-center mb-4">
            <img src="{{ asset('image/logo.png') }}" alt="Logo Bar Bar" class="h-20 object-contain drop-shadow-md">
        </div>

        <h1 class="text-2xl font-black text-center mb-2 italic uppercase tracking-tighter text-black">
            Password Baru
        </h1>
        <p class="text-center text-sm font-bold text-gray-500 mb-8">
            Silakan buat password baru kamu di bawah ini.
        </p>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded-xl mb-6 shadow-sm font-bold text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/reset-password" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <input type="email" name="email" value="{{ request()->email }}" readonly 
                    class="w-full px-5 py-4 bg-gray-200 border-2 border-gray-300 rounded-2xl font-bold text-gray-500 cursor-not-allowed focus:outline-none">
            </div>
            
            <div>
                <input type="password" name="password" placeholder="Password Baru" required 
                    class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl font-bold text-gray-800 focus:bg-white focus:border-[#39AE1F] focus:outline-none transition">
            </div>

            <div>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required 
                    class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl font-bold text-gray-800 focus:bg-white focus:border-[#39AE1F] focus:outline-none transition">
            </div>
            
            <button type="submit" class="w-full bg-[#39AE1F] hover:bg-green-700 text-white font-black text-lg py-4 rounded-2xl uppercase italic tracking-widest shadow-lg hover:-translate-y-1 transition duration-300 mt-4">
                Simpan Password
            </button>
        </form>
    </div>

</body>
</html>
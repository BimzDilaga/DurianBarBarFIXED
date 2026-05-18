<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen relative">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#39AE1F] opacity-20 blur-[100px] rounded-full z-0"></div>

    <div class="bg-white p-10 rounded-[40px] shadow-2xl max-w-md text-center relative z-10 border-2 border-gray-100">
        
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 bg-green-100 text-[#39AE1F] rounded-full flex items-center justify-center text-4xl">
                📩
            </div>
        </div>

        <h1 class="text-3xl font-black text-gray-800 mb-4 italic uppercase tracking-tighter">Cek Email Kamu!</h1>
        <p class="text-gray-600 mb-6 font-bold">
            Terima kasih sudah mendaftar! Kami telah mengirimkan link verifikasi ke alamat email kamu. Silakan klik link tersebut untuk mengaktifkan akun.
        </p>

        @if (session('message'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-[#39AE1F] text-green-700 font-bold rounded-xl text-sm">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-[#39AE1F] hover:bg-green-700 text-white font-black py-4 rounded-2xl uppercase italic tracking-widest shadow-lg hover:-translate-y-1 transition duration-300">
                Kirim Ulang Email
            </button>
        </form>
        
        <div class="mt-6">
            <a href="/profile" class="text-gray-400 hover:text-gray-600 font-bold underline transition text-sm">
                Kembali ke Profil
            </a>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Bar Bar Es Duren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            display: flex; flex-direction: column; min-height: 100vh;
            margin: 0; padding: 0; background-color: #f3f4f6; /* Warna abu-abu background layar */
        }
        main { flex: 1; }
        
        /* Animasi Centang */
        .animate-bounce-in {
            animation: bounceIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.1); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

    <header class="bg-white py-4 shadow-sm w-full">
        <div class="container mx-auto px-8 flex justify-center items-center">
            <a href="/">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-[80px] object-contain">
            </a>
        </div>
    </header>

    <main class="flex items-center justify-center p-6">
        
        <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-md overflow-hidden text-center transform transition-all duration-500 hover:scale-105">
            
            <div class="bg-[#FFC107] py-4 shadow-sm">
                <h2 class="text-white text-2xl font-black italic tracking-tighter m-0">Pembayaran berhasil</h2>
            </div>

            <div class="p-10 pt-12 pb-12 flex flex-col items-center">
                <div class="w-28 h-28 bg-[#52C41A] rounded-full flex items-center justify-center shadow-lg mb-6 border-[8px] border-green-100 animate-bounce-in">
                    <i class="fas fa-check text-white text-5xl"></i>
                </div>
                
                <h3 class="text-3xl font-black text-gray-700 mb-2 tracking-tighter">Pembayaran berhasil!</h3>
                <p class="text-gray-500 font-bold mb-10 text-sm">Mohon tunggu produk diantar</p>
                
                <a href="/" class="bg-[#39AE1F] text-white px-10 py-3 rounded-full font-black text-lg hover:bg-green-700 transition shadow-md uppercase italic w-full">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </main>

</body>
</html>
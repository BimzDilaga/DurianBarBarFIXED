<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Bar Es Duren - Lezat & Mantap</title>
    <!-- Import Tailwind or CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gaya bulat-bulat ala Canva yang kamu suka */
        .circle-bg {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 215, 0, 0.2);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>
<body class="bg-yellow-50 overflow-x-hidden">
    <div class="circle-bg -top-10 -left-10"></div>

    <nav class="p-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-yellow-700">Bar Bar Es Duren</h1>
        <div>
            <a href="/login" class="px-4 py-2 text-yellow-800">Login</a>
            <a href="/register" class="bg-yellow-600 text-white px-4 py-2 rounded-lg">Register</a>
        </div>
    </nav>

    <main class="flex flex-col items-center justify-center min-h-screen text-center px-4">
        <h2 class="text-5xl font-extrabold text-gray-800 mb-4">Nikmati Sensasi Duren<br><span class="text-yellow-600">Bar Bar Es Duren</span></h2>
        <p class="text-gray-600 mb-8 max-w-lg">
            Temukan berbagai menu andalan kami, mulai dari Bar Bar Es Duren hingga camilan favorit seperti Udang Keju.
        </p>
        
        <div class="flex gap-4">
            <a href="/menu" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-8 rounded-full transition">
                Lihat Menu
            </a>
            <a href="#about" class="border-2 border-yellow-600 text-yellow-600 font-bold py-3 px-8 rounded-full hover:bg-yellow-600 hover:text-white transition">
                Tentang Kami
            </a>
        </div>
    </main>

    <!-- Section Produk yang mau kamu tambahin -->
    <section class="py-20 bg-white" id="about">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-3xl font-bold mb-10">Menu Andalan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-6 border rounded-xl shadow-sm">
                    <div class="w-full h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                        <span class="text-gray-400">Gambar Es Duren</span>
                    </div>
                    <h4 class="font-bold text-xl">Bar Bar Es Duren</h4>
                    <p class="text-gray-500">Duren asli dengan topping melimpah.</p>
                </div>
                <div class="p-6 border rounded-xl shadow-sm">
                    <div class="w-full h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                        <span class="text-gray-400">Gambar Udang Keju</span>
                    </div>
                    <h4 class="font-bold text-xl">Udang Keju</h4>
                    <p class="text-gray-500">Gurihnya udang dipadu keju lumer.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
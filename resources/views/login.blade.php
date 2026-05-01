<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Bar Bar Es Duren</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #666; display: flex; justify-content: center; align-items: center; height: 100vh; font-family: Arial; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 30px; width: 400px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .tab-group { display: flex; border: 1px solid #ccc; border-radius: 10px; overflow: hidden; margin-bottom: 20px; }
        .tab { flex: 1; padding: 10px; text-decoration: none; color: #333; }
        .tab.active { background: #ffc107; font-weight: bold; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 15px; box-sizing: border-box; }
        .btn-green { background: #39AE1F; color: white; border: none; width: 100%; padding: 15px; border-radius: 20px; font-weight: bold; cursor: pointer; margin-top: 10px; font-size: 16px; }
        .btn-green:hover { background: #2c8c16; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 10px; margin-bottom: 15px; font-size: 14px; text-align: left; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 10px; margin-bottom: 15px; font-size: 14px; text-align: left; }
    </style>
</head>
<body>
    <div class="card">
        <h1>FORM LOGIN</h1>
        
        <div class="tab-group">
            <a href="/login" class="tab active">Login</a>
            <a href="/register" class="tab">Daftar</a>
        </div>

        <!-- Notifikasi kalau sukses daftar atau salah password -->
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        
        <form action="/login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn-green">Login</button>
        </form>
        
        <p style="margin-top: 20px;">Belum punya akun? <a href="/register" style="color: #39AE1F; font-weight: bold; text-decoration: none;">Daftar sekarang</a></p>
    </div>
</body>
</html>
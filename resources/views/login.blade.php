<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Bar Bar Es Duren</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #666; display: flex; justify-content: center; align-items: center; height: 100vh; font-family: Arial; }
        .card { background: white; padding: 40px; border-radius: 30px; width: 400px; text-align: center; }
        .tab-group { display: flex; border: 1px solid #ccc; border-radius: 10px; overflow: hidden; margin-bottom: 20px; }
        .tab { flex: 1; padding: 10px; text-decoration: none; color: #333; }
        .tab.active { background: #ffc107; font-weight: bold; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 15px; }
        .btn-green { background: #39AE1F; color: white; border: none; width: 100%; padding: 15px; border-radius: 20px; font-weight: bold; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>FORM LOGIN</h1>
        <div class="tab-group">
            <a href="/login" class="tab active">Login</a>
            <a href="/register" class="tab">Daftar</a>
        </div>
        <form action="/login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Masukan Email" required>
            <input type="password" name="password" placeholder="Masukan Password" required>
            <button type="submit" class="btn-green">Login</button>
        </form>
        <p style="margin-top: 20px;">Belum punya akun? <a href="/register">Daftar sekarang</a></p>
    </div>
</body>
</html>
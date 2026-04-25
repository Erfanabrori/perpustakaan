<!DOCTYPE html>
<html>
<head>
    <title>Login Perpustakaan</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5e7eb;
        }

        .container {
            width: 900px;
            height: 500px;
            background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
            border-radius: 20px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {opacity:0; transform: translateY(30px);}
            to {opacity:1; transform: translateY(0);}
        }

        /* LEFT SIDE */
        .left {
            flex: 1;
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .left h1 {
            font-size: 40px;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .left p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* decorative circle */
        .left::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            bottom: -80px;
            left: -80px;
        }

        /* RIGHT SIDE */
        .right {
            width: 360px;
            background: white;
            border-radius: 20px;
            margin: 30px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            animation: slideIn 0.8s ease;
        }

        @keyframes slideIn {
            from {opacity:0; transform: translateX(40px);}
            to {opacity:1; transform: translateX(0);}
        }

        .right h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            transition: 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
        }

        .row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 15px;
            color: #6b7280;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37,99,235,0.4);
        }

        .signup {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #6b7280;
        }

        .signup a {
            color: #2563eb;
            text-decoration: none;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 12px;
        }

    </style>
</head>
<body>

<div class="container">

    <div class="left">
        <h1>WELCOME</h1>
        <p>Sistem manajemen perpustakaan modern untuk membantu pengelolaan buku, peminjaman, dan anggota dengan lebih efisien.</p>
    </div>

    <div class="right">
        <h2>Sign in</h2>
        <div class="subtitle">Masuk ke akun anda</div>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">

            <div class="row">
                <span><input type="checkbox"> Remember</span>
                <span>Lupa?</span>
            </div>

            <button type="submit" class="btn">Sign in</button>
        </form>

        <div class="signup">
            Belum punya akun? <a href="#">Daftar</a>
        </div>
    </div>

</div>

</body>
</html>

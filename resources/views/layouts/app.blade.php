<!DOCTYPE html>
<html>
<head>
    <title>Sistem Manajemen Perpustakaan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            display: flex;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #1e3a8a, #2563eb);
            color: white;
            position: fixed;
            padding: 25px 20px;
            transition: all 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .sidebar a, .sidebar button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            color: white;
            background: transparent;
            border: none;
            padding: 12px 14px;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .sidebar a:hover, .sidebar button:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(5px);
        }

        .content {
            margin-left: 280px;
            padding: 35px;
            width: 100%;
            animation: fadeIn 0.6s ease;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .btn {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(37,99,235,0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #1e3a8a;
            color: white;
        }

        tr {
            transition: background 0.2s ease;
        }

        tr:hover {
            background: #f1f5f9;
        }

        input {
            padding: 10px;
            width: 100%;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
        }

        .alert {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 10px;
            margin-bottom: 15px;
            animation: slideDown 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>

<div class="sidebar">
    <h2>📚 Perpustakaan</h2>

    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('books.index') }}">📖 Daftar Buku</a>
    <a href="{{ route('borrowers.index') }}">👥 Daftar Peminjam</a>
    <a href="{{ route('borrowings.index') }}">📋 Transaksi Peminjaman</a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">🚪 Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>

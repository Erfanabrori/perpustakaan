@extends('layouts.app')

@section('content')

<style>
    .dash-header{
        margin-bottom:25px;
        animation: fadeIn 0.6s ease;
    }

    .dash-header h1{
        font-size:28px;
        color:#1e293b;
    }

    .dash-header p{
        color:#64748b;
        margin-top:5px;
    }

    .grid{
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
        gap:20px;
        margin-bottom:25px;
    }

    .card{
        background:white;
        border-radius:16px;
        padding:20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.06);
        transition:0.3s;
        position:relative;
        overflow:hidden;
        animation: fadeUp 0.5s ease;
    }

    .card::before{
        content:'';
        position:absolute;
        width:120px;
        height:120px;
        background:linear-gradient(135deg,#6366f1,#3b82f6);
        opacity:0.1;
        border-radius:50%;
        top:-40px;
        right:-40px;
    }

    .card:hover{
        transform:translateY(-6px);
        box-shadow:0 20px 35px rgba(0,0,0,0.1);
    }

    .card h3{
        font-size:14px;
        color:#64748b;
        margin-bottom:8px;
    }

    .card h1{
        font-size:28px;
        color:#1e293b;
    }

    .card p{
        font-size:13px;
        color:#94a3b8;
        margin-top:5px;
    }

    .feature-card{
        background:linear-gradient(135deg,#1d4ed8,#2563eb);
        color:white;
    }

    .feature-list{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:10px;
        margin-top:10px;
    }

    .feature-item{
        background:rgba(255,255,255,0.1);
        padding:10px;
        border-radius:10px;
        font-size:13px;
        transition:0.2s;
    }

    .feature-item:hover{
        background:rgba(255,255,255,0.2);
        transform:scale(1.05);
    }

    @keyframes fadeUp {
        from {opacity:0; transform: translateY(20px);}
        to {opacity:1; transform: translateY(0);}
    }

    @keyframes fadeIn {
        from {opacity:0;}
        to {opacity:1;}
    }
</style>

<div class="dash-header">
    <h1>Dashboard Perpustakaan</h1>
    <p>Selamat datang, {{ Auth::user()->name }} 👋</p>
</div>

<div class="grid">
    <div class="card">
        <h3>Total Buku</h3>
        <h1>{{ $totalBooks }}</h1>
        <p>Jumlah judul buku tersedia</p>
    </div>

    <div class="card">
        <h3>Total Stok Buku</h3>
        <h1>{{ $totalStock }}</h1>
        <p>Total seluruh stok buku</p>
    </div>

    <div class="card">
        <h3>Total Peminjam</h3>
        <h1>{{ $totalBorrowers ?? 0 }}</h1>
        <p>Jumlah peminjam aktif</p>
    </div>

    <div class="card">
        <h3>Buku Dipinjam</h3>
        <h1>{{ $totalBorrowings ?? 0 }}</h1>
        <p>Transaksi peminjaman aktif</p>
    </div>

    <div class="card">
        <h3>Status Sistem</h3>
        <h1 style="color:#22c55e;">Aktif</h1>
        <p>Sistem berjalan normal</p>
    </div>
</div>

<div class="card feature-card">
    <h2>Fitur Sistem</h2>

    <div class="feature-list">
        <div class="feature-item">📚 Daftar Buku</div>
        <div class="feature-item">👥 Daftar Peminjam</div>
        <div class="feature-item">📖 Transaksi Peminjaman</div>
        <div class="feature-item">🔍 Search Buku</div>
        <div class="feature-item">➕ Tambah Buku</div>
        <div class="feature-item">➕ Tambah Peminjam</div>
        <div class="feature-item">✏️ Edit Buku</div>
        <div class="feature-item">🔄 Pengembalian Buku</div>
    </div>
</div>

@endsection

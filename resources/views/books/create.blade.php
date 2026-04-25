@extends('layouts.app')

@section('content')

<h1 style="margin-bottom: 20px;">Tambah Buku</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <input type="text" name="judul" placeholder="Judul Buku" required style="margin-bottom:12px;">
        <input type="text" name="penulis" placeholder="Penulis" required style="margin-bottom:12px;">
        <input type="text" name="penerbit" placeholder="Penerbit" required style="margin-bottom:12px;">
        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required style="margin-bottom:12px;">
        <input type="number" name="stok" placeholder="Stok Buku" required style="margin-bottom:12px;">

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Simpan
            </button>

            <a href="{{ route('books.index') }}"
               class="btn btn-danger"
               style="flex:1; text-align:center; text-decoration:none;">
                Kembali
            </a>
        </div>

    </form>
</div>

@endsection

@extends('layouts.app')

@section('content')

<h1 style="margin-bottom: 20px;">Edit Buku</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="judul" value="{{ $book->judul }}" required style="margin-bottom:12px;">
        <input type="text" name="penulis" value="{{ $book->penulis }}" required style="margin-bottom:12px;">
        <input type="text" name="penerbit" value="{{ $book->penerbit }}" required style="margin-bottom:12px;">
        <input type="number" name="tahun_terbit" value="{{ $book->tahun_terbit }}" required style="margin-bottom:12px;">
        <input type="number" name="stok" value="{{ $book->stok }}" required style="margin-bottom:12px;">

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Update
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

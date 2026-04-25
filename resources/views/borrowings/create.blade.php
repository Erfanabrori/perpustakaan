@extends('layouts.app')

@section('content')

<h1 style="margin-bottom: 20px;">Tambah Peminjaman</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        <select name="book_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Buku --</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->judul }} (Stok: {{ $book->stok }})</option>
            @endforeach
        </select>

        <select name="borrower_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Peminjam --</option>
            @foreach($borrowers as $borrower)
                <option value="{{ $borrower->id }}">{{ $borrower->nama }}</option>
            @endforeach
        </select>

        <input type="date" name="tanggal_pinjam" required style="margin-bottom:12px;">
        <input type="date" name="tanggal_jatuh_tempo" required style="margin-bottom:12px;">

        <textarea name="keterangan" placeholder="Keterangan (opsional)" style="margin-bottom:12px; min-height:80px; width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:inherit;"></textarea>

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Simpan
            </button>

            <a href="{{ route('borrowings.index') }}"
               class="btn btn-danger"
               style="flex:1; text-align:center; text-decoration:none;">
                Kembali
            </a>
        </div>

    </form>
</div>

@endsection

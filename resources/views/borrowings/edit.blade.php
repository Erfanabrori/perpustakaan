@extends('layouts.admin')

@section('content')

<h1 style="margin-bottom: 20px;">Edit Peminjaman</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST">
        @csrf
        @method('PUT')

        <select name="book_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Buku --</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}" {{ $borrowing->book_id == $book->id ? 'selected' : '' }}>{{ $book->judul }} (Stok: {{ $book->stok }})</option>
            @endforeach
        </select>

        <select name="borrower_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Peminjam --</option>
            @foreach($borrowers as $borrower)
                <option value="{{ $borrower->id }}" {{ $borrowing->borrower_id == $borrower->id ? 'selected' : '' }}>{{ $borrower->nama }}</option>
            @endforeach
        </select>

        <input type="date" name="tanggal_pinjam" value="{{ $borrowing->tanggal_pinjam }}" required style="margin-bottom:12px;">
        <input type="date" name="tanggal_kembali" value="{{ $borrowing->tanggal_kembali }}" style="margin-bottom:12px;">
        <input type="date" name="tanggal_jatuh_tempo" value="{{ $borrowing->tanggal_jatuh_tempo }}" required style="margin-bottom:12px;">

        <select name="status" required style="margin-bottom:12px;">
            <option value="dipinjam" {{ $borrowing->status === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="dikembalikan" {{ $borrowing->status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            <option value="terlambat" {{ $borrowing->status === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
        </select>

        <textarea name="keterangan" placeholder="Keterangan (opsional)" style="margin-bottom:12px; min-height:80px; width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:inherit;">{{ $borrowing->keterangan }}</textarea>

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Update
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

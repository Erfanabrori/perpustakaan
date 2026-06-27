@extends('layouts.admin')

@section('content')

<h1 style="margin-bottom: 20px;">Edit Peminjaman</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <select name="buku_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Buku --</option>
            @foreach($bukus as $buku)
                <option value="{{ $buku->id }}" {{ $peminjaman->buku_id == $buku->id ? 'selected' : '' }}>{{ $buku->judul }} (Stok: {{ $buku->stok }})</option>
            @endforeach
        </select>

        <select name="peminjam_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Peminjam --</option>
            @foreach($peminjams as $peminjam)
                <option value="{{ $peminjam->id }}" {{ $peminjaman->peminjam_id == $peminjam->id ? 'selected' : '' }}>{{ $peminjam->nama }}</option>
            @endforeach
        </select>

        <input type="date" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" required style="margin-bottom:12px;">
        <input type="date" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}" style="margin-bottom:12px;">
        <input type="date" name="tanggal_jatuh_tempo" value="{{ $peminjaman->tanggal_jatuh_tempo }}" required style="margin-bottom:12px;">

        <select name="status" required style="margin-bottom:12px;">
            <option value="dipinjam" {{ $peminjaman->status === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="dikembalikan" {{ $peminjaman->status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            <option value="terlambat" {{ $peminjaman->status === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
        </select>

        <textarea name="keterangan" placeholder="Keterangan (opsional)" style="margin-bottom:12px; min-height:80px; width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:inherit;">{{ $peminjaman->keterangan }}</textarea>

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Update
            </button>

            <a href="{{ route('peminjaman.index') }}"
               class="btn btn-danger"
               style="flex:1; text-align:center; text-decoration:none;">
                Kembali
            </a>
        </div>

    </form>
</div>

@endsection

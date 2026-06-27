@extends('layouts.admin')

@section('content')

<h1 style="margin-bottom: 20px;">Tambah Peminjaman</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <select name="buku_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Buku --</option>
            @foreach($bukus as $buku)
                <option value="{{ $buku->id }}">{{ $buku->judul }} (Stok: {{ $buku->stok }})</option>
            @endforeach
        </select>

        <select name="peminjam_id" required style="margin-bottom:12px;">
            <option value="">-- Pilih Peminjam --</option>
            @foreach($peminjams as $peminjam)
                <option value="{{ $peminjam->id }}">{{ $peminjam->nama }}</option>
            @endforeach
        </select>

        <input type="date" name="tanggal_pinjam" required style="margin-bottom:12px;">
        <input type="date" name="tanggal_jatuh_tempo" required style="margin-bottom:12px;">

        <textarea name="keterangan" placeholder="Keterangan (opsional)" style="margin-bottom:12px; min-height:80px; width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:inherit;"></textarea>

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Simpan
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

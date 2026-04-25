@extends('layouts.app')

@section('content')

<h1 style="margin-bottom: 20px;">Tambah Peminjam</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('borrowers.store') }}" method="POST">
        @csrf

        <input type="text" name="nama" placeholder="Nama Peminjam" required style="margin-bottom:12px;">
        <input type="email" name="email" placeholder="Email" required style="margin-bottom:12px;">
        <input type="text" name="telepon" placeholder="Nomor Telepon" required style="margin-bottom:12px;">
        <textarea name="alamat" placeholder="Alamat" required style="margin-bottom:12px; min-height:80px; width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:inherit;"></textarea>

        <select name="status" required style="margin-bottom:12px;">
            <option value="">-- Pilih Status --</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Simpan
            </button>

            <a href="{{ route('borrowers.index') }}"
               class="btn btn-danger"
               style="flex:1; text-align:center; text-decoration:none;">
                Kembali
            </a>
        </div>

    </form>
</div>

@endsection

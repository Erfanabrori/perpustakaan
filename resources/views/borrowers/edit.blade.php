@extends('layouts.admin')

@section('content')

<h1 style="margin-bottom: 20px;">Edit Peminjam</h1>

<div class="card" style="max-width: 420px;">
    <form action="{{ route('borrowers.update', $borrower->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="nama" value="{{ $borrower->nama }}" required style="margin-bottom:12px;">
        <input type="email" name="email" value="{{ $borrower->email }}" required style="margin-bottom:12px;">
        <input type="text" name="telepon" value="{{ $borrower->telepon }}" required style="margin-bottom:12px;">
        <textarea name="alamat" required style="margin-bottom:12px; min-height:80px; width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:inherit;">{{ $borrower->alamat }}</textarea>

        <select name="status" required style="margin-bottom:12px;">
            <option value="aktif" {{ $borrower->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ $borrower->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>

        <div style="display:flex; gap:10px; margin-top:15px;">
            <button class="btn" type="submit" style="flex:1;">
                Update
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

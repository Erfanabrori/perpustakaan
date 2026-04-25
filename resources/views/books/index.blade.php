@extends('layouts.app')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        animation: fadeIn 0.5s ease;
    }

    .page-header h1 {
        font-size: 26px;
        color: #1e293b;
    }

    .search-box {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-box input {
        min-width: 250px;
    }

    /* FIX BUTTON */
    .btn {
        font-size: 13px;
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none; /* hilangkan underline */
        height: 34px;
    }

    .action-btns {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .action-btns form {
        margin: 0;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        font-weight: 500;
    }

    td {
        color: #334155;
    }

    tr:hover {
        background: #f8fafc;
    }

    .empty {
        text-align: center;
        padding: 20px;
        color: #94a3b8;
    }

</style>

<div class="page-header">
    <h1>📚 Daftar Buku</h1>
</div>

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div class="card">
    <form method="GET" action="{{ route('books.index') }}" class="search-box">
        <input
            type="text"
            name="search"
            placeholder="🔍 Cari judul, penulis, atau penerbit..."
            value="{{ $search }}"
        >

        <button class="btn" type="submit">Search</button>
        <a href="{{ route('books.create') }}" class="btn">+ Tambah Buku</a>
    </form>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $book->judul }}</strong></td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->penerbit }}</td>
                    <td>{{ $book->tahun_terbit }}</td>
                    <td>
                        <span style="color:#16a34a; font-weight:600;">
                            {{ $book->stok }}
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger"
                                    onclick="return confirm('Yakin hapus buku?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty">
                        📭 Data buku tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:15px;">
        {{ $books->links() }}
    </div>
</div>

@endsection

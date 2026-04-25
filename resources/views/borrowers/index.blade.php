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

    .btn {
        font-size: 13px;
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
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

    .status-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-aktif {
        background: #dcfce7;
        color: #166534;
    }

    .status-nonaktif {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="page-header">
    <h1>👥 Daftar Peminjam</h1>
</div>

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div class="card">
    <form method="GET" action="{{ route('borrowers.index') }}" class="search-box">
        <input
            type="text"
            name="search"
            placeholder="🔍 Cari nama, email, atau telepon..."
            value="{{ $search }}"
        >

        <button class="btn" type="submit">Search</button>
        <a href="{{ route('borrowers.create') }}" class="btn">+ Tambah Peminjam</a>
    </form>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowers as $borrower)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $borrower->nama }}</strong></td>
                    <td>{{ $borrower->email }}</td>
                    <td>{{ $borrower->telepon }}</td>
                    <td>{{ Str::limit($borrower->alamat, 30) }}</td>
                    <td>
                        <span class="status-badge {{ $borrower->status === 'aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                            {{ ucfirst($borrower->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('borrowers.edit', $borrower->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('borrowers.destroy', $borrower->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger"
                                    onclick="return confirm('Yakin hapus peminjam?')"
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
                        <p>📭 Tidak ada data peminjam</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card" style="margin-top: 15px;">
    {{ $borrowers->links() }}
</div>

@endsection

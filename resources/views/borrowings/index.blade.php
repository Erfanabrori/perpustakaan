@extends('layouts.admin')

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

    .search-box input, .search-box select {
        min-width: 200px;
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

    .status-dipinjam {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-dikembalikan {
        background: #dcfce7;
        color: #166534;
    }

    .status-terlambat {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="page-header">
    <h1>📖 Transaksi Peminjaman</h1>
</div>

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div class="card">
    <form method="GET" action="{{ route('borrowings.index') }}" class="search-box">
        <input
            type="text"
            name="search"
            placeholder="🔍 Cari peminjam atau buku..."
            value="{{ $search }}"
        >

        <select name="status">
            <option value="">-- Semua Status --</option>
            <option value="dipinjam" {{ $status === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="dikembalikan" {{ $status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            <option value="terlambat" {{ $status === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
        </select>

        <button class="btn" type="submit">Filter</button>
        <a href="{{ route('borrowings.create') }}" class="btn">+ Peminjaman Baru</a>
    </form>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Buku</th>
                    <th>Peminjam</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $borrowing->book->judul }}</strong></td>
                    <td>{{ $borrowing->borrower->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($borrowing->tanggal_jatuh_tempo)->format('d/m/Y') }}</td>
                    <td>
                        @if($borrowing->tanggal_kembali)
                            {{ \Carbon\Carbon::parse($borrowing->tanggal_kembali)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status-{{ $borrowing->status }}">
                            @if($borrowing->status === 'dipinjam')
                                Dipinjam
                            @elseif($borrowing->status === 'dikembalikan')
                                Dikembalikan
                            @else
                                Terlambat
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            @if($borrowing->status === 'dipinjam')
                                <form action="{{ route('borrowings.kembalikan', $borrowing->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="btn"
                                        style="background:#16a34a; color:white;"
                                        onclick="return confirm('Konfirmasi pengembalian buku?')"
                                    >
                                        Kembalikan
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('borrowings.edit', $borrowing->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger"
                                    onclick="return confirm('Yakin hapus transaksi?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty">
                        <p>📭 Tidak ada data peminjaman</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card" style="margin-top: 15px;">
    {{ $borrowings->links() }}
</div>

@endsection

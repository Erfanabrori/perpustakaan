@extends('layouts.user')

@section('content')
<h3>Daftar Buku</h3>

<table class="table">
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach($books as $book)
    <tr>
        <td>{{ $book->judul }}</td>
        <td>{{ $book->penulis }}</td>
        <td>{{ $book->stok }}</td>
        <td>
            <form action="/user/borrow/{{ $book->id }}" method="POST">
                @csrf
                <button class="btn btn-primary">Pinjam</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

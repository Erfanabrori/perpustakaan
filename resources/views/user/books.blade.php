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

    @foreach($bukus as $buku)
    <tr>
        <td>{{ $buku->judul }}</td>
        <td>{{ $buku->penulis }}</td>
        <td>{{ $buku->stok }}</td>
        <td>
            <form action="/user/borrow/{{ $buku->id }}" method="POST">
                @csrf
                <button class="btn btn-primary">Pinjam</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

@extends('layouts.user')

@section('content')
<h3>Buku Saya</h3>

<table class="table">
    <tr>
        <th>Judul</th>
        <th>Tgl Pinjam</th>
        <th>Jatuh Tempo</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $d->book->judul }}</td>
        <td>{{ $d->tgl_pinjam }}</td>
        <td>{{ $d->jatuh_tempo }}</td>
        <td>
            <form action="/user/return/{{ $d->id }}" method="POST">
                @csrf
                <button class="btn btn-danger">Kembalikan</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

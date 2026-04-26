@extends('layouts.user')

@section('content')
<h3>Dashboard User</h3>

<div class="row">
    <div class="col-md-4">
        <div class="card p-3">
            Total Buku: {{ $totalBooks }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            Buku Dipinjam: {{ $borrowed }}
        </div>
    </div>
</div>
@endsection

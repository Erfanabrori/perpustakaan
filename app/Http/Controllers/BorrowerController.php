<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $borrowers = Peminjam::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('telepon', 'like', "%{$search}%");
        })->latest()->paginate(5);

        return view('peminjam.index', compact('borrowers', 'search'));
    }

    public function create()
    {
        return view('peminjam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:peminjams,email',
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Peminjam::create($request->all());

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil ditambahkan!');
    }

    public function edit(Peminjam $peminjam)
    {
        return view('peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:peminjams,email,' . $peminjam->id,
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $peminjam->update($request->all());

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil diperbarui!');
    }

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil dihapus!');
    }
}

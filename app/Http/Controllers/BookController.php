<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $books = Buku::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%")
                ->orWhere('penerbit', 'like', "%{$search}%");
        })->latest()->paginate(5);

        return view('bukus.index', compact('books', 'search'));
    }

    public function create()
    {
        return view('bukus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required|integer'
        ]);

        Buku::create($request->all());

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Buku $bukus)
    {
        return view('bukus.edit', compact('bukus'));
    }

    public function update(Request $request, Buku $bukus)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required|integer'
        ]);

        $bukus->update($request->all());

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $bukus)
    {
        $bukus->delete();

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function userIndex()
    {
        $books = \App\Models\Buku::all();
        return view('user.books', compact('books'));
    }
}

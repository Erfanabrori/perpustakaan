<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $borrowers = Borrower::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('telepon', 'like', "%{$search}%");
        })->latest()->paginate(5);

        return view('borrowers.index', compact('borrowers', 'search'));
    }

    public function create()
    {
        return view('borrowers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:borrowers,email',
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Borrower::create($request->all());

        return redirect()->route('borrowers.index')->with('success', 'Peminjam berhasil ditambahkan!');
    }

    public function edit(Borrower $borrower)
    {
        return view('borrowers.edit', compact('borrower'));
    }

    public function update(Request $request, Borrower $borrower)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:borrowers,email,' . $borrower->id,
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $borrower->update($request->all());

        return redirect()->route('borrowers.index')->with('success', 'Peminjam berhasil diperbarui!');
    }

    public function destroy(Borrower $borrower)
    {
        $borrower->delete();

        return redirect()->route('borrowers.index')->with('success', 'Peminjam berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Borrower;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $borrowings = Borrowing::with(['book', 'borrower'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('borrower', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('book', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(5);

        return view('borrowings.index', compact('borrowings', 'search', 'status'));
    }

    public function create()
    {
        $books = Book::where('stok', '>', 0)->get();
        $borrowers = Borrower::where('status', 'aktif')->get();

        return view('borrowings.create', compact('books', 'borrowers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower_id' => 'required|exists:borrowers,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after:tanggal_pinjam',
            'keterangan' => 'nullable'
        ]);

        // Kurangi stok buku
        $book = Book::find($request->book_id);
        $book->decrement('stok');

        Borrowing::create([
            'book_id' => $request->book_id,
            'borrower_id' => $request->borrower_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'dipinjam',
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function edit(Borrowing $borrowing)
    {
        $books = Book::all();
        $borrowers = Borrower::where('status', 'aktif')->get();

        return view('borrowings.edit', compact('borrowing', 'books', 'borrowers'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower_id' => 'required|exists:borrowers,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
            'keterangan' => 'nullable'
        ]);

        // Jika status berubah menjadi dikembalikan, kembalikan stok
        if ($request->status === 'dikembalikan' && $borrowing->status !== 'dikembalikan') {
            $book = Book::find($request->book_id);
            $book->increment('stok');
        }

        $borrowing->update($request->all());

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function destroy(Borrowing $borrowing)
    {
        // Kembalikan stok jika buku masih dipinjam
        if ($borrowing->status === 'dipinjam') {
            $book = Book::find($borrowing->book_id);
            $book->increment('stok');
        }

        $borrowing->delete();

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dihapus!');
    }

    public function kembalikan(Borrowing $borrowing)
    {
        $borrowing->update([
            'tanggal_kembali' => Carbon::now()->toDateString(),
            'status' => 'dikembalikan'
        ]);

        // Kembalikan stok buku
        $book = Book::find($borrowing->book_id);
        $book->increment('stok');

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan!');
    }
}

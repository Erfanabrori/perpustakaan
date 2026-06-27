<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $borrowings = Peminjaman::with(['buku', 'peminjam'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('peminjam', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(5);

        return view('peminjaman.index', compact('borrowings', 'search', 'status'));
    }

    public function create()
    {
        $books = Buku::where('stok', '>', 0)->get();
        $borrowers = Peminjam::where('status', 'aktif')->get();

        return view('peminjaman.create', compact('books', 'borrowers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'peminjam_id' => 'required|exists:peminjams,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after:tanggal_pinjam',
            'keterangan' => 'nullable'
        ]);

        $buku = Buku::find($request->buku_id);
        $buku->decrement('stok');

        Peminjaman::create([
            'buku_id' => $request->buku_id,
            'peminjam_id' => $request->peminjam_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'dipinjam',
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $books = Buku::all();
        $borrowers = Peminjam::where('status', 'aktif')->get();

        return view('peminjaman.edit', compact('peminjaman', 'books', 'borrowers'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'peminjam_id' => 'required|exists:peminjams,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
            'keterangan' => 'nullable'
        ]);

        if ($request->status === 'dikembalikan' && $peminjaman->status !== 'dikembalikan') {
            $buku = Buku::find($request->buku_id);
            $buku->increment('stok');
        }

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dipinjam') {
            $buku = Buku::find($peminjaman->buku_id);
            $buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus!');
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        $peminjaman->update([
            'tanggal_kembali' => Carbon::now()->toDateString(),
            'status' => 'dikembalikan'
        ]);

        $buku = Buku::find($peminjaman->buku_id);
        $buku->increment('stok');

        return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan!');
    }

    // USER PINJAM BUKU
    public function borrow($id)
    {
        $peminjam = Peminjam::where('user_id', auth()->id())->first();

        if (!$peminjam) {
            return back()->with('error', 'Data peminjam tidak ditemukan');
        }

        Peminjaman::create([
            'peminjam_id' => $peminjam->id,
            'buku_id' => $id,
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(7),
            'status' => 'dipinjam'
        ]);

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    // USER LIHAT BUKU YANG DIPINJAM
    public function myBooks()
    {
        $peminjam = Peminjam::where('user_id', auth()->id())->first();

        if (!$peminjam) {
            return back()->with('error', 'Data peminjam tidak ditemukan');
        }

        $data = Peminjaman::with('buku')
            ->where('peminjam_id', $peminjam->id)
            ->where('status', 'dipinjam')
            ->get();

        return view('user.my_books', compact('data'));
    }

    // USER KEMBALIKAN BUKU
    public function returnBook($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update([
            'tanggal_kembali' => now(),
            'status' => 'dikembalikan'
        ]);

        $buku = Buku::find($pinjam->buku_id);
        $buku->increment('stok');

        return back()->with('success', 'Buku dikembalikan');
    }
}

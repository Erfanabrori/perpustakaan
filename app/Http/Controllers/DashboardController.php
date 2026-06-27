<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjam;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Buku::count();
        $totalStock = Buku::sum('stok');
        $totalBorrowers = Peminjam::where('status', 'aktif')->count();
        $totalBorrowings = Peminjaman::where('status', 'dipinjam')->count();

        return view('dashboard', compact('totalBooks', 'totalStock', 'totalBorrowers', 'totalBorrowings'));
    }

    public function user()
    {
        $user = auth()->user();

        $totalBooks = \App\Models\Buku::count();

        // Get borrower data for this user
        $peminjam = \App\Models\Peminjam::where('user_id', $user->id)->first();

        $borrowed = 0;
        if ($peminjam) {
            $borrowed = \App\Models\Peminjaman::where('peminjam_id', $peminjam->id)
                        ->where('status', 'dipinjam')
                        ->count();
        }

        return view('user.dashboard', compact('totalBooks', 'borrowed'));
    }
}

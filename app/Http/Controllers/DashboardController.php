<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalStock = Book::sum('stok');
        $totalBorrowers = Borrower::where('status', 'aktif')->count();
        $totalBorrowings = Borrowing::where('status', 'dipinjam')->count();

        return view('dashboard', compact('totalBooks', 'totalStock', 'totalBorrowers', 'totalBorrowings'));
    }

    public function user()
    {
        $user = auth()->user();

        $totalBooks = \App\Models\Book::count();

        // Get borrower data for this user
        $borrower = \App\Models\Borrower::where('user_id', $user->id)->first();

        $borrowed = 0;
        if ($borrower) {
            $borrowed = \App\Models\Borrowing::where('borrower_id', $borrower->id)
                        ->where('status', 'dipinjam')
                        ->count();
        }

        return view('user.dashboard', compact('totalBooks', 'borrowed'));
    }
}

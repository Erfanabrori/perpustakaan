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
}

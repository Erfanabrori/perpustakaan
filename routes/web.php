<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\BorrowingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN AREA
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', BookController::class);
    Route::resource('borrowers', BorrowerController::class);
    Route::resource('borrowings', BorrowingController::class);
    Route::post('borrowings/{borrowing}/kembalikan', [BorrowingController::class, 'kembalikan'])->name('borrowings.kembalikan');
});

// USER AREA
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');

    // daftar buku
    Route::get('/user/books', [BookController::class, 'userIndex'])->name('user.books');

    // pinjam buku
    Route::post('/user/borrow/{id}', [BorrowingController::class, 'borrow'])->name('borrow.book');

    // buku yang dipinjam
    Route::get('/user/my-books', [BorrowingController::class, 'myBooks'])->name('user.mybooks');

    // kembalikan buku
    Route::post('/user/return/{id}', [BorrowingController::class, 'returnBook'])->name('return.book');
});

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    protected $fillable = [
        'book_id',
        'borrower_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_jatuh_tempo',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_jatuh_tempo' => 'date',
    ];

    /**
     * Get the book that belongs to this borrowing.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get the borrower that belongs to this borrowing.
     */
    public function borrower()
    {
        return $this->belongsTo(Borrower::class, 'borrower_id');
    }
}

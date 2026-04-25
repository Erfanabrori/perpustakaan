<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrower extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'status'
    ];

    /**
     * Get all borrowings for this borrower.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
}

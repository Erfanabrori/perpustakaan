<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjam extends Model
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
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'peminjam_id');
    }
}

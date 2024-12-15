<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_nota',
        'tgl_transaksi',
        'user_id',
        'nama_pembeli',
        'status',
        'total_harga', // Tambahkan kolom total_harga
        'created_at',
        'updated_at',
    ];
    // di model Transaction
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    // Scope untuk filter transaksi berdasarkan 'search'
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('no_nota', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('nama_pembeli', 'like', '%' . $filters['search'] . '%');
        }
    }

}

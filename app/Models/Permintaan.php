<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';
    public $timestamps = true; // Enable timestamps for created_at

    protected $fillable = [
        'nama_pengaju',
        'nama_barang',
        'jumlah',
        'alasan',
        'status',
        'tanggal',
    ];
}

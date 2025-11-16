<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stok;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';
    public $timestamps = true;

    protected $fillable = [
        'barang_id',
        'jumlah',
        'tanggal_keluar',
        'keterangan',
    ];

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'barang_id');
    }
}

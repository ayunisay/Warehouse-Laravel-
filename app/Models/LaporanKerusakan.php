<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stok;

class LaporanKerusakan extends Model
{
    use HasFactory;
    
    protected $table = 'laporan_kerusakan';
    public $timestamps = true;
    
    protected $fillable = [
        'barang_id',
        'jumlah',
        'keterangan',
        'tanggal',
        'status',
    ];

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'barang_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Rak;
use App\Models\Supplier;    

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stoks';
    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'jumlah',
        'rak_id',
        'supplier_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'rak_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}

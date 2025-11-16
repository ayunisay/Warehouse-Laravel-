<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    public $timestamps = false; // Add this line

    protected $fillable = [
        'nama_supplier',
        'kontak_supplier',
        'alamat_supplier',
    ];
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stok;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stok::create([
            'nama_barang' => 'Laptop Dell',
            'kategori_id' => 1,
            'jumlah' => 5,
            'rak_id' => 1,
            'supplier_id' => 1,
        ]);

        Stok::create([
            'nama_barang' => 'Monitor 24"',
            'kategori_id' => 1,
            'jumlah' => 10,
            'rak_id' => 1,
            'supplier_id' => 1,
        ]);
    }
}

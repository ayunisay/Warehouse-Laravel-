<?php

namespace Database\Seeders;

use App\Models\BarangKeluar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\String\b;

class BarangKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BarangKeluar::create([
            'stok_id' => 1,
            'jumlah_keluar' => 2,
            'tanggal_keluar' => '2024-06-15',
            'keterangan' => 'Pengiriman ke cabang A',
        ]);

        BarangKeluar::create([
            'stok_id' => 2,
            'jumlah_keluar' => 1,
            'tanggal_keluar' => '2024-06-16',
            'keterangan' => 'Pengiriman ke cabang B',
        ]);
    }
}

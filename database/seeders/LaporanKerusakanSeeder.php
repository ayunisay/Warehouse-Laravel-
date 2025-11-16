<?php

namespace Database\Seeders;

use App\Models\LaporanKerusakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanKerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaporanKerusakan::create([
            'barang_id' => 1,
            'jumlah' => 2,
            'keterangan' => 'Layar pecah',
            'tanggal' => '2025-11-15',
            'status' => 'Pending',
        ]);
        LaporanKerusakan::create([
            'barang_id' => 2,
            'jumlah' => 1,
            'keterangan' => 'Tidak menyala',
            'tanggal' => '2025-11-16',
            'status' => 'Pending',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permintaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermintaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permintaan::create([
            'nama_pengaju' => 'John Doe',
            'nama_barang' => 'Laptop',
            'jumlah' => 5,
            'alasan' => 'For new employees',
            'status' => 'pending',
            'tanggal' => '2025-11-14',
        ]);
    }
}

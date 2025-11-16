<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'nama_supplier' => 'Tech Supplies Co.',
            'kontak_supplier' => '123-456-7890',
            'alamat_supplier' => '123 Tech Street',
        ]);
    }
}

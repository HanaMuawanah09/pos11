<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::factory()
            ->count(100)
            ->create([
                'jenis_id' => Jenis::inRandomOrder()->value('id'),
            ]);
    }
}

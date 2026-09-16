<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenis;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_jenis' => 'Makanan', 'keterangan' => 'Produk makanan'],
            ['nama_jenis' => 'Minuman', 'keterangan' => 'Produk minuman'],
            ['nama_jenis' => 'Snack', 'keterangan' => 'Produk cemilan'],
            ['nama_jenis' => 'Kebutuhan Rumah Tangga', 'keterangan' => 'Produk kebutuhan rumah tangga'],
            ['nama_jenis' => 'Lainnya', 'keterangan' => null],
        ];

        foreach ($data as $item) {
            Jenis::firstOrCreate(
                ['nama_jenis' => $item['nama_jenis']],
                $item
            );
        }
    }
}
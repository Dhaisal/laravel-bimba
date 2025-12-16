<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_sesi')->insert([
            [
                'nama_sesi' => 'Sesi 3x/ bulan',
                'deskripsi' => 'Harga sesi = Rp 200.000/ bulan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sesi' => 'Sesi 4x/ bulan',
                'deskripsi' => 'Harga sesi = Rp 250.000/ bulan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sesi' => 'Sesi 5x/ bulan',
                'deskripsi' => 'Harga sesi = Rp 300.000/ bulan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sesi' => 'Sesi 6x/ bulan',
                'deskripsi' => 'Harga sesi = Rp 350.000/ bulan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

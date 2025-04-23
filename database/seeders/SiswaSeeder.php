<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class SiswaSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         //
//     }
// }

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        Siswa::insert([
            ['nama' => 'Budi Santoso', 'kelas' => '10A'],
            ['nama' => 'Siti Aminah', 'kelas' => '10B'],
            ['nama' => 'Rizki Hidayat', 'kelas' => '11A'],
        ]);
    }
}


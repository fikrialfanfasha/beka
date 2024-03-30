<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Jurusan;
use Faker\Factory as Faker;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $jurusanIds = Jurusan::pluck('id')->toArray();

        $kelasPrefixes = ['X', 'XI', 'XII'];
        $jurusanPrefixes = ['RPL', 'TKJ', 'ATPH'];

        foreach ($kelasPrefixes as $kelasPrefix) {
            foreach ($jurusanPrefixes as $jurusanPrefix) {
                // Misalnya, setiap kombinasi memiliki beberapa nomor kelas
                for ($i = 1; $i <= 5; $i++) {
                    $namaKelas = $kelasPrefix . ' ' . $jurusanPrefix . ' ' . $i;
                    Kelas::create([
                        'nama' => $namaKelas,
                        'jurusan_id' => $faker->randomElement($jurusanIds)
                    ]);
                }
            }
        }
    }
}

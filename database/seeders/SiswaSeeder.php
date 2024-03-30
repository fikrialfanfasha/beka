<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kelasIds = Kelas::pluck('id')->toArray();

        for ($i = 0; $i < 120; $i++) {
            $nama = $faker->firstName . ' ' . $faker->firstName . ' ' . $faker->lastName;

            Siswa::create([
                'nama' => $nama,
                'kelas_id' => $faker->randomElement($kelasIds)
            ]);
        }
    }
}

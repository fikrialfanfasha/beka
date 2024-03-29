<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $kelasIds = Kelas::pluck('id')->toArray();

        for ($i = 0; $i < 120; $i++) {
            Siswa::create([
                'nama' => $faker->name,
                'kelas_id' => $faker->randomElement($kelasIds)
            ]);
        }
    }
}
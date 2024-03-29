<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        for ($i = 0; $i < 15; $i++) {
            Kelas::create([
                'nama' => 'Kelas ' . $faker->unique()->randomNumber(2),
                'jurusan_id' => $faker->randomElement($jurusanIds)
            ]);
        }
    }
}

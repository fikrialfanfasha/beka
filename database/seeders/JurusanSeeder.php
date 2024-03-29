<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use Faker\Factory as Faker;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            Jurusan::create([
                'nama' => $faker->unique()->word . ' ' . $faker->unique()->word,
            ]);
        }
    }
}

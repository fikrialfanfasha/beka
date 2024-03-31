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
        $fakerIndonesia = Faker::create('id_ID');
        $fakerPolandia = Faker::create('pl_PL');

        $kelasIds = Kelas::pluck('id')->toArray();

        for ($i = 0; $i < 120; $i++) {
            $firstNameIndonesia = $fakerIndonesia->firstName;
            $lastName = $fakerPolandia->lastName();

            $nama = $firstNameIndonesia . ' ' . $lastName;

            $nis = '101' . $fakerIndonesia->unique()->numerify('######');

            Siswa::create([
                'nama' => $nama,
                'nis' => $nis,
                'kelas_id' => $fakerIndonesia->randomElement($kelasIds)
            ]);
        }
    }
}

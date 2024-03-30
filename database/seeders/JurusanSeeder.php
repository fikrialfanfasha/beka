<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        // Data jurusan yang diinginkan
        $jurusanData = [
            ['nama' => 'RPL'],
            ['nama' => 'TKJ'],
            ['nama' => 'ATPH']
        ];

        // Looping untuk membuat jurusan
        foreach ($jurusanData as $jurusan) {
            Jurusan::create($jurusan);
        }

        $this->command->info('Seeder Jurusan berhasil dijalankan.');
    }
}

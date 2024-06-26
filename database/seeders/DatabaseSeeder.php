<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // JurusanSeeder::class,
            // KelasSeeder::class,
            SiswaSeeder::class,
            // RoleSeeder::class
            // tambahkan seeder lainnya jika ada
        ]);
    }
}

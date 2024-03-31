<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Buat peran (role) admin jika belum ada
        $role_admin = Role::updateOrCreate(
            ['name' => 'admin'],
            ['name' => 'admin']
        );

        // Buat peran (role) siswa jika belum ada
        $role_user = Role::updateOrCreate(
            ['name' => 'siswa'],
            ['name' => 'siswa']
        );

        // Buat satu akun pengguna (user) dengan peran admin
        $user = User::updateOrCreate(
            ['email' => 'admin@example.com'], // Ubah sesuai dengan email yang diinginkan
            [
                'name' => 'Admin', // Nama pengguna
                'password' => bcrypt('password') // Password (sesuaikan dengan password yang diinginkan)
            ]
        );

        // Tambahkan peran admin ke pengguna tersebut
        $user->assignRole($role_admin);
    }
}

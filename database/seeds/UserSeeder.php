<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@role.test',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $guru = User::create([
            'name' => 'Guru',
            'email' => 'guru@role.test',
            'password' => bcrypt('12345678'),
        ]);

        $guru->assignRole('guru');
    }
}

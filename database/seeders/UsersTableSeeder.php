<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Admin',
            'lastname' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'rol_id' => 1
        ]);

        User::create([
            'name' => 'Kevin Cliente',
            'lastname' => 'cliente',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('password'),
            'rol_id' => 2
        ]);

        User::create([
            'name' => 'Carlos Empleado',
            'lastname' => 'empleado',
            'email' => 'empleado@gmail.com',
            'password' => bcrypt('password'),
            'rol_id' => 3
        ]);
    }
}

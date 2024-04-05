<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([
            'name' => 'admin',
            'description' => 'Tiene acceso a toda la info',
        ]);
    
        Rol::create([
            'name' => 'cliente',
            'description' => 'Tiene acceso a la info del cliente',
        ]);
    
        Rol::create([
            'name' => 'empleado',
            'description' => 'Tiene acceso a la info del empleado',
        ]);
    }
}

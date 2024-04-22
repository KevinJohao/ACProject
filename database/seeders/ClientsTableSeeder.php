<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'user_id' => 2,
            'work_place' => 'Carabuela'
        ]);

        Client::create([
            'user_id' => 3,
            'work_place' => 'Atuntaqui'
        ]);

        Client::create([
            'user_id' => 4,
            'work_place' => 'San Pablo'
        ]);

    }
}

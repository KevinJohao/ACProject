<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'user_id'=>5
        ]);

        Employee::create([
            'user_id'=>6
        ]);

        Employee::create([
            'user_id'=>7
        ]);
    }
}

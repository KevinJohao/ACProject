<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear proyectos aleatorios
        foreach (range(1, 50) as $index) {
            \App\Models\Project::create([
                'user_id' => \App\Models\User::all()->random()->id,
                'name' => fake()->name(),
                'place' => fake()->city(),
                'start_date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
                'due_date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
                'total_value' => fake()->randomFloat(2, 5, 150),
                'status' => true
            ]);
        }

        // Crear actividades aleatorias
        foreach (range(1, 50) as $index) {
            \App\Models\Activity::create([
                'name' => fake()->words($nb = 2, $asText = true),
                'description' => fake()->sentence(10),
                'status' => true

            ]);
        }

        // Crear tipos de trámites aleatorios
        foreach (range(1, 10) as $index) {
            \App\Models\TypeProcess::create([
                'name' => fake()->name(),
                'description' => fake()->sentence(10),
                'status' => true
            ]);
        }

        // Crear tipos de docs aleatorios
        foreach (range(1, 10) as $index) {
            \App\Models\TypeDocs::create([
                'name' => fake()->name(),
                'description' => fake()->sentence(10),
                'type_process_id' => \App\Models\TypeProcess::all()->random()->id,
                'status' => true
            ]);
        }

        // Crear trámites aleatorios
        foreach (range(1, 50) as $index) {
            \App\Models\Process::create([
                'project_id' => \App\Models\Project::all()->random()->id,
                'type_process_id' => \App\Models\TypeProcess::all()->random()->id,
                'vsm' => 'vsm',
                'next_review' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
                'status' => true
            ]);
        }

        // Crear asignaciones aleatorias
        foreach (range(1, 50) as $index) {
            \App\Models\Assignment::create([
                'process_id' => \App\Models\Process::all()->random()->id,
                'activity_id' => \App\Models\Activity::all()->random()->id,
                'user_id' => \App\Models\User::all()->random()->id,
                'status' => true
            ]);
        }

        // Crear seguimientos aleatorios
        foreach (range(1, 50) as $index) {
            \App\Models\Tracking::create([
                'assignment_id' => \App\Models\Assignment::all()->random()->id,
                'user_id' => \App\Models\User::all()->random()->id,
                'date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
                'observation' => fake()->sentence(10),
                'status' => true
            ]);
        }

        // Crear documentos de trámites aleatorios
        foreach (range(1, 50) as $index) {
            \App\Models\ProcessDocs::create([
                'process_id' => \App\Models\Process::all()->random()->id,
                'type_docs_id' => \App\Models\TypeDocs::all()->random()->id,
                'name' => fake()->name(),
                'value' => fake()->randomFloat(2, 5, 150),
                'url' => fake()->imageUrl(250, 250),
                'status' => true
            ]);
        }
    }
}

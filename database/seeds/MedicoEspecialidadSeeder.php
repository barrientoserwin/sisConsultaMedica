<?php

use Illuminate\Database\Seeder;
use App\MedicoEspecialidad;

class MedicoEspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Albina #2 /Medicina General/Oftalmologia/Pediatria
        MedicoEspecialidad::create([
        'idMedico' => 2,
        'idEspecialidad' => 7,
        ]);

        MedicoEspecialidad::create([
        'idMedico' => 2,
        'idEspecialidad' => 1,
        ]);

        MedicoEspecialidad::create([
        'idMedico' => 2,
        'idEspecialidad' => 2,
        ]);

        // Ana Karen #3 /Medicina General/Ginecología/Psiquiatría
        MedicoEspecialidad::create([
        'idMedico' => 3,
        'idEspecialidad' => 7,
        ]);

        MedicoEspecialidad::create([
        'idMedico' => 3,
        'idEspecialidad' => 5,
        ]);

        MedicoEspecialidad::create([
        'idMedico' => 3,
        'idEspecialidad' => 3,
        ]);

        // Susana #4 /Hematología/Cirugía cardíaca
        MedicoEspecialidad::create([
        'idMedico' => 4,
        'idEspecialidad' => 6,
        ]);

        MedicoEspecialidad::create([
        'idMedico' => 4,
        'idEspecialidad' => 4,
        ]);
    }
}

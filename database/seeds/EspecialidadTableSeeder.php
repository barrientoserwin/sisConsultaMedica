<?php

use Illuminate\Database\Seeder;
use App\Especialidad;

class EspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1        
        Especialidad::create([
          'nombre' => 'Oftalmologia',
          'descripcion' => 'Parte de la medicina que estudia el ojo y se ocupa de sus enfermedades.',
        ]);

        // 2    
        Especialidad::create([
          'nombre' => 'Pediatría',
          'descripcion' => 'estudia al niño y sus enfermedades',
        ]);

        // 3        
        Especialidad::create([
          'nombre' => 'Neurología',
          'descripcion' => 'se ocupa de la anatomía, la fisiología y las enfermedades del sistema nervioso.',
        ]);

        // 4        
        Especialidad::create([
          'nombre' => 'Psiquiatría',
          'descripcion' => 'se dedicada al estudio de los trastornos mentales de origen genético o neurológico',
        ]);

        // 5        
        Especialidad::create([
          'nombre' => 'Cirugía cardíaca',
          'descripcion' => 'se ocupa del corazón o grandes vasos, realizada por un cirujano cardíaco',
        ]);

        // 6        
        Especialidad::create([
          'nombre' => 'Ginecología',
          'descripcion' => 'estudia el sistema reproductor femenino (útero, vagina y ovarios)',
        ]);

        // 7        
        Especialidad::create([
          'nombre' => 'Urología',
          'descripcion' => 'diagnóstica las patologías que afectan al aparato urinario, glándulas suprarrenales y retroperitoneo',
        ]);

        // 8        
        Especialidad::create([
          'nombre' => 'Hematología',
          'descripcion' => 'se dedica al tratamiento de los pacientes con enfermedades de la sangre o hematológicas',
        ]);

        // 9      
        Especialidad::create([
          'nombre' => 'Medicina General',
          'descripcion' => 'Estudia las funciones vitales de la persona humana',
        ]);
        
    }
}

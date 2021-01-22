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
        $especialidad = [
    		'Oftalmología',
    		'Pediatría',
    		'Neurología'
        ];
        
    	foreach ($especialidad as $specialtyName) {
    		$specialty = Especialidad::create([
	        	'nombre' => $specialtyName
            ]);
    	}
    }
}

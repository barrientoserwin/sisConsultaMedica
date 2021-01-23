<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1        
        User::create([
            'name' => 'Erwin',
	        'email' => 'barrientoserwin381@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Barrientos Mamani',
            'dni' => '8205954',
            'fechaNac' => '1997/12/20',
            'telefono' => '78490474',
            'direccion' => 'Barrio urkupiña',
            'rolUsuario' => 'administrador',
        ]);

        // 2
        User::create([
    		'name' => 'Aylin',
	        'email' => 'mendoza381@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Mendoza Villca',
            'dni' => '8205922',
            'fechaNac' => '1995/08/01',
            'telefono' => '73119361',
            'direccion' => 'B/ Urkupiña C/Audifas Parada',
            'rolUsuario' => 'paciente',
    	]);

        // 3
        User::create([
    		'name' => 'Albina',
	        'email' => 'barrientosalbina189@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Barrientos Mamani',
            'dni' => '8109999',
            'fechaNac' => '1995/09/18',
            'telefono' => '76345809',
            'direccion' => 'B/ Virgen de Cotoca C/Audifas Parada',
            'rolUsuario' => 'doctor',
    	]);
    }
}

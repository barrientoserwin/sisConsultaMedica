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
        
        // 3
        User::create([
    		'name' => 'Ana Karen',
	        'email' => 'pacokaren190@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Paco Colque',
            'dni' => '8109299',
            'fechaNac' => '1999/05/11',
            'telefono' => '67778312',
            'direccion' => 'B/ Villa Verde Av/Fabril',
            'rolUsuario' => 'doctor',
        ]);
        
        // 4
        User::create([
    		'name' => 'Susana',
	        'email' => 'alvaradoguzman191@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Alavarado Guzman',
            'dni' => '8109399',
            'fechaNac' => '1994/09/05',
            'telefono' => '77372062',
            'direccion' => 'B/ Villa Cochabamba',
            'rolUsuario' => 'doctor',
    	]);

        // 5
        User::create([
    		'name' => 'Aylin',
	        'email' => 'mendozavillca381@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Mendoza Villca',
            'dni' => '8205922',
            'fechaNac' => '1995/08/01',
            'telefono' => '73119361',
            'direccion' => 'B/ Urkupiña C/Audifas Parada',
            'rolUsuario' => 'paciente',
        ]);
        
        // 6
        User::create([
    		'name' => 'Vianca',
	        'email' => 'riverotito382@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Tito Rivero',
            'dni' => '8204522',
            'fechaNac' => '1997/07/07',
            'telefono' => '75657607',
            'direccion' => 'B/Urkupiña',
            'rolUsuario' => 'paciente',
        ]);
        
        // 7
        User::create([
    		'name' => 'Melina',
	        'email' => 'villalbagaz383@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Gazon Villalba',
            'dni' => '8774522',
            'fechaNac' => '1992/07/27',
            'telefono' => '75633307',
            'direccion' => 'B/Primavera',
            'rolUsuario' => 'paciente',
    	]);
    }
}

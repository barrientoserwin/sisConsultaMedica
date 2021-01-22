<?php

use Illuminate\Database\Seeder;
use App\User;
use DB;

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
        DB::table('users')->insert([
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
        DB::table('users')->insert([
    		'name' => 'Mikasa',
	        'email' => 'mikasacj381@gmail.com',
	        'password' => bcrypt('123456789'),
            'apellidos' => 'Barrientos',
            'dni' => '8205957',
            'fechaNac' => '2015/12/20',
            'telefono' => '73119361',
            'direccion' => 'B/ Urkupiña C/Audifas Parada',
            'rolUsuario' => 'paciente',
    	]);

        // 3
        DB::table('users')->insert([
    		'name' => 'Albina',
	        'email' => 'barrientosalbina189@gmail.com',
	        'password' => bcrypt('987654321'),
            'apellidos' => 'Barrientos Mamani',
            'dni' => '8109999',
            'fechaNac' => '1995/09/18',
            'telefono' => '76345809',
            'direccion' => 'B/ Virgen de Cotoca C/Audifas Parada',
            'rolUsuario' => 'doctor',
    	]);
    }
}

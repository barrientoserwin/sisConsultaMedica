<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
    //Rutas de Especialidad
    Route::get('/especialidad', 'EspecialidadController@index');
    Route::get('/especialidad/create', 'EspecialidadController@create');
    Route::get('/especialidad/edit/{id}', 'EspecialidadController@edit');
    Route::post('/especialidad/store', 'EspecialidadController@store');
    Route::put('/especialidad/update/{id}', 'EspecialidadController@update');
    Route::delete('/especialidad/delete/{id}', 'EspecialidadController@destroy');

    //Rutas Medico
    Route::get('/medico', 'MedicoController@index');
    Route::get('/medico/create', 'MedicoController@create');
    Route::get('/medico/edit/{id}', 'MedicoController@edit');
    Route::post('/medico/store', 'MedicoController@store');
    Route::put('/medico/update/{id}', 'MedicoController@update');
    Route::delete('/medico/delete/{id}', 'MedicoController@destroy');

    //Rutas Paciente
    Route::get('/paciente', 'PacienteController@index');
    Route::get('/paciente/create', 'PacienteController@create');
    Route::get('/paciente/edit/{id}', 'PacienteController@edit');
    Route::post('/paciente/store', 'PacienteController@store');
    Route::put('/paciente/update/{id}', 'PacienteController@update');
    Route::delete('/paciente/delete/{id}', 'PacienteController@destroy');

    // Charts
	Route::get('/charts/consultamedica/line', 'ChartController@consultamedica');
	Route::get('/charts/medico/column', 'ChartController@medicos');
	Route::get('/charts/medico/column/data', 'ChartController@medicoJson');
});

Route::middleware(['auth', 'medico'])->namespace('Medico')->group(function () {
    //Rutas de DiasTrabajo
    Route::get('/diastrabajo', 'DiasTrabajoController@edit'); 
    Route::post('/diastrabajo/store', 'DiasTrabajoController@store'); 
});

Route::middleware('auth')->group(function () {
    Route::get('/consultamedica/create', 'ConsultaMedicaController@create');
    Route::post('/consultamedica/store', 'ConsultaMedicaController@store');
    Route::get('/consultamedica', 'ConsultaMedicaController@index');

    Route::post('/consultamedica/cancelar/{id}', 'ConsultaMedicaController@cancelarReservada');

    Route::get('/consultamedica/cancelarConfir/{id}', 'ConsultaMedicaController@cancelarConfir');
    Route::post('/consultamedica/cancelarConfirmada/{id}', 'ConsultaMedicaController@cancelarConfirmada');

    Route::get('/consultamedica/verConsulta/{id}', 'ConsultaMedicaController@verConsulta');	
    Route::post('/consultamedica/confirmar/{id}', 'ConsultaMedicaController@confirmarConsulta');

    //JSON
    Route::get('/especialidad/medico/{id}', 'Api\EspecialidadController@medicos');
    Route::get('/diastrabajo/hours', 'Api\DiasTrabajoController@hours');
});
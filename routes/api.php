<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

    // Public resources
    Route::get('/especialidad', 'EspecialidadController@index');
    
    //JSON
    Route::get('/especialidad/medico/{id}', 'EspecialidadController@medicos');
    Route::get('/diastrabajo/hours', 'DiasTrabajoController@hours');

Route::middleware('auth:api')->group(function () {
	Route::get('/user', 'UserController@show');
	Route::get('/listar/paciente', 'UserController@buscarPaciente');
    Route::get('/listar/medico', 'UserController@buscarMedico');
	Route::post('/logout', 'AuthController@logout');

	// Consulta Medica
	Route::get('/consultamedica', 'ConsultaMedicaController@index');
	Route::post('/consultamedica/store', 'ConsultaMedicaController@store');
    Route::get('/consultamedica/listar/hrc', 'ConsultaMedicaController@consultaMedicaHRC');
    Route::post('/consultamedica/confirmar/reserva/{id}', 'ConsultaMedicaController@confirmarReserva');
    Route::post('/consultamedica/cancelar/reserva/{id}', 'ConsultaMedicaController@cancelarReserva');
    Route::post('/consultamedica/atendida/{id}', 'ConsultaMedicaController@confirmarAtendida');
    Route::post('/consultamedica/cancelar/confirmada/{id}', 'ConsultaMedicaController@cancelarConfirmada');

    //Especialidad
    Route::post('/especialidad/guardar', 'EspecialidadController@guardar');
});
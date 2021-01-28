<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultamedicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultamedica', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->date('fechaReserva');
            $table->date('fechaConsulta');
            $table->time('horaConsulta');
            $table->string('estado',40);
            $table->string('tipoConsulta',50);
            $table->foreignId('idMedico');
            $table->foreignId('idPaciente');
            $table->foreignId('idEspecialidad');
            $table->foreign('idMedico')->references('id')->on('users');            
            $table->foreign('idPaciente')->references('id')->on('users');            
            $table->foreign('idEspecialidad')->references('id')->on('especialidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultamedica');
    }
}

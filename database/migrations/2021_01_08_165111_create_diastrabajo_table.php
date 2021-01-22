<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiastrabajoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diastrabajo', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('codDia');
            $table->boolean('estado');            
            $table->time('turno1Inicio');
            $table->time('turno1Fin');
            $table->time('turno2Inicio');
            $table->time('turno2Fin');
            $table->foreignId('idMedico');
            $table->foreign('idMedico')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diastrabajo');
    }
}

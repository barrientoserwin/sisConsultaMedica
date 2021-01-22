<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelarconsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelarconsulta', function (Blueprint $table) {
            $table->id();           
            $table->date('fechaCancelada');
            $table->string('justificacion');
            $table->foreignId('idConsultaMedica');
            $table->foreignId('idAbrogador');
            $table->foreign('idConsultaMedica')->references('id')->on('consultamedica');            
            $table->foreign('idAbrogador')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancelarconsulta');
    }
}

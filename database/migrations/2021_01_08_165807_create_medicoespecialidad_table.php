<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoespecialidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicoespecialidad', function (Blueprint $table) {
            $table->foreignId('idMedico');
            $table->foreignId('idEspecialidad');
            $table->primary(['idMedico', 'idEspecialidad']);
            $table->foreign('idMedico')->references('id')->on('users');            
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
        Schema::dropIfExists('medicoespecialidad');
    }
}

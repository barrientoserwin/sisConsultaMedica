<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicoEspecialidad extends Model
{
    protected $table = 'medicoespecialidad';
    protected $fillable = [
        'idMedico',
        'idEspecialidad'
    ];    
    public $timestamps = false;
}

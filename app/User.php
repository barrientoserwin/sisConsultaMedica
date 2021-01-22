<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'apellidos', 'dni', 'fechaNac','telefono', 'direccion', 'rolUsuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function asDoctorAppointments(){
        return $this->hasMany(ConsultaMedica::class, 'idMedico');
    }

    public function attendedAppointments(){
        return $this->asDoctorAppointments()->where('estado', 'Atendida');
    }

    public function cancelledAppointments(){
        return $this->asDoctorAppointments()->where('estado', 'Cancelada');
    }
    
    public function asPatientAppointments(){
        return $this->hasMany(ConsultaMedica::class, 'idPaciente');
    }
}

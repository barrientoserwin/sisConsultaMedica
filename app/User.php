<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements JWTSubject
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
        'email_verified_at', 'created_at', 'updated_at'
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
    ];

    public static function createPaciente(array $data){
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'apellidos' => $data['apellidos'],
            'dni' => $data['dni'],
            'fechaNac' => $data['fechaNac'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'rolUsuario' => 'paciente',
        ]);
    }

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

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
}

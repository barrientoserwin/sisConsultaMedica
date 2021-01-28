<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;
use App\User;

trait ValidateAndCreatePaciente
{
    protected function validator(array $data){
        return Validator::make($data, User::$rules);
    }

    protected function create(array $data){
        return User::createPaciente($data);
    }
}

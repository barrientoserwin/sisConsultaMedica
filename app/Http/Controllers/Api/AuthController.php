<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use JWTAuth;
use App\User;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request){
    	$credentials = $request->only('email', 'password');        
        if ( $token = auth('api')->attempt($credentials)) {
            $user = auth()->user();
            $jwt = auth()->login($user);
		    $success = true;
		    
		    return compact('success', 'user', 'jwt');
		} else {
			$success = false;
			$message = 'Credenciales Incorrectas';
			return compact('success', 'message');
        }
    }

    public function logout(){
        //JWTAuth::invalidate();
    	auth('api')->logout();
    	$success = true;
    	return compact('success');
    }

    public function register(Request $request){
    	$this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        Auth::guard('api')->login($user);

        $jwt = JwtAuth::generateToken($user);
	    $success = true;
	    
	    return compact('success', 'user', 'jwt');
    }
}

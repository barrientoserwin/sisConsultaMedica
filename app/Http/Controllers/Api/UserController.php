<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;

class UserController extends Controller
{
    public function show(){
    	return auth()->user();
    }

    public function update(Request $request){
    	$user = Auth::guard('api')->user();
    	$user->name = $request->name; // $request->input('name')
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	$user->save();

    	JwtAuth::clearCache($user);
    }
}

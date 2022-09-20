<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request) {
    	//validacion de datos de usuario
    	$request->validate([
			'name'        => 'required',
			'last_name'   => 'required',
			'email'       => 'required|email|unique:users',
			'password'    => ['required',
							  'regex:/[a-z]/',
							  'regex:/[A-Z]/',
							  'regex:/[0-9]/',
							  'regex:/[@$!%*#?&.]/',
						      'confirmed',],
			'rol'         => ['nullable',
							  'integer', 
							  'regex:/[0-4]/',],
			'countrie_id' => 'nullable|integer',
			'prefix_id'   => 'nullable|integer',
			'type_dni'    => 'integer',
			'dni'         => 'nullable|string',
			'phone'       => ['nullable', 
							  'string', 
							  'regex:/[0-9]/',],
			'direction'   => 'nullable|string',
    	]);

    	//almacenando datos
    	$user = new User([
			'name'        => $request->name,
			'last_name'   => $request->last_name,
			'email'       => $request->email,
			'password'    => Hash::make($request->password),
			'rol'         => $request->rol,
			'countrie_id' => $request->countrie_id,
			'prefix_id'   => $request->prefix_id,
			'type_dni'    => $request->type_dni,
			'dni'         => $request->dni,
			'phone'       => $request->phone,
			'direction'   => $request->direction,
    	]);

    	$user->save();

    	return response()->json('User created succesfully', 201);
    }

    public function login(Request $request) {
    	$request->validate([
			'email'    => 'required|email',
			'password' => 'required',
    	]);

    	//obteniendo correo y contraseña
    	$credentials = $request->only('email', 'password');

    	//verificando si existen los datos para generar token
    	if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json([
            	'Error' => 'Unauthorized'
            ], 401);
        }

        //obteniendo info del usuario
        $user = auth()->user();

        return response()->json(compact('token', 'user'));
    }

    public function logout() {
    	//invalidando token
    	auth()->logout();

    	return response()->json([
    		'Msg' => 'Logout complete succesfully'
    	]);
    }
}

<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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

    public function showAllUsers() {
    	//traer todos los usuarios
    	$users = User::with('Roles')->get();

        return response()->json($users, 200);
    }

    public function showUser($id) {
    	//buscaqueda de un usuario especifico
    	$user = User::with('Roles')->find($id);

    	return response()->json($user, 200);
    }

    public function registerNewUser(Request $request) {
    	//consultando info de usuario logueado
		$user = auth()->user();

		//verificando que sea Admin o Vendedor
		if ($user->rol == 1){
			//validando datos de nuevo usuario
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
				'rol'         => ['required',
								  'integer', 
								  'regex:/[1-5]/',],
	 		]);
	 		//guardando datos de nuevo usuario
	 		$newUser = new User([
		 		'name'        => $request->name,
				'last_name'   => $request->last_name,
				'email'       => $request->email,
				'password'    => Hash::make($request->password),
				'rol'         => $request->rol,
	 		]);

 			$newUser->save();

 			return response()->json('User created succesfully', 201);
 		}

 		if($user->rol == 4) {
 			//validando datos de nuevo usuario
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
	 		]);
	 		//guardando datos de nuevo usuario
	 		$newUser = new User([
		 		'name'        => $request->name,
				'last_name'   => $request->last_name,
				'email'       => $request->email,
				'password'    => Hash::make($request->password),
				'rol'         => 5,
	 		]);

 			$newUser->save();

 			return response()->json('User created succesfully', 201);
 		}

		else {
			return response()->json('Unauthorized User', 401);
		}		
    }

    public function editUser(Request $request, $id) {
    	//consultando info de usuario logueado
    	$user = auth()->user();

    	//verificando que sea Admin o Vendedor
    	if ($user->rol == 1){
			//validando datos de actualizacion
	 		$request->validate([
	 			'name'        => 'string',
				'last_name'   => 'string',
				'email'       => 'email',
				'rol'         => ['integer', 
								  'regex:/[1-5]/',],
	 		]);
	 		//guardando datos actualizados
	 		$updateUser = User::find($id);

	 		//logica para datos vacios
	 		$request->name == null || $request->name == ""
	 			? $updateUser->name = $updateUser->name
	 			: $updateUser->name = $request->name;
	 		$request->last_name == null || $request->last_name == ""
	 			? $updateUser->last_name = $updateUser->last_name
	 			: $updateUser->last_name = $request->last_name;
	 		$request->email == null || $request->email == ""
	 			? $updateUser->email = $updateUser->email
	 			: $updateUser->email = $request->email;
	 		$request->rol == null || $request->rol == ""
	 			? $updateUser->rol = $updateUser->rol
	 			: $updateUser->rol = $request->rol;
			
 			$updateUser->update();

 			return response()->json('User updated succesfully', 201);
 		}

 		if($user->rol == 4) {
 			//validando datos de nuevo usuario
	 		$request->validate([
	 			'name'        => 'string',
				'last_name'   => 'string',
				'email'       => 'email',
	 		]);
	 		//guardando datos actualizados
	 		$updateUser = User::find($id);

	 		//logica para datos vacios
	 		$request->name == null || $request->name == ""
	 			? $updateUser->name = $updateUser->name
	 			: $updateUser->name = $request->name;
	 		$request->last_name == null || $request->last_name == ""
	 			? $updateUser->last_name = $updateUser->last_name
	 			: $updateUser->name = $request->name;
	 		$request->email == null || $request->email == ""
	 			? $updateUser->email = $updateUser->email
	 			: $updateUser->email = $request->email;
			
 			$updateUser->update();

 			return response()->json('User updated succesfully', 201);
 		}

		else {
			return response()->json('Unauthorized User', 401);
		}
    }

    public function logout() {
    	//invalidando token
    	auth()->logout();

    	return response()->json([
    		'Msg' => 'Logout complete succesfully'
    	], 200);
    }
}

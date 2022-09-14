<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Mail\CodeResetPassword as SendCodeResetPassword;

class PasswordResetController extends Controller
{
    public function forgotPassword(Request $request) {
    	//validar email que se ingresa
    	$data = $request->validate([
    		'email' => 'required|email|exists:users',
    	]);

    	//eliminar algun token que haya
    	PasswordReset::where('email', $request->email)->delete();

    	//generando token de 5 digitos
    	$data['token'] = mt_rand(10000, 99999);

    	//guardando token en bd
    	$tokenData = PasswordReset::create($data);

    	//enviando email
    	Mail::to($request->email)->send(
    		new SendCodeResetPassword($tokenData->token));

    	return response()->json([
    		'Msg' => 'Email has been sent with your reset code',
    	], 200);
    }

    public function codeCheck(Request $request) {
    	//validar token
    	$request->validate([
    		'token' => 'required|string|exists:password_resets'
    	]);

    	//buscar token
    	$pwReset = PasswordReset::firstWhere('token', $request->token);

    	//dar una hora al token
    	if(Carbon::parse($pwReset->created_at)->addHour()->isPast()){
    		//token vencido
    		$pwReset->delete();

    		return response()->json([
    			'Msg' => 'Token is expired',
    		], 422);
    	}

    	return response()->json([
    		'token' => $pwReset->token,
    		'Msg' => 'Token is valid',
    	], 200);
    }

    public function resetPassword(Request $request) {
    	//validar token y contraseña
    	$request->validate([
    		'token' => 'required|string|exists:password_resets',
    		'password' => ['required', 
                           'string',
                           'regex:/([a-z])/', 
                           'regex:/[A-Z]/', 
                           'regex:/[0-9]/', 
                           'regex:/[@$!%*#?&.]/', 
                           'confirmed',]
    	]);

    	//buscar token
    	$pwReset = PasswordReset::firstWhere('token', $request->token);
    	
    	//verificar que no este vencido
    	if($pwReset->created_at > now()->addHour()) {
    		//token vencido
    		$pwReset->delete();

    		return response()->json([
    			'Msg' => 'Token expired',
    		], 422);
    	}

    	//hallar email
    	$user = User::firstWhere('email', $pwReset->email);

    	//cambiar contraseña
    	$user->password = Hash::make($request->password);
    	$user->update();

    	//eliminar el token reciente
    	$pwReset->delete();

    	return response()->json([
    		'Msg' => 'Password has been change successfully',
    	], 200);
    }
}

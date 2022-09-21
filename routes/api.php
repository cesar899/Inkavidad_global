<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//rutas sin token

//login
Route::post('login', [UserController::class, 'login']);

//rutas de restablecimineto de contraseña
Route::controller(PasswordResetController::class)->group(
	function($router) {
		Route::post('password/email', 'forgotPassword');
		Route::post('password/code/check', 'codeCheck');
		Route::post('password/reset', 'resetPassword');
});

//rutas con token
Route::group([
 	'middleware' => ['jwt.verify'],
], function ($router) {

	Route::controller(UserController::class)->group(
		function($router) {
			Route::post('/logout', 'logout');
			Route::post('/register/new/user', 'registerNewUser');
			Route::put('/edit/user/{id}', 'editUser');
			Route::get('/users', 'showAllUsers');
			Route::get('/user/{id}', 'showUser');
	});
});
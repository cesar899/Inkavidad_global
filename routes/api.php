<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

//rutas que no necesitan token
Route::controller(UserController::class)->group(
	function($router) {
		Route::post('register', 'register');
		Route::post('login', 'login');
});

//rutas que si necesitan token
Route::group([
 	'middleware' => ['jwt.verify'],
], function ($router) {
	Route::post('/logout', [UserController::class, 'logout']);
});
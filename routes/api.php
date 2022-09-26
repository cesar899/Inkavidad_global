<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GroupController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects/availables', [ProjectController::class, 'availableProjects']);
Route::get('/projects/{project_id}/groups/batchs', [GroupController::class, 'groupBatchsByProject']);
Route::get('/projects/{project_id}/groups/onsale', [GroupController::class, 'groupsByProjectForSale']);
Route::get('/projects/{project_id}/groups/', [GroupController::class, 'projectGroups']);
Route::put('/projects/{project_id}/groups/', [GroupController::class, 'updateProjectGroups']);
Route::get('/groups/{group_id}/batchs/', [BatchController::class, 'groupBatchs']);
Route::resource('batchs', BatchController::class);
Route::resource('projects', ProjectController::class);
Route::resource('groups', GroupController::class);


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
Route::middleware('auth:sanctum')->get('tasks', [TaskController::class, 'api_getTasks']);
Route::middleware('auth:sanctum')->put('/tasks/{task}', [TaskController::class, 'api_update']);
Route::middleware('auth:sanctum')->delete('/tasks/{taskId}', [TaskController::class, 'api_destroy']);
Route::middleware('auth:sanctum')->post('tasks', [TaskController::class, 'api_create']);
Route::middleware('auth:sanctum')->get('/tasks/{task}', [TaskController::class, 'api_getTask']);

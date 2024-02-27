<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [TodoController::class, 'home']);

Route::post('/todos', [TodoController::class, 'create']);

Route::get('/todos', [TodoController::class, 'index']);

Route::put('/todos/{id}', [TodoController::class, 'update']);

Route::delete('/todos/{id}', [TodoController::class, 'delete']);

// Route::post('/users', [UserController::class, 'create']);
// Route::post('/users/login', [UserController::class, 'login']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);

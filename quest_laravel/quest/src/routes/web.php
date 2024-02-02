<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


Route::get('/todos', [TodoController::class, 'index']);

Route::get('/', [TodoController::class, 'index']);

Route::get('/create-page', [TodoController::class, 'createPage']);
Route::post('/create', [TodoController::class, 'create']);

Route::get('/edit-page/{id}', [TodoController::class, 'editPage']);
Route::post('/edit', [TodoController::class, 'edit']);

Route::delete('/delete/{id}', [TodoController::class, 'delete']);

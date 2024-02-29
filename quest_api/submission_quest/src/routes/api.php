<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Models\Article;

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

Route::post('/users', [UsersController::class, 'create']);

Route::post('/users/login', [AuthController::class, 'login'])->name('login');

Route::get('/articles/{article:slug}', function (Article $article) {
    return [
        'article' => [
            'title' => $article->title,
            'slug' => $article->slug,
            'description' => $article->description,
            'body' => $article->body,
            'createdAt' => $article->created_at,
            'updatedAt' => $article->updated_at,
        ]
    ];
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/articles', [ArticleController::class, 'create'])->name('create');
    Route::put('/articles/{article:slug}', [ArticleController::class, 'update']);
    Route::delete('/articles/{article:slug}', [ArticleController::class, 'delete']);
});

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/users', [UsersController::class, 'create']);

Route::post('/users/login', [AuthController::class, 'login'])->name('login');

Route::get('/articles/{article:slug}', [ArticleController::class, 'get'])->name('getArticle');
Route::get('/articles', [ArticleController::class, 'articles'])->name('articles');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/articles', [ArticleController::class, 'create'])->name('create');
    Route::put('/articles/{article:slug}', [ArticleController::class, 'update'])->name('update');
    Route::delete('/articles/{article:slug}', [ArticleController::class, 'delete'])->name('delete');
    Route::post('/articles/{article:slug}/favorite', [ArticleController::class, 'favorite'])->name('favorite');
    Route::delete('/articles/{article:slug}/favorite', [ArticleController::class, 'unfavorite'])->name('unfavorite');
});

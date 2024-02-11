<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
// use App\Http\Controllers\AuthenticationController;

Route::get('/', [ArticleController::class, 'index']);

//記事の投稿
Route::get('/create-edit-article', [ArticleController::class, 'createEditArticle']);
Route::post('/create-article', [ArticleController::class, 'createArticle']);

//記事の編集
Route::get('/edit-article/{id}', [ArticleController::class, 'editArticle']);
Route::post('/edit', [ArticleController::class, 'edit']);

//記事詳細の表示
Route::get('/article/{id}', [ArticleController::class, 'article']);

//記事の削除
Route::delete('/delete/{id}', [ArticleController::class, 'delete']);

// コメントの追加
Route::post('/articles/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

// // ログインページ
// Route::get('/login', [AuthenticationController::class, 'login']);

// // アカウント作成ページ(Register)
// Route::get('/register', [AuthenticationController::class, 'register']);
// Route::post('/register', [RegisterController::class, 'store']);

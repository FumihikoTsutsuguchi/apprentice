<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


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

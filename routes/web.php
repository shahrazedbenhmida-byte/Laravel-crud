<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;

Route::get('/articles', [ArticleController::class, 'index']);
Route::post('/articles/add', [ArticleController::class, 'store']);
Route::delete('/articles/delete', [ArticleController::class, 'destroy']);
Route::post('/articles/update', [ArticleController::class, 'update']);

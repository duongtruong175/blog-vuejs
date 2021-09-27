<?php

use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Contain routes of user interface
|
*/

// Auth
require __DIR__ . '/auth.php';

// Article
Route::prefix('api/v1/articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])
        ->name('articles.index');
    Route::get('/{id}', [ArticleController::class, 'show'])
        ->name('articles.show');
});

Route::group(['middleware' => 'auth'], function () {
    // Comment
    Route::post('api/v1/comments', [CommentController::class, 'store'])
        ->name('comment.store');
});

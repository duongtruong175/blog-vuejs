<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Contain routes of user interface
|
*/

// Authentication
require __DIR__ . '/auth.php';

// router to vuejs
Route::get('/', function () {
    return view('app');
});
Route::get('/about', function () {
    return view('app');
});
Route::get('/articles/{slug?}', function () {
    return view('app');
})->where('slug', '^.*$');

// router api
// Article
Route::prefix('api/v1/articles')->group(function () {
    Route::get('/', 'Frontend\ArticleController@index')
        ->name('articles.index');
    Route::get('/{id}', 'Frontend\ArticleController@show')
        ->name('articles.show');
});

Route::group(['middleware' => 'auth'], function () {
    // Comment
    Route::post('api/v1/comments', 'Frontend\CommentController@store')
        ->name('comment.store');
});

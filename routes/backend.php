<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Contain routes of admin interface
|
*/

// Authentication
Route::get('/admin/login', 'Backend\BackendAuthenticationController@index')
    ->name('backend_auth.index');
Route::post('/admin/login', 'Backend\BackendAuthenticationController@login')
    ->name('backend_auth.login');

// router to vuejs
Route::get('/admin/{slug?}', function () {
    return view('app');
})->middleware('admin')->where('slug', '^.*$');

// router api
Route::group(['middleware' => 'admin', 'prefix' => 'api/v1/admin'], function () {
    // Logout
    Route::post('/logout', 'Backend\BackendAuthenticationController@logout')
        ->name('backend_auth.logout');

    // Dashboard
    Route::get('/dashboard', 'Backend\BackendDashboardController@index')
        ->name('backend_dashboard.index');

    // User
    Route::prefix('users')->group(function () {
        Route::get('/', 'Backend\BackendUserController@index')
            ->name('backend_user.index');
        Route::get('/create', 'Backend\BackendUserController@create')
            ->name('backend_user.create');
        Route::post('/', 'Backend\BackendUserController@store')
            ->name('backend_user.store');
        Route::get('/{id}/edit', 'Backend\BackendUserController@edit')
            ->name('backend_user.edit');
        Route::put('/{id}', 'Backend\BackendUserController@update')
            ->name('backend_user.update');
        Route::delete('/{id}', 'Backend\BackendUserController@destroy')
            ->name('backend_user.destroy');
    });

    // Role
    Route::prefix('roles')->group(function () {
        Route::get('/', 'Backend\BackendRoleController@index')
            ->name('backend_role.index');
        Route::post('/', 'Backend\BackendRoleController@store')
            ->name('backend_role.store');
        Route::get('/{id}/edit', 'Backend\BackendRoleController@edit')
            ->name('backend_role.edit');
        Route::put('/{id}', 'Backend\BackendRoleController@update')
            ->name('backend_role.update');
        Route::delete('/{id}', 'Backend\BackendRoleController@destroy')
            ->name('backend_role.destroy');
    });

    // Article
    Route::prefix('articles')->group(function () {
        Route::get('/', 'Backend\BackendArticleController@index')
            ->name('backend_article.index');
        Route::get('/create', 'Backend\BackendArticleController@create')
            ->name('backend_article.create');
        Route::post('/', 'Backend\BackendArticleController@store')
            ->name('backend_article.store');
        Route::get('/{id}/edit', 'Backend\BackendArticleController@edit')
            ->name('backend_article.edit');
        Route::put('/{id}', 'Backend\BackendArticleController@update')
            ->name('backend_article.update');
        Route::delete('/{id}', 'Backend\BackendArticleController@destroy')
            ->name('backend_article.destroy');
    });

    // Category
    Route::prefix('categories')->group(function () {
        Route::get('/', 'Backend\BackendCategoryController@index')
            ->name('backend_category.index');
        Route::post('/', 'Backend\BackendCategoryController@store')
            ->name('backend_category.store');
        Route::get('/{id}/edit', 'Backend\BackendCategoryController@edit')
            ->name('backend_category.edit');
        Route::put('/{id}', 'Backend\BackendCategoryController@update')
            ->name('backend_category.update');
        Route::delete('/{id}', 'Backend\BackendCategoryController@destroy')
            ->name('backend_category.destroy');
    });

    // Tag
    Route::prefix('tags')->group(function () {
        Route::get('/', 'Backend\BackendTagController@index')
            ->name('backend_tag.index');
        Route::post('/', 'Backend\BackendTagController@store')
            ->name('backend_tag.store');
        Route::get('/{id}/edit', 'Backend\BackendTagController@edit')
            ->name('backend_tag.edit');
        Route::put('/{id}', 'Backend\BackendTagController@update')
            ->name('backend_tag.update');
        Route::delete('/{id}', 'Backend\BackendTagController@destroy')
            ->name('backend_tag.destroy');
    });

    // Comment
    Route::prefix('comments')->group(function () {
        Route::get('/', 'Backend\BackendCommentController@index')
            ->name('backend_comment.index');
        Route::delete('/{id}', 'Backend\BackendCommentController@destroy')
            ->name('backend_comment.destroy');
    });
});

<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', 'Frontend\Auth\RegisteredUserController@create')
    ->middleware('guest')
    ->name('register');

Route::post('/register', 'Frontend\Auth\RegisteredUserController@store')
    ->middleware('guest');

Route::get('/login', 'Frontend\Auth\AuthenticatedSessionController@create')
    ->middleware('guest')
    ->name('login');

Route::post('/login', 'Frontend\Auth\AuthenticatedSessionController@store')
    ->middleware('guest');

Route::get('/forgot-password', 'Frontend\Auth\PasswordResetLinkController@create')
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', 'Frontend\Auth\PasswordResetLinkController@store')
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', 'Frontend\Auth\NewPasswordController@create')
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', 'Frontend\Auth\NewPasswordController@store')
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', 'Frontend\Auth\EmailVerificationPromptController@__invoke')
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', 'Frontend\Auth\VerifyEmailController@__invoke')
    ->middleware('Frontend\Auth\'auth', 'signed', 'throttle:6,1')
    ->name('verification.verify');

Route::post('/email/verification-notification', 'Frontend\Auth\EmailVerificationNotificationController@store')
    ->middleware('Frontend\Auth\'auth', 'throttle:6,1')
    ->name('verification.send');

Route::get('/confirm-password', 'Frontend\Auth\ConfirmablePasswordController@show')
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', 'Frontend\Auth\ConfirmablePasswordController@store')
    ->middleware('auth');

Route::post('/logout', 'Frontend\Auth\AuthenticatedSessionController@destroy')
    ->middleware('auth')
    ->name('logout');

// router api
Route::post('/api/v1/logout', 'Frontend\Auth\AuthenticatedSessionController@logout')
    ->middleware('auth');

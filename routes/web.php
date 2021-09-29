<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| auth.php: authentication route
| frontend.php: user route
| backend.php: admin route
|
*/

use App\Http\Controllers\Frontend\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\LocalizationController;
use Illuminate\Support\Facades\Route;

// Frontend
require __DIR__ . '/frontend.php';

// Backend
require __DIR__ . '/backend.php';

// Route change Language
Route::get('locale/{locale}', [LocalizationController::class, 'changeLocale']);
Route::get('api/v1/locale/{locale}', [LocalizationController::class, 'changeLocaleApi']);
Route::get('api/v1/getUserAuth', [AuthenticatedSessionController::class, 'getUserAuth']);

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

use App\Http\Controllers\Frontend\LocalizationController;
use Illuminate\Support\Facades\Route;

//router to vuejs
Route::get('/', function () {
    return view('app');
});
Route::get('/about', function () {
    return view('app');
});
Route::get('/login', function () {
    return view('app');
});
Route::get('/register', function () {
    return view('app');
});
Route::get('/articles/{slug?}', function () {
    return view('app');
})->where('slug', '^.*$');
Route::get('/admin/{slug?}', function () {
    return view('app');
})->where('slug', '^.*$');

// Route::get('/{slug?}', function () {
//     return view('app');
// })->where('slug', '^.*$');

// Frontend
require __DIR__ . '/frontend.php';

// Backend
require __DIR__ . '/backend.php';

// Route change Language
Route::get('/locale/{locale}', [LocalizationController::class, 'changeLocale'])
    ->name('locale');

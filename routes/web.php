<?php

use App\Http\Controllers\ShortenUrlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top');
});

// route for accessing the shortened URL
Route::get(
    '/{code}',
    [ShortenUrlController::class, 'redirect'],
);

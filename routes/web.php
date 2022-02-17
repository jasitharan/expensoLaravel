<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanel\ViewController;
use App\Http\Controllers\AdminPanel\AdminAuthController;


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

Route::get('/login', [AdminAuthController::class, 'getLogin']);
Route::post('/login', [AdminAuthController::class, 'doLogin']);
Route::post('/logout', [AdminAuthController::class, 'logout']);

Route::group(['middleware' => 'check_admin'], function () {
    Route::get('/{name}', [ViewController::class, 'getDashBoard'])->where('name', '(dashboard)?');


});
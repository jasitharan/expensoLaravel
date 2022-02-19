<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanel\ViewController;
use App\Http\Controllers\AdminPanel\CreateController;
use App\Http\Controllers\AdminPanel\EditController;
use App\Http\Controllers\AdminPanel\DeleteController;
use App\Http\Controllers\AdminPanel\AdminAuthController;
use App\Http\Controllers\AdminPanel\SettingsController;


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


    // Get Requests

     //Users
     Route::get('/users', [ViewController::class, 'getUserList']);
     Route::get('/users/create', [ViewController::class, 'getCreateUser']);
     Route::get('/users/{id}/edit', [ViewController::class, 'getEditUser']);

    //Expenses
    Route::get('/expenses', [ViewController::class, 'getNewsList']);
    Route::get('/expenses/create', [ViewController::class, 'getCreateNews']);
    Route::get('/expenses/{id}/edit', [ViewController::class, 'getEditNews']);

    //Expense types
    Route::get('/expense_types', [ViewController::class, 'getExpenseTypeList']);
    Route::get('/expense_types/create', [ViewController::class, 'getCreateCategory']);
    Route::get('/expense_types/{name}/edit', [ViewController::class, 'getEditCategory']);

    //Settings
    Route::get('/settings/notification', [SettingsController::class, 'getNotificationSetting']);
    Route::get('/settings/global', [SettingsController::class, 'getGlobalSetting']);
    Route::get('/settings/mail', [SettingsController::class, 'getMailSetting']);



    //User
    Route::post('/users', [CreateController::class, 'createUser']);
    Route::put('/users/{id}', [EditController::class, 'editUser']);
    Route::delete('/users/{id}', [DeleteController::class, 'deleteUser']);
});
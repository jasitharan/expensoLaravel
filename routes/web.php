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

Route::group(['middleware' => 'check_admin_financialManager'], function () {
    Route::get('/{name}', [ViewController::class, 'getDashBoard'])->where('name', '(dashboard)?');


    // Get Requests

     //Users
     Route::get('/users', [ViewController::class, 'getUserList'])->middleware('check_admin');
     Route::get('/users/create', [ViewController::class, 'getCreateUser'])->middleware('check_admin');
     Route::get('/users/{id}/edit', [ViewController::class, 'getEditUser'])->middleware('check_admin');

    //Expenses
    Route::get('/expenses', [ViewController::class, 'getExpenseList']);
    Route::get('/expenses/create', [ViewController::class, 'getCreateExpense']);
    Route::get('/expenses/{id}/edit', [ViewController::class, 'getEditExpense']);
    Route::get('/pending_expenses', [ViewController::class, 'getPendingExpenseList']);
    
    
    //Companies
    Route::get('/companies', [ViewController::class, 'getCompanyList']);
    Route::get('/companies/create', [ViewController::class, 'getCreateCompany']);
    Route::get('/companies/{id}/edit', [ViewController::class, 'getEditCompany']);

    //Expense types
    Route::get('/expense_types', [ViewController::class, 'getExpenseTypeList']);
    Route::get('/expense_types/create', [ViewController::class, 'getCreateExpenseType']);
    Route::get('/expense_types/{id}/edit', [ViewController::class, 'getEditExpenseType']);



    Route::patch('/show_entries', [EditController::class, 'editShowEntry']);

    //Settings
    Route::get('/settings/notification', [SettingsController::class, 'getNotificationSetting'])->middleware('check_admin');
    Route::get('/settings/global', [SettingsController::class, 'getGlobalSetting'])->middleware('check_admin');
    Route::get('/settings/mail', [SettingsController::class, 'getMailSetting'])->middleware('check_admin');



    //User
    Route::post('/users', [CreateController::class, 'createUser'])->middleware('check_admin');
    Route::put('/users/{id}', [EditController::class, 'editUser'])->middleware('check_admin');
    Route::delete('/users/{id}', [DeleteController::class, 'deleteUser'])->middleware('check_admin');

    //Expense types
    Route::post('/expense_types', [CreateController::class, 'createExpenseType']);
    Route::put('/expense_types/{id}', [EditController::class, 'editExpenseType']);
    Route::delete('/expense_types/{id}', [DeleteController::class, 'deleteExpenseType']);
    
    //Expense types
    Route::post('/companies', [CreateController::class, 'createCompany']);
    Route::put('/companies/{id}', [EditController::class, 'editCompany']);
    Route::delete('/companies/{id}', [DeleteController::class, 'deleteCompany']);


    //Expense
    Route::post('/expenses', [CreateController::class, 'createExpense']);
    Route::put('/expenses/{id}', [EditController::class, 'editExpense']);
    Route::patch('/pending_expenses/{id}', [EditController::class, 'editPendingExpense']);
    Route::delete('/expenses/{id}', [DeleteController::class, 'deleteExpense']);



    Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
    Route::patch('/settings/global', [SettingsController::class, 'saveSettingGlobal'])->middleware('check_admin');
    Route::patch('/settings/mail', [SettingsController::class, 'saveSettingMail'])->middleware('check_admin');
    Route::patch('/settings/notification', [SettingsController::class, 'saveSettingNotification'])->middleware('check_admin');
});
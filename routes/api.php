<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ExpenseTypeController;
use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Public routes
//Users
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::post('/forgot-password', [ForgotPasswordController::class, 'forgot']);
Route::post('/reset-password', [ForgotPasswordController::class, 'reset']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/updateDetail', [AuthController::class, 'updateDetail']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/check_user', [AuthController::class, 'checkUser']);

    // Expense Type
    Route::get('/expense_types', [ExpenseTypeController::class, 'index']);
    Route::get('/expense_types/{id}', [ExpenseTypeController::class, 'show']);
    Route::post('/expense_types', [ExpenseTypeController::class, 'store'])->middleware('is_admin');
    Route::put('/expense_types/{id}', [ExpenseTypeController::class, 'update'])->middleware('is_admin');
    Route::delete('/expense_types/{id}', [ExpenseTypeController::class, 'destroy'])->middleware('is_admin');


    // Expense
    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expenses/{id}', [ExpenseController::class, 'show']);
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);
    
    Route::get('/chartData', [ExpenseController::class, 'getChartData']);

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

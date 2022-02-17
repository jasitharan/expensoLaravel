<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
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
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

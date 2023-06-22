<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'Register']);

Route::post('login', [AuthController::class, 'Login']);

Route::post('logout', [AuthController::class, 'Logout']);

Route::apiResource('food', FoodController::class);

Route::post('order', [OrderController::class, 'createOrder']);

Route::post('changeStatus', [OrderController::class, 'updateOrder']);




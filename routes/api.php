<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\V1\Controllers\CarController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\AuthAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReformationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ExtraReservationsController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::name('api.v2')->group(function () {
    Route::get('details',[AuthAuthController::class,'details']);
    Route::apiResource('user', UserController::class);
});
// Route::post('login', [ 'as' => 'login', 'uses' => [AuthAuthController::class,'login']]);
Route::post('login',[AuthAuthController::class,'login']);
Route::post('register',[AuthAuthController::class,'register']);


Route::apiResource('agence', AgenceController::class);

Route::apiResource('category', CategoryController::class);

Route::apiResource('user', UserController::class);

// Route::apiResource('employe', EmployeController::class);

Route::apiResource('car', CarController::class);
Route::post('car/add', [CarController::class,'addInCategory'])->name('car.add');

// Route::apiResource('reservation', ReservationController::class);

// Route::apiResource('extra', ExtraController::class);

// Route::apiResource('extra-reservations', ExtraReservationsController::class);

// Route::apiResource('control', ControlController::class);

// Route::apiResource('damage', DamageController::class);

// Route::apiResource('reformation', ReformationController::class);

// Route::apiResource('component', ComponentController::class);

// Route::apiResource('component-reservation', ComponentReservationController::class);


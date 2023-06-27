<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndexController; 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 /*** GROUP OF API WITH MIDDLEWARE AUTH */
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/auth/getUser',[AuthController::class, 'getUser'] );
    Route::get('/auth/logout',[AuthController::class, 'logout'] );
});
/********************************************/

/*** API SERVICES */
Route::post('/auth/register',[AuthController::class, 'register'] );
Route::post('/auth/login',[AuthController::class, 'login'] );
/********************************************/
/** * API CLIENTS  */
Route::post('/execProcedueSQL',[IndexController::class, 'execProcedueSQL'] );
// Route::post('/clients',[ClientController::class, 'store'] );
// Route::get('/clients/{client}',[ClientController::class, 'show'] );
// Route::put('/clients/{client}',[ClientController::class, 'update'] );
// Route::delete('/clients/{client}',[ClientController::class, 'destroy'] );
// /********************************************/

//  /** * API SERVICES */
// Route::get('/services',[ServiceController::class, 'index'] );
// Route::post('/services',[ServiceController::class, 'store'] );
// Route::get('/services/{service}',[ServiceController::class, 'show'] );
// Route::put('/services/{service}',[ServiceController::class, 'update'] );
// Route::delete('/services/{service}',[ServiceController::class, 'destroy'] );
// /********************************************/


// Route::post('clients/services',[ClientController::class, 'attach'] );
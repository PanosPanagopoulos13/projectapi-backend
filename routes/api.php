<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;

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

Route::prefix('v1')->group(function () {

    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
     
        return ['token' => $token->plainTextToken];
    });

    //Route::middleware('auth:sanctum')->group(function () {
    
        Route::prefix('/user')->group(function () {
            Route::get('/get/{id}', [UserController::class, 'get']);
            Route::post('/register', [UserController::class, 'register']);
        });

    //});

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InstituitionController;

Route::post('register', [ AuthController::class, 'register']);
Route::post('login', [ AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('instituition', [InstituitionController::class, 'store']);
    Route::get('instituition/show', [InstituitionController::class, 'show']);
    Route::get('instituition/show/{instituition}', [InstituitionController::class, 'showDetails']);
    Route::put('instituition/update/{instituition}', [InstituitionController::class, 'update']);
    Route::delete('instituition/delete/{instituition}', [InstituitionController::class, 'destroy']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

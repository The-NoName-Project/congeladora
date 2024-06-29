<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [Auth\AuthController::class, 'login']);
Route::post('/register', [Auth\AuthController::class, 'register']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/table', [TableMatchesController::class, 'index']);
    Route::get('/matches', [SoccerMatchesController::class, 'index']);
    Route::post('/device', [UserDeviceController::class, 'register']);
    Route::get('/teams', [TeamsController::class, 'index']);
    Route::get('/categories', [CategoriesController::class, 'index']);

    Route::post('/logout', [Auth\AuthController::class, 'logout']);
});

Route::post('/pdf', [PdfReaderController::class, 'getDataPdf']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
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


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/check', [GameController::class, 'checkAnswer']); //+
    Route::post('/get-rounds', [GameController::class, 'getRounds'])->name('rounds'); //+
    Route::post('/daily-points', [GameController::class, 'dailyPoints']); //+

    Route::post('/round/create', [AdminController::class, 'storeRound']); //+
    Route::post('/clue/create', [AdminController::class, 'store']); //+
    Route::delete('/clue/{id}/delete', [AdminController::class, 'destroy']); //+
    Route::post('/clue/{id}/update', [AdminController::class, 'update']);
    Route::post('/clue/{id}/get', [AdminController::class, 'edit']);
});

Route::post('/auth', [AuthController::class, 'auth']); //+
Route::post('/admin/auth', [AdminController::class, 'authAdmin']);
Route::post('/admin/clues', [AdminController::class, 'getClues']);

Route::post('/check-auth', [AuthController::class, 'checkAuth']);

Route::post('/get-game', [GameController::class, 'getGame']);

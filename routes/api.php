<?php

use App\Http\Controllers\Api\ArticlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return response()->json(['message' => 'Back-end Challenge 2021 🏅 - Space Flight News'], 200);
});

Route::namespace('Api')->group(function () {
    Route::get('articles', [ArticlesController::class, 'list_all']);
    Route::get('articles/{id}', [ArticlesController::class, 'show']);
    Route::post('articles', [ArticlesController::class, 'store']);
    Route::put('articles/{id}', [ArticlesController::class, 'update']);
    Route::delete('articles/{id}', [ArticlesController::class, 'destroy']);
});

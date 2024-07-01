<?php

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

Route::post('/signup', [App\Http\Controllers\Api\AuthController::class, 'signup']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/status', [App\Http\Controllers\Api\AuthController::class, 'status']);
Route::group([
    'prefix' => 'company/{id}',
    'middleware' => ['auth:sanctum','api']
  ], function () {
      Route::middleware('auth:sanctum')->get('/data_documentos', [App\Http\Controllers\Api\SGIController::class, 'getDataDocumentos']);
  });
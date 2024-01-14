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

Route::post('/auth/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::get('/demo', function (Request $request) {
    return response()->json([
        'key' => 'value',
        'key1' => 'value 1',
    ], 200);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/demo1', function (Request $request) {
        return response()->json([
            'key' => 'value',
            'key1' => 'value 1',
        ], 200);
    });
});
<?php

use App\Http\Controllers\CalculateDeliveryPriceController;
use App\Http\Controllers\FakeDeliveryApiController;
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

Route::post('/calculate-delivery', [CalculateDeliveryPriceController::class, 'calculatePrice']);
Route::post('/calculate-delivery/{service}', [CalculateDeliveryPriceController::class, 'oneService']);

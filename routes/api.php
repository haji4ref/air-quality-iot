<?php

use Illuminate\Http\Request;
// use App\Http\Controllers\QualityController;

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
Route::get('quality',QualityController::class . '@index');

Route::get('qualityByDate/{date}',QualityController::class . '@qualityByDate');
Route::get('qualityLive/{qualityName}',QualityController::class . '@qualityLive');
Route::get('qualityToday/{qualityName}',QualityController::class . '@qualityToday');
Route::get('qualityDaysInWeek/{qualityName}',QualityController::class . '@qualityDaysInWeek');
Route::get('qualityDaysInMonth/{qualityName}',QualityController::class . '@qualityDaysInMonth');
Route::get('qualityMonth/{qualityName}',QualityController::class . '@qualityMonth');
Route::post('quality',QualityController::class . '@store');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

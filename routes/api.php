<?php

use App\Http\Controllers\PaymentController;
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


Route::middleware('auth:api')->prefix('/oak/v2')->group(function () {

    Route::post('/clients/{clientId}/transferTo/trackId={trackId}', [PaymentController::class, 'transferTo']);
    Route::get('/clients/{clientId}/deposits//{deposit}/payas', [PaymentController::class, 'deposit']);



});

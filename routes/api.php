<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PropertySearchController;
use App\Http\Controllers\Api\PropertyShowController;
use App\Http\Controllers\Api\PropertyMostViewedController;
use App\Http\Controllers\Api\PropertyLaunchController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {
    // Newsletter
    Route::post('/newsletters', [NewsletterController::class, 'store']);

    // Contato
    Route::post('/contacts', [ContactController::class, 'store']);

    // Propriedades
    Route::get('/properties/search', PropertySearchController::class);
    Route::get('/properties/most-viewed', PropertyMostViewedController::class);
    Route::get('/properties/launchs', PropertyLaunchController::class);
    Route::get('/properties/{code}', PropertyShowController::class);
});

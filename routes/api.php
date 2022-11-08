<?php

use App\Http\Controllers\Api\v1\FruitController;
use App\Http\Controllers\Api\v1\SaladController;
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

Route::prefix('v1')->group(function (){
    Route::resource('fruits', FruitController::class)->only([
        'index', 'store'
    ]);
    Route::resource('salad_recipes', SaladController::class);
    }
);


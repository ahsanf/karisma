<?php

use App\Http\Controllers\Api\V1\BotApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix'=> 'v1',
    'as' => 'api.'
], function(){
    Route::get('/get-balance', [BotApiController::class, 'getBalance'])->name('get-balance');
    Route::group([
        'prefix' => 'personal-finance',
        'as' => 'personal-finance.'
    ], function(){
        Route::post('/store', [BotApiController::class, 'storePersonalFinance'])->name('store');
        Route::get('/get-all', [BotApiController::class, 'getAllPersonalFinance'])->name('get-all');
    });
});

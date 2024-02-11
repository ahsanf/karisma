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

    Route::group([
        'prefix' => 'personal-finance',
        'as' => 'personal-finance.'
    ], function(){
        Route::post('/store', [BotApiController::class, 'storePersonalFinance'])->name('store');
        Route::get('/get-all', [BotApiController::class, 'getAllPersonalFinance'])->name('get-all');
        Route::get('/get', [BotApiController::class, 'getPersonalFinance'])->name('get');
        Route::get('/recap', [BotApiController::class, 'getRecapFinanceByYear'])->name('recap');
        Route::get('/ordered', [BotApiController::class, 'getOrderedFinance'])->name('ordered');

    });

    Route::group([
        'prefix' => 'flipto',
        'as' => 'flipto.'
    ], function() {
        Route::get('/get-config', [BotApiController::class, 'getConfig'])->name('get-config');
        Route::post('/update-config', [BotApiController::class, 'updateConfig'])->name('update-config');
        Route::post('/add-config', [BotApiController::class, 'addConfig'])->name('add-config');
        Route::post('/delete-config', [BotApiController::class, 'deleteConfig'])->name('delete-config');
    });

    Route::group([
        'prefix' => 'karisma',
        'as' => 'karisma.'
    ], function() {
        Route::get('/get-events', [BotApiController::class, 'getEvents'])->name('get-events');
        Route::get('/get-balance', [BotApiController::class, 'getBalance'])->name('get-balance');
        Route::get('/get-event-member',[BotApiController::class, 'getEventMembers'])->name('get-event-member');
    });
});

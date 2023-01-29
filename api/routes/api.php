<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TickerSymbolController;
use App\Http\Controllers\LendingOpenPositionController;

Route::get('/', fn() =>
    response()->json([
        'message' => 'ok'
    ])
);

Route
    ::controller(TickerSymbolController::class)
    ->prefix('tickersymbol')
    ->group(
        function () {
            Route::get('/', 'getAll');
            Route::get('{id}', 'getOne');
        }
    );

Route
    ::controller(LendingOpenPositionController::class)
    ->prefix('lendingopenposition')
    ->group(
        function () {
            Route::get('/', 'getAll');
            Route::get('{id}', 'getOne');
        }
    );
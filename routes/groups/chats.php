<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::controller(ChatController::class)->prefix('chats')->group(function () {
    Route::post('/', 'store');
    Route::get('{chat}', 'show');
    Route::post('{chat}/messages', 'sendMessage');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', 'index');
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix' => 'bot',
    'middleware' => ['throttle:60,1'],
], function ($router) {
    Route::get('/check', [ChatbotController::class, 'check'])->name('bot.check');
    Route::get('/historico', [ChatbotController::class, 'exibirHistorico'])->name('bot.historico');
    Route::post('/inserir', [ChatbotController::class, 'inserirMensagem'])->name('bot.msg');
    Route::delete('/reset', [ChatbotController::class, 'resetarHistorico'])->name('bot.reset');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('welcome');
});

/*
    Rotas para ChatBot
*/
Route::prefix('projeto-ia')->group(function () {
    Route::get('/chat', [ChatbotController::class, 'index'])->name('chat.index');
});
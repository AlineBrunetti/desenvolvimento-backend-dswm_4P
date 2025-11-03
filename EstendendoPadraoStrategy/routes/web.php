<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

// Rota de exemplo: POST /calculate-discount
Route::post('/calculate-discount', [OrderController::class, 'calculate']);
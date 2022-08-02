<?php

use App\Http\Controllers\Admin\ConnectionAutoresponderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Usuario\UploadCredentialFileController;
use Illuminate\Support\Facades\Route;

/**
 * ROTAS SEM AUTENTICAÇÃO
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * ROTAS COM AUTENTICAÇÃO
 */
Route::post('/request-messages', [ConnectionAutoresponderController::class, 'connect'])->middleware('auth:sanctum');
//Route::get('/arquivo-credencial/{usuario}/{nome}', [UploadCredentialFileController::class, 'findFile'])->name('api.arquivo-credencial');

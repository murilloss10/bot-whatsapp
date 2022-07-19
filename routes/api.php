<?php

use App\Http\Controllers\Admin\ConnectionAutoresponderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Usuario\UploadCredentialFileController;
use App\Services\UploadCredentialFile;
use Illuminate\Support\Facades\Auth;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth']], function (){
//    Route::post('/request-messages', [ConnectionAutoresponderController::class, 'connect']);
    Route::get('bem-vindo', function () {
        return "oLá";
    });
});

Route::post('/request-messages', [ConnectionAutoresponderController::class, 'connect']);
Route::get('/arquivo-credencial/{usuario}/{nome}', [UploadCredentialFileController::class, 'findFile'])->name('api.arquivo-credencial');

//Route::post('/request-messages', [ConnectionAutoresponderController::class, 'connect'])->name('test.connect')->middleware(['auth:sanctum']);

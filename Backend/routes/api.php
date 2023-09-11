<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum','multirole:staff'])->get('/test', function (Request $request) {
    return [ 'success' => true ];
});


Route::middleware(['auth:sanctum'])->post('/revoke', function (Request $request) {
    $user = auth()->user();

    // Revoke all of the user's tokens
    $user->tokens->each->delete();
});


Route::post('/loginServer', [AuthController::class,'loginServer'])->name('login.server');
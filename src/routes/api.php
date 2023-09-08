<?php

use App\Http\Controllers\Api\RequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    return $request->user();
    // return auth('sanctum')->user();
    // Auth::guard('sanctum')->user();
    // Auth::user();
})->name('getUser');

Route::get('/', function () {
    return  [
        'hello' => 'src'
    ];
});

Route::post('/loginServer', [RequestController::class,'loginServer'])->name('login.server');
Route::post('/logoutServer', [RequestController::class,'logoutServer'])->name('logout.server');
Route::post('/downServer', [RequestController::class,'downServer'])->name('down.server');
Route::post('/upServer', [RequestController::class,'upServer'])->name('up.server');
Route::post('/quote', [RequestController::class,'quote'])->name('quote.server')->middleware('auth:sanctum');
Route::post('/userSession', [RequestController::class,'userSession'])->name('session')->middleware('auth:sanctum');

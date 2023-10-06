<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//      $request->user()->info;
//      return $request->user();
//     return User::with('info')->get();
// });

// Route::middleware(['auth:sanctum','multirole:staff'])->get('/test', function (Request $request) {
//     return [ 'success' => true ];
// });


// Route::middleware(['auth:sanctum'])->post('/revoke', function (Request $request) {
//     $user = auth()->user();

//     // Revoke all of the user's tokens
//     $user->tokens->each->delete();
// });


// Route::post('/loginServer', [AuthController::class,'loginServer'])->name('login.server');
// Route::get('/setApiCookie', [AuthController::class,'setApiCookie'])->name('cookie.server');

// Route::post('/testFETCH', function () {
//     return ['success' => true];
// })->name('test.server');




Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});
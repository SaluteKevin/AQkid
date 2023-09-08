<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [AuthController::class, 'getLoginPage'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('/forgotPassword', [AuthController::class, 'getForgotPage'])->name('forgot.password');
Route::post('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgot.password');

Route::get('/resetPassword/{token}', [AuthController::class, 'getResetPage'])->name('reset.password');
Route::post('/resetPassword/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');


Route::get('/verified/{userId}', [AuthController::class, 'verifyUser'])->name('verified');
Route::middleware(['auth','session'])->group( function () {
    
    Route::get('/test', function () {
        return view('test');
    })->name('test');

    // Route::get('/test', [AuthController::class, 'testInertia'])->name('test');
    Route::get('/welcome', [AuthController::class, 'getPage'])->name('welcome');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::post('/axios', [AuthController::class, 'axios'])->name('axios');


Route::get('/terminal', function () {
    return view('terminal');
})->name('terminal');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

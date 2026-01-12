<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Routes for Managers:
Route::middleware('guest:manager')->prefix('manager')->group( function () {

    Route::get('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'create'])->name('manager.login');
    Route::post('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'store']);

    Route::get('register', [App\Http\Controllers\Auth\Manager\RegisterController::class, 'create'])->name('manager.register');
    Route::post('register', [App\Http\Controllers\Auth\Manager\RegisterController::class, 'store']);

});

Route::middleware('auth:manager')->prefix('manager')->group( function () {

    Route::post('logout', [App\Http\Controllers\Auth\Manager\LoginController::class, 'destroy'])->name('manager.logout');

    Route::view('/dashboard','manager_dashboard');

});

//Routes for Executives:
Route::middleware('guest:executive')->prefix('executive')->group( function () {

    Route::get('login', [App\Http\Controllers\Auth\Executive\LoginController::class, 'create'])->name('executive.login');
    Route::post('login', [App\Http\Controllers\Auth\Executive\LoginController::class, 'store']);

    Route::get('register', [App\Http\Controllers\Auth\Executive\RegisterController::class, 'create'])->name('executive.register');
    Route::post('register', [App\Http\Controllers\Auth\Executive\RegisterController::class, 'store']);

});

Route::middleware('auth:executive')->prefix('executive')->group( function () {

    Route::post('logout', [App\Http\Controllers\Auth\Executive\LoginController::class, 'destroy'])->name('executive.logout');

    Route::view('/dashboard','executive_dashboard');

});


//Routes for Admins:
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

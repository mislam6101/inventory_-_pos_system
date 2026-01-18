<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExecutiveController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
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

//Routes for Category:
Route::middleware('auth:web,manager,executive')->group(function () {
    Route::resource('category', CategoryController::class);
});

//Routes for Products:
Route::middleware('auth:web,manager,executive')->group(function () {
    Route::resource('product', ProductController::class);
});

//Routes for Manager:
Route::middleware('auth:web')->group(function () {
    Route::resource('manager', ManagerController::class);
});
Route::post('/manager/status-update', [ManagerController::class, 'statusUpdate'])
    ->name('manager.status.update');

//Routes for Executive:
Route::middleware('auth:web,manager')->group(function () {
    Route::resource('executive', ExecutiveController::class);
});
Route::post('/executive/status-update', [ExecutiveController::class, 'statusUpdate'])
    ->name('executive.status.update');

//Routes for Suppliers:

Route::middleware('auth:web,manager')->group(function () {
    Route::resource('supplier', SupplierController::class);
});

//Routes for Purchases:

Route::middleware('auth:web,manager')->group(function () {
    Route::resource('purchase', PurchaseController::class);
});


require __DIR__.'/auth.php';

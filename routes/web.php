<?php

use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
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
    return redirect()->route(('admin-dashboard'));
});
// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });

// Route::middleware([
//     'auth:sanctum',
//     // config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
Route::prefix('dashboard')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('users', UserController::class);
    Route::resource('foods', FoodController::class);
});

//midtrans
Route::get('/midtrans/success', [MidtransController::class, 'success']);
Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinish']);
Route::get('/midtrans/error', [MidtransController::class, 'error']);

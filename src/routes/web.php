<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [ShopController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/thanks', function () {
    return view('auth.thanks');
})->name('thanks');

Route::get('/shops', [ShopController::class, 'index'])
    ->middleware(['auth'])
    ->name('shops.index');

Route::get('/shops/{id}', [ReservationController::class, 'show'])
    ->middleware(['auth'])
    ->name('shops.show');

Route::post('/shops/{shop}/reserve', [ReservationController::class, 'store'])
    ->middleware(['auth'])
    ->name('shops.reserve');

Route::get('/reservations/thanks', function () {
    return view('reservation-thanks');
})->name('reservations.thanks');

Route::get('/mypage', [MypageController::class, 'index'])
    ->middleware(['auth'])
    ->name('mypage');

Route::delete('/reservations/{id}', [MypageController::class, 'deleteReservation'])
    ->middleware(['auth'])
    ->name('reservations.delete');

Route::post('/reservations/{id}', [MypageController::class, 'updateReservation'])
    ->middleware(['auth'])
    ->name('reservations.update');

require __DIR__.'/auth.php';

Route::post('/favorites/toggle/{shop}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\BookingController;

Route::get('/book', [BookingController::class, 'showBookingForm']);
Route::post('/book', [BookingController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/bookings', [BookingController::class, 'index']);
    Route::post('/admin/bookings/{booking}/accept', [BookingController::class, 'accept']);
    Route::post('/admin/bookings/{booking}/decline', [BookingController::class, 'decline']);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

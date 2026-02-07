<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;
use App\Models\Reservation;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $reservations = Reservation::with([
            'segment.departureEtape.gare.ville', 
            'segment.arrivalEtape.gare.ville',
            'segment.programme.bus',
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('dashboard', compact('reservations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
Route::post('/trips/search', [TripController::class, 'search'])->name('trips.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{reservation}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

require __DIR__.'/auth.php';
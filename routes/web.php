<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/book', function () {
    return view('book');
})->name('book');

Route::get('/bookings/success', function () {
    return view('bookings.success');
})->name('bookings.success');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

// Route::get('/test-email', function () {
//     Mail::raw('This is a test email from Gmail SMTP!', function ($message) {
//         $message->to('muneebmalik2468@gmail.com')
//                 ->subject('Gmail SMTP Test');
//     });

//     return 'Email sent!';
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/bookings/{booking}/cancel', function (Booking $booking) {
        if (!$booking || $booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        if ($booking->status === 'pending') {
            $booking->update(['status' => 'cancelled']);
            session()->flash('message', 'Booking cancelled successfully.');
        }
        return redirect()->route('dashboard');
    })->name('bookings.cancel');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

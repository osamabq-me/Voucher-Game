<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\SetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [ProductController::class, 'index'])->name('welcome');
Route::post('/order', [OrderController::class, 'store'])->middleware('auth');

Route::get('auth/github', [SocialiteController::class, 'redirectToProvider'])->name('auth.github');
Route::get('auth/github/callback', [SocialiteController::class, 'handleProviderCallback']);
Route::get('password/set', [SetPasswordController::class, 'showSetPasswordForm'])->name('password.set');
Route::post('password/set', [SetPasswordController::class, 'setPassword']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/disconnect-github', [ProfileController::class, 'disconnectGitHub'])->name('profile.disconnect-github');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/history', [HistoryController::class, 'adminIndex'])->name('history.adminhistory');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__ . '/auth.php';

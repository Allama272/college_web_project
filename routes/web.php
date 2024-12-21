<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfilePublicController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AdminController;


Route::middleware(['auth'])->group(function () {
    Route::post('/follow/{user}', [FollowController::class, 'togglefollow'])->name('follow.toggle');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/chirps/{chirp}/like', [LikeController::class, 'toggleLike'])->name('chirps.like');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('Home');


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::delete('/admin/{chirp}', [AdminController::class, 'destroy'])->name('admin_delete');

});

Route::get('contact', function () {
    return Inertia::render('Contact'); })->name('contact');

Route::get('/dashboard', function () {
    return redirect()->route('chirps.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user-page/{prof_user}', [ProfilePublicController::class, 'view'])->name('user_profile');

    Route::middleware(['auth', 'verified'])->group(function () {
        // Follow a user
        Route::post('/users/{user}/follow', [FollowController::class, 'follow'])
             ->name('users.follow');

        // Unfollow a user
        Route::delete('/users/{user}/unfollow', [FollowController::class, 'unfollow'])
             ->name('users.unfollow');
    });

});


require __DIR__ . '/auth.php';

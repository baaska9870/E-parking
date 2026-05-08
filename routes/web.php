<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'user'
            ? redirect()->route('map')
            : redirect()->route('dashboard');
    }
    return view('login_page');
})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    
    Route::get('/bidnii-tuhai', function () {
        return view('bidnii_tuhai');
    })->name('bidnii-tuhai');
    
    Route::get('/tulbur-shalgah', function () {
        return view('tulurb_shalgah');
    })->name('tulbur-shalgah');
    
    Route::get('/map', function () {
        return view('map');
    })->name('map');
    
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/admin', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied.');
        }
        return view('admin');
    })->name('admin');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SetPasswordController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', [CertificateController::class, 'dashboard'])->name('dashboard');
// Route::view('/profile', 'auth.show')->name('profile');

// Route::get('/login', [SessionController::class, 'create'])->name('login');
// Route::post('/login', [SessionController::class, 'store']);
// Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');

// Route::get('/setpassword/{token}', [SetPasswordController::class, 'create'])->name('set-password');
// Route::post('/setpassword', [SetPasswordController::class, 'store'])->name('store-password');

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store'])->name('store-user');
// Route::get('/users', [RegisteredUserController::class, 'index'])->middleware('role:admin')->name('users');
// Route::delete('/users', [RegisteredUserController::class, 'destroy'])->middleware('role:admin')->name('delete-user');
// Route::get('/user/{user}', [RegisteredUserController::class, 'edit'])->name('show-user');

// Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates');
// Route::get('/certificates/create', [CertificateController::class, 'create'])->name('add-certificate');
// Route::get('/certificates/{cert}', [CertificateController::class, 'edit'])->name('get-certificate');
// Route::post('/certificates', [CertificateController::class, 'store'])->name('store-certificate');
// Route::patch('/certificates', [CertificateController::class, 'update'])->name('verify-certificate');
// Route::delete('/certificates', [CertificateController::class, 'destroy'])->name('delete-certificate');

// Route::get('/clients', [ClientController::class, 'index'])->name('clients');
// Route::get('/clients/create', [ClientController::class, 'create'])->name('add-client');
// Route::get('/clients/{client}', [ClientController::class, 'edit'])->name('get-client');
// Route::post('/clients', [ClientController::class, 'store'])->name('store-client');
// Route::patch('/clients', [ClientController::class, 'update'])->name('verify-client');
// Route::delete('/clients', [ClientController::class, 'destroy'])->name('delete-client');

// Public routes
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [SetPasswordController::class, 'show'])->name('forgot-password');
    Route::post('/forgot-password', [SetPasswordController::class, 'email'])->name('send-reset-email');
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
    Route::get('/setpassword/{token}', [SetPasswordController::class, 'create'])->name('set-password');
    Route::post('/setpassword', [SetPasswordController::class, 'store'])->name('store-password');
    Route::redirect('/', 'dashboard');
});





// Authenticated routes
Route::middleware(['auth', 'password.set'])->group(function () {

    // Common authenticated routes
    Route::get('/dashboard', [SessionController::class, 'dashboard'])->name('dashboard'); // TODO: Dynamic data for certificates at cards
    Route::get('/profile', [SessionController::class, 'show'])->name('profile'); // TODO: Dynamic data for each user
    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');

    // Certificate management
    Route::prefix('certificates')->group(function () {
        Route::get('/', [CertificateController::class, 'index'])->name('certificates');

        // Routes requiring 'add certificates' permission
        Route::middleware('permission:add certificates')->group(function () {
            Route::get('/create', [CertificateController::class, 'create'])->name('add-certificate');
            Route::post('/', [CertificateController::class, 'store'])->name('store-certificate');
        });

        // Routes requiring 'verify certificates' permission
        Route::middleware('permission:verify certificates')->group(function () {
            Route::get('/{cert}', [CertificateController::class, 'edit'])->name('get-certificate');
            Route::patch('/', [CertificateController::class, 'update'])->name('verify-certificate');
            Route::delete('/', [CertificateController::class, 'destroy'])->name('delete-certificate');
        });
    });

    // Client management
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clients');

        // Routes requiring 'add clients' permission
        Route::middleware('permission:add clients')->group(function () {
            Route::get('/create', [ClientController::class, 'create'])->name('add-client');
            Route::post('/', [ClientController::class, 'store'])->name('store-client');
        });

        // Routes requiring 'verify clients' permission
        Route::middleware('permission:verify clients')->group(function () {
            Route::get('/{client}', [ClientController::class, 'edit'])->name('get-client');
            Route::patch('/', [ClientController::class, 'update'])->name('verify-client');
            Route::delete('/', [ClientController::class, 'destroy'])->name('delete-client');
        });
    });

    // User management
    Route::prefix('users')->middleware('permission:modify users')->group(function () {
        Route::get('/', [RegisteredUserController::class, 'index'])->name('users');
        Route::get('/{user}', [RegisteredUserController::class, 'edit'])->name('get-user');
        Route::patch('/', [RegisteredUserController::class, 'update'])->name('update-user');
        Route::delete('/', [RegisteredUserController::class, 'destroy'])->name('delete-user');
    });

    // Special routes
    Route::middleware('permission:modify users')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store'])->name('store-user');
    });
});

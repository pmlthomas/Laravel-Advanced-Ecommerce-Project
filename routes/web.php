<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\frontend\IndexController;
use Illuminate\Support\Facades\Route;

// ? Admin Routes
Route::middleware('auth')->group(function () {

    // Admin Dashboard
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'Index'])->name('admin.dashboard');
    });

    // Admin Profile Routes
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
            Route::get('/admin/profile/edit', 'EditProfilePage')->name('admin.profile.edit');
            Route::post('/admin/profile/update', 'UpdateProfile')->name('admin.profile.update');

            Route::get('/admin/password/edit', 'EditPasswordPage')->name('admin.password.edit');
            Route::post('/admin/password/update', 'UpdatePassword')->name('admin.password.update');
        });
    });

    // Logout
    Route::controller(AdminController::class)->group(function () {
        Route::get('/logout', 'destroy')->name('admin.logout');
    });
});

// ? User Routes
    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'Index')->name('homepage');
        Route::get('/connexion', 'AuthForms')->name('auth.forms');

        Route::get('/mon-compte', 'UserProfile')->name('user.profile');
        Route::get('/mon-compte/modifier', 'EditUserProfilePage')->name('user.profile.edit');
        Route::post('/mon-compte/update', 'UpdateUserProfile')->name('user.profile.update');

        Route::get('/mot-de-passe/modifier', 'EditPasswordPage')->name('user.password.edit');
        Route::post('/mot-de-passe/update', 'UpdatePassword')->name('user.password.update');
    });



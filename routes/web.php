<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AmenidadController;

Route::get('/', function () {
    return (Auth::check()) ? view('dashboard') : view('auth.login') ;
});

// Route::get('/amenidades', 'AmenidadController@index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::get('/users/{user}/assign', [UserController::class, 'form_assign']);
    Route::put('/users/{user}/assign', [UserController::class, 'assing_role']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // // CATALOGOS
    // // INMUEBLES
    Route::resource('/amenidades', AmenidadController::class);
});
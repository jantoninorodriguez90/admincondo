<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return (Auth::check()) ? view('dashboard') : view('auth.login') ;
});


Route::middleware(['auth:sanctum', 'verified',
])->group(function () {
    
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // // CATALOGOS
    // // INMUEBLES
    // Route::resource('inmuebles', InmuebleController::class);
});
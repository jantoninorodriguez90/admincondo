<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AmenidadesController;

Route::get('/', function () {
    return (Auth::check()) ? view('dashboard') : view('auth.login') ;
});

// Route::get('/amenidades', 'AmenidadController@index');

Route::middleware(['auth:sanctum', 'verified',
])->group(function () {
    
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    // Route::resource('amenidades', AmenidadesController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // // CATALOGOS
    // // INMUEBLES
    // Route::resource('inmuebles', InmuebleController::class);
});
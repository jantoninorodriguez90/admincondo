<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NavegationController;

Route::get('/', function () {
    return (Auth::check()) ? view('dashboard') : view('auth.login') ;
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('systems')->group(function () {
        // ROLES
        Route::resource('roles', RoleController::class);
        // PERMISSIONS
        Route::resource('permissions', PermissionController::class);
        // USERS
        Route::resource('users', UserController::class);
        Route::get('/users/{user}/assign', [UserController::class, 'form_assign'])->name('users.assign');
        Route::put('/users/{user}/assign', [UserController::class, 'assing_role'])->name('users.assigned');
        # NAVIGATION
        Route::resource('navegations', NavegationController::class);
        # NAVIGATION - SECCIONES
        Route::post('navegations/seccion', [NavegationController::class, 'store_seccion'])->name('navegations.seccion.store');
        Route::get('navegations/{navegation}/seccion/edit', [NavegationController::class, 'edit_seccion'])->name('navegations.seccion.edit');
        Route::put('navegations/{navegation}/seccion', [NavegationController::class, 'update_seccion'])->name('navegations.seccion.update');
        Route::delete('navegations/{navegation}/seccion', [NavegationController::class, 'destroy_seccion'])->name('navegations.seccion.delete');
        # NAVIGATION - MODULOS
        Route::post('navegations/modulo', [NavegationController::class, 'store_modulo'])->name('navegations.modulo.store');
        Route::get('navegations/{navegation}/modulo/edit', [NavegationController::class, 'edit_modulo'])->name('navegations.modulo.edit');
        Route::put('navegations/{navegation}/modulo', [NavegationController::class, 'update_modulo'])->name('navegations.modulo.update');
        Route::delete('navegations/{navegation}/modulo', [NavegationController::class, 'destroy_modulo'])->name('navegations.modulo.delete');
    });
    


    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
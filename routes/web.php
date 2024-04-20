<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\TestController@welcome');

Auth::routes();


//Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);

    // ROL: ADMIN
    Route::middleware(['check.rol:1'])->prefix('admin')->group(function () {
        // Rutas del admin
        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); //listado
        //Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard'); //dashboard
        Route::get('/processes/{id}/show', [App\Http\Controllers\ProcessController::class, 'index']); //show
        Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']); //formulario
        Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']); //registrar
        Route::get('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit']); //form de edicion
        Route::post('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'update']); //actualizar
        Route::delete('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']); //form eliminar

        Route::get('/processes/create', [App\Http\Controllers\ProcessController::class, 'create']); //formulario
        Route::post('/processes', [App\Http\Controllers\ProcessController::class, 'store']); //registrar
        Route::get('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'edit']); //form de edicion
        Route::post('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'update']); //actualizar
        Route::delete('/processes/{id}', [App\Http\Controllers\ProcessController::class, 'destroy']); //form eliminar
    });

    // ROL: EMPLEADO
    Route::middleware(['check.rol:3'])->prefix('empleado')->group(function () {

        // Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index']); //dashboard
        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); // listado
        Route::get('/projects/{id}/show', [App\Http\Controllers\ProcessController::class, 'index']); //show
        Route::get('/processes/{id}/show', [App\Http\Controllers\ActivityController::class, 'index']);
    });
});

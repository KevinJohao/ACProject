<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\TestController@welcome');

Auth::routes();

//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboardAdmin']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboardAdmin']);

    // Rutas del admin proyecto base
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']); //listado
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create']); //formulario
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store']); //registrar
    Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit']); //form de edicion
    Route::post('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'update']); //actualizar
    Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']); //form eliminar


    // Rutas del admin
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); //listado
    Route::get('/projects/{id}/show', [App\Http\Controllers\ProjectController::class, 'show']); //show
    Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']); //formulario
    Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']); //registrar
    Route::get('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit']); //form de edicion
    Route::post('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'update']); //actualizar
    Route::delete('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']); //form eliminar
});
*/

Route::middleware(['auth'])->group(function () {
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ROL: ADMIN
    Route::middleware(['check.rol:1'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboardAdmin']);

        // Rutas del admin
        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); //listado
        Route::get('/projects/{id}/show', [App\Http\Controllers\ProcessController::class, 'show']); //show
        Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']); //formulario
        Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']); //registrar
        Route::get('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit']); //form de edicion
        Route::post('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'update']); //actualizar
        Route::delete('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']); //form eliminar

        Route::get('/processes', [App\Http\Controllers\ProcessController::class, 'index']); //listado
        Route::get('/processes/{id}/show', [App\Http\Controllers\ProcessController::class, 'showProcesses']); //show
        Route::get('/processes/create', [App\Http\Controllers\ProcessController::class, 'create']); //formulario
        Route::post('/processes', [App\Http\Controllers\ProcessController::class, 'store']); //registrar
        Route::get('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'edit']); //form de edicion
        Route::post('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'update']); //actualizar
        Route::delete('/processes/{id}', [App\Http\Controllers\ProcessController::class, 'destroy']); //form eliminar
    });

    // ROL: EMPLEADO
    Route::middleware(['check.rol:3'])->prefix('empleado')->group(function () {

        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); // listado
    });
});

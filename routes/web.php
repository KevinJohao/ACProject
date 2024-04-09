<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\TestController@welcome');

Auth::routes();

//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboardAdmin']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']); //formulario
    Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']); //registrar
    Route::get('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit']); //form de edicion
    Route::post('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'update']); //actualizar
    Route::delete('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']); //form eliminar
});

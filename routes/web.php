<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\TestController@welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Rutas del admin
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']); //listado
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create']); //formulario
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store']); //registrar
    Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit']); //form de edicion
    Route::post('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'update']); //actualizar
    Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']); //form eliminar
});

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
        //Projects
        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); //listado
        Route::get('/processes/{id}/show', [App\Http\Controllers\ProcessController::class, 'index'])->name('admin.processes.show'); //show
        Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']); //formulario
        Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']); //registrar
        Route::get('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit']); //form de edicion
        Route::post('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'update']); //actualizar
        Route::delete('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']); //form eliminar
        //Processes
        Route::get('/processes', [App\Http\Controllers\ProcessController::class, 'indexProcesses']); //listado
        Route::get('/processes/create', [App\Http\Controllers\ProcessController::class, 'create']); //formulario
        Route::post('/processes', [App\Http\Controllers\ProcessController::class, 'store']); //registrar
        Route::get('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'edit']); //form de edicion
        Route::put('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'update']); //actualizar
        Route::delete('/processes/{id}', [App\Http\Controllers\ProcessController::class, 'destroy']); //form eliminar
        //Clients
        Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index']); //listado
        Route::get('clients/create', [App\Http\Controllers\ClientController::class, 'create']); //formulario
        Route::post('/clients', [App\Http\Controllers\ClientController::class, 'store']); //registrar
        //Employees
        Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index']); //listado
        Route::get('employees/create', [App\Http\Controllers\EmployeeController::class, 'create']); //formulario
        Route::post('/employees', [App\Http\Controllers\EmployeeController::class, 'store']); //registrar
        //Docs
        Route::get('/docs', [\App\Http\Controllers\DocsController::class, 'index']); //listado
        Route::get('docs/create', [App\Http\Controllers\DocsController::class, 'create']); //formulario
        Route::post('/docs', [App\Http\Controllers\DocsController::class, 'store']); //registrar
        Route::get('/docs/{id}/edit', [App\Http\Controllers\DocsController::class, 'edit']); //form de edicion
        Route::put('/docs/{id}/edit', [App\Http\Controllers\DocsController::class, 'update']); //actualizar
    });

    // ROL: EMPLEADO
    Route::middleware(['check.rol:3'])->prefix('empleado')->group(function () {

        // Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index']); //dashboard
        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); // listado
        Route::get('/projects/{id}/show', [App\Http\Controllers\ProcessController::class, 'index']); //show

        // ACTIVIDADES
        Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index']);
        Route::get('/processes/{id}/show', [App\Http\Controllers\ProcessController::class, 'showActivities']);

        // SEGUIMIENTOS
        Route::get('/trackings', [App\Http\Controllers\TrackingController::class, 'indexEmployee']);
        Route::get('/activities/{id}/show',[App\Http\Controllers\ActivityController::class, 'showTrackingsEmployee']);
    });
});

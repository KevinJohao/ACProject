<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\TestController@welcome');

Auth::routes();


//Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    //Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);

    // ROL: ADMIN
    Route::middleware(['check.rol:1'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\ProjectController::class, 'index']);
        //Projects
        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); //listado
        Route::get('/processes/{id}/show', [App\Http\Controllers\ProcessController::class, 'index'])->name('admin.processes.show'); //show
        Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']); //formulario
        Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']); //registrar
        Route::get('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit']); //form de edicion
        Route::post('/projects/{id}/edit', [App\Http\Controllers\ProjectController::class, 'update']); //actualizar
        Route::delete('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']); //form eliminar
        //Processes
        Route::get('/processes/create', [App\Http\Controllers\ProcessController::class, 'create']); //formulario
        Route::post('/processes', [App\Http\Controllers\ProcessController::class, 'store']); //registrar
        Route::get('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'edit']); //form de edicion
        Route::put('/processes/{id}/edit', [App\Http\Controllers\ProcessController::class, 'update']); //actualizar
        Route::get('/processes/{id}/show', [App\Http\Controllers\DocsController::class, 'index']); //show
        //TypeProcesses
        Route::get('/type_processes', [App\Http\Controllers\TypeProcessController::class, 'index']); //listado
        Route::get('/type_processes/{id}/edit', [App\Http\Controllers\TypeProcessController::class, 'edit']); //form de edicion
        Route::put('/type_processes/{id}/edit', [App\Http\Controllers\TypeProcessController::class, 'update']); //actualizar
        Route::get('/type_processes/{id}/show', [App\Http\Controllers\TypeProcessController::class, 'show']); //show
        //Clients
        Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index']); //listado
        Route::get('clients/create', [App\Http\Controllers\ClientController::class, 'create']); //formulario
        Route::post('/clients', [App\Http\Controllers\ClientController::class, 'store']); //registrar
        Route::get('/clients/{id}/edit', [App\Http\Controllers\ClientController::class, 'edit']); //form de edicion
        Route::put('/clients/{id}/edit', [App\Http\Controllers\ClientController::class, 'update']); //actualizar
        Route::delete('/clients/{id}', [App\Http\Controllers\ClientController::class, 'destroy']); //form eliminar
        //Employees
        Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index']); //listado
        Route::get('employees/create', [App\Http\Controllers\EmployeeController::class, 'create']); //formulario
        Route::post('/employees', [App\Http\Controllers\EmployeeController::class, 'store']); //registrar
        Route::get('/employees/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit']); //form de edicion
        Route::put('/employees/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'update']); //actualizar
        Route::delete('/employees/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy']); //form eliminar
        //Docs
        Route::get('/docs/{id}/show', [\App\Http\Controllers\DocsController::class, 'index']); //listado
        Route::get('docs/create', [App\Http\Controllers\DocsController::class, 'create']); //formulario
        Route::post('/docs', [App\Http\Controllers\DocsController::class, 'store']); //registrar
        Route::get('/docs/{id}/edit', [App\Http\Controllers\DocsController::class, 'edit']); //form de edicion
        Route::put('/docs/{id}', [App\Http\Controllers\DocsController::class, 'update']); //actualizar
        //Type Activities
        Route::get('/type_activities', [\App\Http\Controllers\ActivityController::class, 'index']); //listado
        Route::get('type_activities/create', [App\Http\Controllers\ActivityController::class, 'create']); //formulario
        Route::post('/type_activities', [App\Http\Controllers\ActivityController::class, 'store']); //registrar
        Route::get('/type_activities/{id}/edit', [App\Http\Controllers\ActivityController::class, 'edit']); //form de edicion
        Route::put('/type_activities/{id}/edit', [App\Http\Controllers\ActivityController::class, 'update']); //actualizar
        Route::delete('/type_activities/{id}', [App\Http\Controllers\ActivityController::class, 'destroy']); //form eliminar

    });

    // ROL: EMPLEADO
    Route::middleware(['check.rol:3'])->prefix('empleado')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\ProjectController::class, 'index']); // dashboard - lista de proyectos

        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); //listado

        Route::get('/projects/{id}/show', [App\Http\Controllers\ProcessController::class, 'index']); //Lista de tramites del proyecto seleccionado

        // ACTIVIDADES
        Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index']); // Lista de actividades asignadas
        Route::get('/activities/processes/{id}/show', [App\Http\Controllers\ProcessController::class, 'showActivitiesEmployee']); // Actividades del trámite seleccionado

        // SEGUIMIENTOS
        Route::get('/trackings', [App\Http\Controllers\TrackingController::class, 'indexEmployee']); // Lista de seguimientos asignados
        Route::get('/trackings/activities/{id}/show', [App\Http\Controllers\ActivityController::class, 'showTrackingsEmployee']); // Seguimiento de la actividad seleccionada
        Route::put('/trackings/{id}/edit/observation', [App\Http\Controllers\TrackingController::class, 'updateObservation']); //Actualizar observación al seguimiento
        Route::put('/trackings/{id}/edit/status', [App\Http\Controllers\TrackingController::class, 'updateStatus']); // Actualizar el estado del seguimiento

        
    });

    // ROL: CLIENTE
    Route::middleware(['check.rol:2'])->prefix('cliente')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\ProjectController::class, 'index']); // dashboard - lista de proyectos

        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']); //listado
        
        Route::get('/projects/{id}/show', [App\Http\Controllers\ProcessController::class, 'index']); //Lista de tramites del proyecto seleccionado

    });

});

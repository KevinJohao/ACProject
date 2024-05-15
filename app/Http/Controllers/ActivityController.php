<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Process;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isEmployee()) {
            $processes = Process::whereHas('activities', function($query) use ($user){
                $query->where('employee_id', $user->employee->id)
                      ->where('status', true)
                      ->where('task_status_id', 1);
            })
            ->where('status', true) // filtrar los trámites con estado 1
            ->where('task_status_id', 1) // Filtrar los trámites con estado de tarea 1 (En proceso)
            ->withCount(['activities' => function ($query) use ($user){ //contar cuantas actividades tiene el trámite
                $query->where('employee_id', $user->employee->id)
                      ->where('status', true)
                      ->where('task_status_id', 1);                     
            }])->paginate(10);
        
            return view('employee.activities.index')->with(compact('processes'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showTrackingsEmployee(string $id)
    {
        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isEmployee()) {

            $activity = Activity::where('id', $id)
                                ->where('status', true)
                                ->firstOrFail();
            
            //Obtener los seguimientos asociados a la actividad y al empleado logeado
            $trackings = $activity->trackings()
                                    ->where('employee_id', $user->employee->id)
                                    ->where('status', true)
                                    //->where('task_status_id', 1)
                                    ->paginate(10);

            return view('employee.trackings.show')->with(compact('activity','trackings'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

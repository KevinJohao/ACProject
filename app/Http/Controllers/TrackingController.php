<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\TaskStatus;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexEmployee()
    {
        // Obtener el usuario logueado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isEmployee()) {
  
            $activities = Activity::whereHas('process', function($query){
                $query->where('status', true)
                      ->where('task_status_id', 1);
            })
            ->whereHas('trackings', function($query) use ($user) {
                $query->where('employee_id', $user->employee->id)
                      ->where('status', true)
                      ->where('task_status_id', 1);
            })
            ->where('status', true)
            ->where('task_status_id', 1)
            ->withCount(['trackings' => function ($query) use ($user) {
                $query->where('employee_id', $user->employee->id)
                      ->where('status', true)
                      ->where('task_status_id', 1);
            }])
            ->paginate(8);

         return view('employee.trackings.index')->with(compact('activities'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateObservation(Request $request, string $id)
    {
        $tracking = Tracking::find($id);
        $tracking->observation = $request->input('observation');
        $tracking->save();

        return redirect()->back()->with('success', 'La observación se ha actualizado correctamente.');
    }

    public function updateStatus(Request $request, string $id)
    {
        // Encuentra el registro de seguimiento por ID
        $tracking = Tracking::find($id);

        // Encuentra el estado por nombre
        $status = TaskStatus::where('name', $request->input('status'))->first();

        // Si el estado no existe, redirige con un mensaje de error
        if (!$status) {
            return redirect()->back()->with('error', 'El estado proporcionado no existe.');
        }

        // Actualiza el task_status_id con el ID del estado encontrado
        $tracking->task_status_id = $status->id;

        // Guarda los cambios en la base de datos
        $tracking->save();

        return redirect()->back()->with('success', 'El estado se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

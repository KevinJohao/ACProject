<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Process;
use App\Models\TypeActivity;
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

        // Admin
        if (auth()->user()->rol_id == 1) {
            $type_activities = TypeActivity::where('status', true)
                ->orderBy('created_at', 'desc')->paginate(10);

            return view('admin.activities.index')->with(compact('type_activities'));
        }

        if ($user->isEmployee()) {
            $projects = $user->employee->projects()->with(['processes.activities' => function ($query) {
                // Filtrar actividades con estado verdadero y con estado de tarea igual a 1
                $query->where('status', true)
                    ->where('task_status_id', 1);
            }, 'processes' => function ($query) {
                // Filtrar trámites con estado verdadero y con estado de tarea igual a 1
                $query->where('status', true)
                    ->where('task_status_id', 1);
            }])->paginate(10);

            return view('employee.activities.index')->with(compact('projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_activities = Activity::all();
        return view('admin.activities.create')->with(compact('type_activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre',
            'name.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripción',
            'description.min' => 'La descripción debe ser más extensa'
        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:10'
        ];

        $this->validate($request, $rules, $messages);
        $type_activity = new TypeActivity();
        $type_activity->name = $request->input('name');
        $type_activity->description = $request->input('description');
        $type_activity->save();

        return redirect('/admin/activities');
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

            //Obtener las actividades asociados al trámite
            $trackings = $activity->trackings()
                ->where('activity_id', $id)
                ->where('status', true)
                ->paginate(10);

            return view('employee.trackings.show')->with(compact('activity', 'trackings'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type_activity = TypeActivity::find($id);
        return view('admin.activities.edit')->with(compact('type_activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validar
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre',
            'name.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripción',
            'description.min' => 'La descripción debe ser más extensa'
        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:10'
        ];

        $this->validate($request, $rules, $messages);
        $type_activity = TypeActivity::find($id);
        $type_activity->name = $request->input('name');
        $type_activity->description = $request->input('description');
        $type_activity->save();

        return redirect('/admin/activities');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

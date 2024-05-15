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

        if ($user->isEmployee()) {
            $processes = Process::whereHas('activities', function ($query) use ($user) {
                $query->where('employee_id', $user->employee->id)
                    ->where('status', true)
                    ->where('task_status_id', 1);
            })
                ->where('status', true) // filtrar los trámites con estado 1
                ->where('task_status_id', 1) // Filtrar los trámites con estado de tarea 1 (En proceso)
                ->withCount(['activities' => function ($query) use ($user) { //contar cuantas actividades tiene el trámite
                    $query->where('employee_id', $user->employee->id)
                        ->where('status', true)
                        ->where('task_status_id', 1);
                }])->paginate(10);

            return view('employee.activities.index')->with(compact('processes'));
        } elseif ($user->isAdmin()) {
            $type_activities = TypeActivity::where('status', true)
                ->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.type_activities.index')->with(compact('type_activities'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_activities = TypeActivity::all();
        return view('admin.type_activities.create')->with(compact('type_activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $type_activity->status = true;
        $type_activity->save();

        return redirect('/admin/type_activities');
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

            return view('employee.trackings.show')->with(compact('activity', 'trackings'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type_activity = TypeActivity::find($id);
        return view('admin.type_activities.edit')->with(compact('type_activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
        $type_activity->status = true;
        $type_activity->save();

        return redirect('/admin/type_activities');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type_activity = TypeActivity::find($id);
        $type_activity->status = false;
        $type_activity->save();

        return redirect('/admin/type_activities');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Project;
use App\Models\TaskStatus;
use App\Models\TypeProcess;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        /*** Direccionar al view show del proyecto de cada tipo de usuario ***/
        // Admin
        if (auth()->user()->rol_id == 1) {
            // Asume que tienes una relación 'processes' en tu modelo Project
            $processes = Project::find($id)->processes()->paginate(10);
            $task_statuses = TaskStatus::all();
            return view('admin.projects.show')->with(compact('processes', 'task_statuses'));
        }

        // Empleado
        if ($user->isEmployee()) {

            $project = Project::where('id', $id)
                ->where('status', true)
                ->firstOrFail();

            $processes = $project->processes()
                ->where('status', true)
                ->paginate(8);

            return view('employee.projects.show')->with(compact('project', 'processes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Formulario de registro
        $type_processes = Process::all();
        return view('admin.processes.create')->with(compact('type_processes'));
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
        $type_process = new TypeProcess();
        $type_process->name = $request->input('name');
        $type_process->description = $request->input('description');
        $type_process->save();

        return redirect('/admin/processes');
    }

    public function showActivitiesEmployee(string $id)
    {
        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isEmployee()) {

            $process = Process::where('id', $id)
                ->where('status', true)
                ->firstOrFail();

            //Obtener las actividades asociados al trámite y al empleado logeado
            $activities = $process->activities()
                ->where('employee_id', $user->employee->id)
                ->where('status', true)
                ->where('task_status_id', 1)
                ->paginate(5);

            return view('employee.activities.show')->with(compact('process', 'activities'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $process = Process::find($id);
        $task_statuses = TaskStatus::all();
        $type_processes = $process->typeProcess();
        return view('admin.processes.edit')->with(compact('process', 'task_statuses', 'type_processes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validar
        $messages = [
            'vsm.required' => 'Es necesario ingresar el vsm',
            'vsm.min' => 'El vsm debe tener un mínimo de 3 caracteres',
            'next_review.required' => 'Es necesario ingresar una fecha para la próxima revisión',
            'process_value.required' => 'Es necesario ingresar un valor',
            'process_value.numeric' => 'El valor debe ser mayor numerico',
            'process_value.min' => 'El valor debe ser mayor a 0 ',
        ];
        $rules = [
            'vsm' => 'required|min:3',
            //'next_review' => ['required, new AfterOneWeek'],
            'next_review' => 'required',
            'process_value' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        $process = Process::find($id);
        $process->type_process_id = $request->input('type_process_id');
        $process->vsm = $request->input('vsm');
        $process->next_review = $request->input('next_review');
        $process->process_value = $request->input('process_value');
        $process->task_status_id = $request->input('task_status_id');
        $process->save();

        return redirect('/admin/processes/' . $process->project->id . '/show');
        //return redirect()->route('admin.processes.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

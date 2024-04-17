<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Project;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el ID del usuario logeado
        $userId = auth()->id();

        // Direccionar al index de cada tipo de usuario
        if (auth()->user()->rol_id == 1) {
            $processes = Process::paginate(10);
            return view('admin.processes.index')->with(compact('processes'));
        }

        if (auth()->user()->rol_id == 3) {
            //Filtrar los proyectos por el ID del usuario logeado
            $processes = Process::where('user_id', $userId)->paginate(10);
            return view('employee.processes.index')->with(compact('processes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Formulario de registro
        $processes = Process::all();
        return view('admin.processes.create')->with(compact('processes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        $process = new Process();
        $process->vsm = $request->input('vsm');
        $process->next_review = $request->input('next_review');
        $process->process_value = $request->input('process_value');
        $process->project_id = $request->input('project_id');
        $process->type_process_id = $request->input('type_process_id');
        $process->task_status_id = $request->input('task_status_id');
        $process->save();

        return redirect('/admin/processes');
    }

    public function show(string $id)
    {
        // Asume que tienes una relación 'processes' en tu modelo Project
        $processes = Project::find($id)->processes()->paginate(10);
        return view('admin.projects.show')->with(compact('processes'));
    }

    public function showProcesses(string $id)
    {
        // Asume que tienes una relación 'typeProcess' en tu modelo Process
        $processes = Project::find($id)->processes()->paginate(10);
        return view('admin.processes.show')->with(compact('processes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $process = Process::find($id);
        return view('admin.processes.edit')->with(compact('process'));
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
        $process->vsm = $request->input('vsm');
        $process->next_review = $request->input('next_review');
        $process->process_value = $request->input('process_value');

        return redirect('/admin/processes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

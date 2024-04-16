<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
            $projects = Project::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.projects.index')->with(compact('projects'));
        }

        if (auth()->user()->rol_id == 3) {
            //Filtrar los proyectos por el ID del usuario logeado
            $projects = Project::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(10);
            return view('employee.projects.index')->with(compact('projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        //Formulario de registro
        return view('admin.projects.create')->with(compact('users'));;
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
            'place.required' => 'Es necesario ingresar el lugar',
            'place.min' => 'El lugar debe tener un mínimo de 3 caracteres',
            'start_date.required' => 'Es necesario ingresar una fecha de inicio',
            'due_date.required' => 'Es necesario ingresar una fecha de entrega',
            'total_value.required' => 'Es necesario ingresar un precio',
            'total_value.numeric' => 'El precio debe ser mayor numerico',
            'total_value.min' => 'El precio debe ser mayor a 0 ',
        ];
        $rules = [
            'name' => 'required|min:3',
            'place' => 'required|min:3',
            'start_date' => 'required',
            'due_date' => 'required',
            'total_value' => 'required|numeric|min:0'
        ];

        $this->validate($request, $rules, $messages);
        $project = new Project();
        $project->name = $request->input('name');
        $project->place = $request->input('place');
        $project->start_date = $request->input('start_date');
        $project->due_date = $request->input('due_date');
        $project->total_value = $request->input('total_value');
        // $project->status = $request->input('status');
        $project->save(); //Insert


        return redirect('/admin/projects');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        // Direccionar al index de cada tipo de usuario
        if (auth()->user()->rol_id == 1) {
            return view('admin.projects.show')->with(compact('project'));
        }

        if (auth()->user()->rol_id == 3) {
            return view('employee.projects.show')->with(compact('project'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        //formulario de edicion
        $project = Project::find($id);
        $client_id = $project->user_id; // Se obtiene el id del cliente actual
        return view('admin.projects.edit')->with(compact('project', 'users', 'client_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Editar
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre',
            'name.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'name.required' => 'Es necesario ingresar el nombre',
            'name.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'total_value.required' => 'Es necesario ingresar un precio',
            'total_value.numeric' => 'El precio debe ser mayor numerico',
            'total_value.min' => 'El precio debe ser mayor a 0 ',
        ];
        $rules = [
            'name' => 'required|min:3',
            'place' => 'required|min:3',
            'total_value' => 'required|numeric|min:0'
        ];

        $this->validate($request, $rules, $messages);
        $project = Project::find($id);
        $project->name = $request->input('name');
        $project->place = $request->input('place');
        $project->start_date = $request->input('start_date');
        $project->due_date = $request->input('due_date');
        $project->total_value = $request->input('total_value');
        $project->user_id = $request->input('client');
        $project->save();
        // $project->status = $request->input('status');

        return redirect(('/admin/projects'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $project = Project::find($id);

        // Eliminar los tramites del proyecto primero
        foreach ($project->tramite as $tramite) {
            $tramite->delete();
        }

        // Ahora puedes eliminar el proyecto
        $project->delete();

        return back();
    }
}

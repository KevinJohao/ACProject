<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Project list
        $projects = Project::paginate(10);
        return view('admin.projects.index')->with(compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Formulario de registro
        return view('admin.projects.create');
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
        $project = new Project();
        $project->name = $request->input('name');
        $project->place = $request->input('place');
        $project->start_date = $request->input('start_date');
        $project->due_date = $request->input('due_date');
        $project->total_value = $request->input('total_value');
        // $project->status = $request->input('status');

        return redirect(('/admin/projects'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $project = Project::find($id);
        return view('admin.projects.show')->with(compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //formulario de edicion
        $project = Project::find($id);
        return view('admin.projects.edit')->with(compact('project'));
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

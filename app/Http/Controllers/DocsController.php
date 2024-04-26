<?php

namespace App\Http\Controllers;

use App\Models\TypeDocs;
use App\Models\TypeProcess;
use Illuminate\Http\Request;

class DocsController extends Controller
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
            $documents = Typedocs::where('status', true)
                ->orderBy('created_at', 'desc')->paginate(10);

            return view('admin.docs.index')->with(compact('documents'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Formulario de registro
        $documents = TypeDocs::all();
        $type_processes = TypeProcess::all();
        return view('admin.docs.create')->with(compact('documents', 'type_processes'));
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
        $document = new TypeDocs();
        $document->name = $request->input('name');
        $document->description = $request->input('description');
        $document->status = true;
        $document->type_process_id = $request->input('type_process_id');
        $document->save();

        return redirect('/admin/processes');
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

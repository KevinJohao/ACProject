<?php

namespace App\Http\Controllers;

use App\Models\TypeProcess;
use Illuminate\Http\Request;

class TypeProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
            /** @var \App\Models\User $user **/

            // Obtener el ID del usuario logeado
            $user = auth()->user();

            /*** Direccionar al view index de cada tipo de usuario ***/
            // Admin
            if (auth()->user()->rol_id == 1) {
                $type_processes = TypeProcess::where('status', true)
                    ->orderBy('created_at', 'desc')->paginate(10);

                return view('admin.type_processes.index')->with(compact('type_processes'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_processes = TypeProcess::all();
        return view('admin.type_processes.create')->with(compact('type_processes'));
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
        $document = new TypeProcess();
        $document->name = $request->input('name');
        $document->description = $request->input('description');
        $document->status = true;
        $document->save();

        return redirect('/admin/type_processes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isAdmin()) {
            $type_process = TypeProcess::where('id', $id)
                ->where('status', true)
                ->firstOrFail();

            $type_documents = $type_process->typeDocs()
                ->where('type_process_id', $id)
                ->where('status', true)
                ->paginate(10);

            return view('admin.type_processes.show')->with(compact('type_process', 'type_documents'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $type_process = TypeProcess::find($id);
        return view('admin.type_processes.edit')->with(compact('type_process'));
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
        $type_process = TypeProcess::find($id);
        $type_process->name = $request->input('name');
        $type_process->description = $request->input('description');
        $type_process->status = true;
        $type_process->save();

        return redirect('/admin/type_processes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type_process = TypeProcess::find($id);
        $type_process->status = false;
        $type_process->save();

        return redirect('/admin/type_processes');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\TypeDocs;
use App\Models\TypeProcess;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        // Obtener el ID del usuario logeado
        $userId = auth()->id();

        // Direccionar al index de cada tipo de usuario
        if (auth()->user()->rol_id == 1) {
            $type_process = TypeProcess::where('id', $id)
                ->where('status', true)
                ->firstOrFail();

            //Obtener los typeDocs asociados a typeProcess
            $documents = $type_process->typeDocs()
                ->where('process_id', $id)
                ->where('status', true)
                ->paginate(10);

            return view('admin.docs.index')->with(compact('documents', 'type_process'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createOnProcess($id)
    {
        //Formulario de registro
        $documents = TypeDocs::all();
        $type_process = TypeProcess::find($id);
        $type_processes = TypeProcess::all();
        return view('admin.docs.create')->with(compact('documents', 'type_process', 'type_processes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeOnProcess(Request $request)
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
        $document->type_process_id = $request->input('type_process_id');
        $document->save();

        return redirect('/admin/type_processes/' . $document->typeProcess->id . '/show');
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
        //
        $document = TypeDocs::find($id);
        $type_processes = TypeProcess::all();
        return view('admin.docs.edit')->with(compact('document', 'type_processes'));
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
        $document = TypeDocs::find($id);
        $document->name = $request->input('name');
        $document->description = $request->input('description');
        $document->status = true;
        $document->save();

        return redirect('/admin/type_processes/' . $document->typeProcess->id . '/show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = TypeDocs::find($id);
        $document->status = false;
        $document->save();

        return redirect('/admin/type_processes/' . $document->typeProcess->id . '/show');
    }
}

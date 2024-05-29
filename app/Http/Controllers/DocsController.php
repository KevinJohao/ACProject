<?php

namespace App\Http\Controllers;

use App\Models\generalDocument;
use App\Models\Process;
use App\Models\ProcessDocs;
use App\Models\TypeDocs;
use App\Models\TypeProcess;
use Google\Service\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Masbug\Storage\GoogleDrive;
use Google\Service\Drive\DriveFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\EventListener\StreamedResponseListener;

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

    public function clientIndex(){

        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        $general_docs = $user->client->generalDocuments()
            ->orderBy('id', 'desc') // Ordenar por ID de forma descendente
            ->paginate(5);
        return view('clients.docs.index')->with(compact('general_docs'));
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

    public function showProcessDocs($id) {

        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isClient()) {
            $process = Process::where('id', $id)
                ->where('status', true)
                ->firstOrFail();
            
            $process_docs = $process->processDocs()
                ->where('status', true)
                ->paginate(10);

            return view('clients.docs.show')->with(compact('process', 'process_docs'));
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

    /**      ********************************      */
    /** CARGA DE ARCHIVOS POR EL CLIENTE */
    /**                                            */
    public function clientDocUpload(Request $request){

        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        
        // Obtener el archivo del formulario
        $file=$request->file('file');
        // Obtener el nombre original del documento
        $name = $file->getClientOriginalName();

        // Guardar archivo en Google Drive
        //$filePath = Storage::disk('google')->putFileAs('/', $file, $name);
        $uploaded = Storage::disk('google')->put($name, file_get_contents($file));

        // Obtener el cliente de Google Drive del contenedor de servicios
        $service = app('googleDriveService');
        
        // Buscar el archivo subido para obtener su ID
        $response = $service->files->listFiles([
            'q' => "name='{$name}' and trashed=false",
            'fields' => 'files(id, name)'
        ]);

        if (count($response->files) == 0) {
            return back()->with('error', 'Error al subir el archivo.');
        }
    
        // Obtener el ID del archivo
        $fileId = $response->files[0]->id;

        // Guardar en la base de datos
        if($uploaded){
        $document = new generalDocument();
        $document->name = $name;
        $document->description = $request->input('description');
        $document->fileId = $fileId;
        $document->client_id = $user->client->id;
        $document->save();
        
        return redirect()->back()->with('success', 'El archivo se ha registrado correctamente.');
        }else{
            return response('Fallo al cargar el archivo');
        }
        
    }

    public function clientDocDownload($fileId){

        // Obtener el cliente de Google Drive desde el contenedor de servicios
        $service = app('googleDriveService');
        
        // Obtener los metadatos del archivo
        $metadata = $service->files->get($fileId);

        // Obtener el nombre del archivo de los metadatos
        $fileName = $metadata->getName();

        // Descargar el archivo usando su ID
        $file = $service->files->get($fileId, ['alt' => 'media']);

        // Obtener el contenido del archivo
        $fileContents = $file->getBody()->getContents();

        // Respuesta HTTP
         return response($fileContents, 200)
        ->header('Content-Type', 'application/octet-stream')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');

    }

    public function clientDocDelete($fileId){

        // Obtener el cliente de Google Drive desde el contenedor de servicios
        $service = app('googleDriveService');

        // Eliminar el archivo por su ID
        $service->files->delete($fileId);

        // Eliminar el registro en la base de datos
        GeneralDocument::where('fileId', $fileId)->delete();

        return redirect()->back()->with('success', 'El archivo se ha eliminado correctamente.');
        
    }
}

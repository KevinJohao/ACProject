<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{

    /*
    private function token (){
        $client_id = \Config('services.google.client_id');
        $client_secret = \Config('services.google.client_secret');
        $refresh_token = \Config('services.google.refresh_token');
        $response = Http::post('https://oauth2.googleapis.com/token',[
            'client_id'=>$client_id,
            'client_secret'=>$client_secret,
            'refresh_token'=>$refresh_token,
            'grant_type'=> 'refresh_token',
        ]);

        $accessToken=json_decode((string)$response->getBody(), true)['access_token'];
        return $accessToken;
    }
    */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /*
    public function store(Request $request)
    {
        $validation=$request->validate([
            'file'=>'required',
            'file_name'=> 'required'
        ]);

        $accessToken=$this->token();
        $file=$request->file('file');
        $name=$file->getClientOriginalName();
        //$mime=$request->file->getClientMimeType();
        $path=$file->getRealPath();

        $folderId = \Config('services.google.folder_id');

        $response=Http::withToken( $accessToken)
            ->attach('data', file_get_contents($path), $name)
            ->post('https://www.googleapis.com/upload/drive/v3/files',
                [
                    'name'=>$name,
                    //'parents' => [$folderId]
                ],
                [
                    'Content-Type'=>'application/octet-stream'
                ]
                );

        if ($response->successful()) {
            
            return response('Archivo cargado a google drive');
        }else{
            return response('Fallo en la carga de archivo');
        }
    }
    */

    public function store(Request $request){

        $file=$request->file('file');

        $name = $file->getClientOriginalName();
        $path = $file->getRealpath();
        Storage::disk('google')->put($name, file_get_contents($file));
        
        return redirect()->back();
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

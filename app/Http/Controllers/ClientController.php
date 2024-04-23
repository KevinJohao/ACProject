<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
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
            $clients = Client::where('status', true)
                ->orderBy('created_at', 'desc')->paginate(10);

            return view('admin.clients.index')->with(compact('clients'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        //Formulario de registro
        return view('admin.clients.create')->with(compact('users'));;
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
            'work_place.required' => 'Es necesario ingresar el lugar',
            'work_place.min' => 'El lugar debe tener un mínimo de 3 caracteres',
        ];
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'phone' => 'required|min:10',
            'email' => 'required|',
            'password' => 'required|min:8',
            'work_place' => 'required|min:3',
        ];
        // Primero, crea un nuevo usuario.
        $user = new User();
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->rol_id = 2; // Rol predeterminado
        $user->save();

        // Luego, crea un nuevo cliente con el mismo ID que el usuario.
        $client = new Client();
        $client->id = $user->id; // Asegúrate de que 'id' es fillable en Client.
        $client->user_id = $user->id; // Asigna el ID del usuario a 'user_id'.
        $client->work_place = $request->input('work_place');
        $client->save(); //Insert

        return redirect('/admin/clients');
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

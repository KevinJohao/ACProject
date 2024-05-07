<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
            $employees = Employee::where('status', true)
                ->orderBy('created_at', 'desc')->paginate(10);

            return view('admin.employees.index')->with(compact('employees'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.employees.create')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar
        $messages = [
            'name.required' => 'Es necesario ingresar los nombres',
            'name.min' => 'Los nombres debe tener un mínimo de 3 caracteres',
            'lastname.required' => 'Es necesario ingresar los apellidos',
            'lastname.min' => 'Los apellidos debe tener un mínimo de 3 caracteres',
            'phone.required' => 'Es necesario ingresar un número de teléfono',
            'phone.min' => 'Es necesario ingresar un número de teléfono',
            'phone.numeric' => 'Es necesario ingresar un número de teléfono',
            'email.required' => 'Es necesario ingresar un correo no duplicado',
            'email.email' => 'Es necesario ingresar un correo válido',
            'password.required' => 'Es necesario ingresar una contraseña',
            'password.email' => 'La contraseña debe tener un mínimo de 8 caracteres'
        ];
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $this->validate($request, $rules, $messages);
        // Primero, crea un nuevo usuario.
        $user = new User();
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->rol_id = 3; // Rol predeterminado
        $user->save();

        // Luego, crea un nuevo cliente con el mismo ID que el usuario.
        $employee = new Employee();
        $employee->id = $user->id; // Asegúrate de que 'id' es fillable en employee.
        $employee->user_id = $user->id; // Asigna el ID del usuario a 'user_id'.
        $employee->save(); //Insert

        return redirect('/admin/employees');
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
        $employees = Employee::find($id);
        return view('admin.employees.edit')->with(compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validar
        $messages = [
            'name.required' => 'Es necesario ingresar los nombres',
            'name.min' => 'Los nombres debe tener un mínimo de 3 caracteres',
            'lastname.required' => 'Es necesario ingresar los apellidos',
            'lastname.min' => 'Los apellidos debe tener un mínimo de 3 caracteres',
            'phone.required' => 'Es necesario ingresar un número de teléfono',
            'phone.min' => 'Es necesario ingresar un número de teléfono',
            'phone.numeric' => 'Es necesario ingresar un número de teléfono',
            'email.required' => 'Es necesario ingresar un correo no duplicado',
            'email.email' => 'Es necesario ingresar un correo válido',
            'password.required' => 'Es necesario ingresar una contraseña',
            'password.email' => 'La contraseña debe tener un mínimo de 8 caracteres'
        ];
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            // 'password' => 'required|min:8'
        ];
        $this->validate($request, $rules, $messages);
        // Primero, encuentra el usuario existente.
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        // $user->password = $request->input('password');
        $user->save();

        return redirect('/admin/employees');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->status = false;
        $employee->save();

        return redirect('/admin/employees');
    }
}

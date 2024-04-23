<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Process;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el ID del usuario logeado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isEmployee()) {

            $process = Process::where('id', $id)
                                ->where('status', true)
                                ->firstOrFail();
            
            //Obtener las actividades asociados al trámite
            $activities = $user->employee->activities()
                                    ->where('process_id', $id)
                                    ->where('status', true)
                                    ->paginate(10);

            return view('employee.processes.show')->with(compact('process','activities'));
        }
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

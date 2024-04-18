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
        $process = Process::where('id', $id)
            ->where('status', true)
            ->firstOrFail();
        //Obtener las actividades asociados al trámite
        $activities = $process->activities()->paginate(10);
        return view('employee.activities.index')->with(compact('activities'));
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

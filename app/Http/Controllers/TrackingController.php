<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexEmployee()
    {
        // Obtener el usuario logueado
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if ($user->isEmployee()) {
  
            $activities = Activity::whereHas('process', function($query){
                $query->where('status', true)
                      ->where('task_status_id', 1);
            })
            ->whereHas('trackings', function($query) use ($user) {
                $query->where('employee_id', $user->employee->id)
                      ->where('status', true)
                      ->where('task_status_id', 1);
            })
            ->where('status', true)
            ->where('task_status_id', 1)
            ->withCount(['trackings' => function ($query) use ($user) {
                $query->where('employee_id', $user->employee->id)
                      ->where('status', true)
                      ->where('task_status_id', 1);
            }])
            ->paginate(10);

         return view('employee.trackings.index')->with(compact('activities'));
        }

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

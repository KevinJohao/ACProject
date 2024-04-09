<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    protected function redirectTo()
    {
        if (auth()->user()->rol_id == 1) {
            return view('admin.dashboard');
        }

        return view('/');
    }

    protected function dashboardAdmin()
    {
        return view('admin.dashboard');
    }
}

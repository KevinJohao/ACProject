<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/login';

    protected function redirectTo()
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user->isAdmin()) {
            return '/admin/dashboard';
        } elseif ($user->isClient()) {
            return '/cliente/dashboard';
        } elseif ($user->isEmployee()) {
            return '/empleado/dashboard';
        } else {
            // Default redirect path for users without a valid role
            return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

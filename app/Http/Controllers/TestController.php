<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        //$products = Product::all();
        //return view('auth.welcome')->with(compact('products'));
        return view('auth.login');
    }
}

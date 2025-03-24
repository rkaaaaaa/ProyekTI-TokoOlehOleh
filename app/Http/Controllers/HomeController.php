<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
     * Show the application dashboard.
     */
    public function welcome()
    {
        return view('home');
    }
}

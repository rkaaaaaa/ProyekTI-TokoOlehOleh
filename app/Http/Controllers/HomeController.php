<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function welcome()
    {
        $testimonis = Testimoni::latest('tanggalTestimoni')->take(4)->get();
        return view('home', compact('testimonis'));
    }
}

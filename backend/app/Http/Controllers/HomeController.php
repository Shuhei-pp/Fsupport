<?php

namespace App\Http\Controllers;

//Models
use App\Models\Area;
use App\Models\Bigarea;


use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $areas = Area::all();
        $bigareas = Bigarea::all();
        return view('home',compact('areas','bigareas'));
    }
}

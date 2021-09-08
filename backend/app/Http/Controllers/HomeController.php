<?php

namespace App\Http\Controllers;

use App\Models\Area;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $area_info = Area::all();
        return view('home',[
            "area_info" => $area_info
        ]);
    }
}

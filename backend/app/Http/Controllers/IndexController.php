<?php

namespace App\Http\Controllers;

use App\Models\Area;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $area_info = Area::all();
        return view('Index',[
            "area_info" => $area_info
        ]);
    }
}

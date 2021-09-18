<?php

namespace App\Http\Controllers;

//Models
use App\Models\Area;
use App\Models\Bigarea;

//Auth
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function editArea()
    {
        //管理者じゃなかった場合はエラーページを返す
        if(Auth::check() && Auth::user()->admin){
            return view('area.edit');
        }
        return view('error.admin');
    }

    public function index()
    {
        $areas = Area::all();
        $bigareas = Bigarea::all();
        return view('home',compact('areas','bigareas'));
    }
}

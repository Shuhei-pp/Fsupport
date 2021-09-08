<?php

namespace App\Http\Controllers;
use App\Services\GetWeather;
use App\Services\GetTide;
use App\Services\BiCulculation;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index($area_zip){

        $weather = new GetWeather();
        $weather_info = $weather->index($area_zip); 

        $tide = new GetTide();
        $tide_info = $tide->index();
        $Bi = new BiCulculation();
        $Bi->index($weather_info);
        return view('area_index',[
            "weather_info" => $weather_info
        ]);
    }
}

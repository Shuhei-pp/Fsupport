<?php

namespace App\Http\Controllers;
use App\Services\GetWeather;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index($area_zip){
        $weather = new GetWeather();
        $weather_info = $weather->index($area_zip); 
        return view('area_index',[
            "weather_info" => $weather_info
        ]);
    }
}

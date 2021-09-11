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
        $weather_info = $weather->getWeatherJson($area_zip); 
        $tide = new GetTide();
        $tide_info = $tide->getTideJson();

        $Bi = new BiCulculation();
        $tide_heights = $Bi->index($weather_info,$tide_info);
        return view('area',compact('weather_info','tide_heights'));
    }
}

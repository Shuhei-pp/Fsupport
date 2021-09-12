<?php

namespace App\Http\Controllers;

use App\Models\Area;

use App\Services\GetWeather;
use App\Services\GetTide;
use App\Services\BiCulculation;


use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index($area_id){

        $area = Area::find($area_id);

        $weather = new GetWeather();
        $weather_info = $weather->getWeatherJson($area->area_zip);


        $tide = new GetTide();
        $tide_info = $tide->getTideJson($area_id);

        $tide_heights = $tide->setTide($tide_info);
        return view('area',compact('weather_info','tide_heights'));
    }
}

<?php

namespace App\Http\Controllers;

//Models
use App\Models\Area;

// Services
use App\Services\GetWeather;
use App\Services\GetTide;
use App\Services\FiCulculation;


use Illuminate\Http\Request;

class AreaController extends Controller
{

    /**
     * エリア別のページを表示
     *
     * @param interger $area_id
     * return view
     */
    public function index($area_id){

        $area = Area::find($area_id);

        $weather = new GetWeather();
        $weather_info = $weather->getWeatherJson($area->area_zip);


        $tide = new GetTide();
        $tide_info = $tide->getTideJson($area_id);

        $tide_heights = $tide->setTide($tide_info);

        $fi = FiCulculation::setFi($weather_info,$tide_heights);

        return view('area',compact('weather_info','tide_heights','fi'));
    }
}

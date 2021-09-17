<?php

namespace App\Http\Controllers;

//Models
use App\Models\Area;

// Services
use App\Services\GetWeather;
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

        $weather = new GetWeather($area_id);

        $info = $weather->setInfo();

        return view('area',compact('info'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Services\GetWeather;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $weather = new GetWeather();
        $city_zip = "950-2102,jp";
        $weather_info = $weather->index($city_zip);
        return view('home',[
            "weather_info" => $weather_info
        ]);
    }
}

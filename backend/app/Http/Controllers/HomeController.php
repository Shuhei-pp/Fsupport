<?php

namespace App\Http\Controllers;
use App\Services\GetWeather;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $weather = new GetWeather();
        $weather_info = $weather->index();
        $current_weather = $weather_info->weather[0]->main;
        return view('home',[
            "current_weather" => $current_weather
        ]);
    }
}

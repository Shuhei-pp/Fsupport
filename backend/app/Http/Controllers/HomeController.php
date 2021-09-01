<?php

namespace App\Http\Controllers;
use App\Services\GetWeather;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $weather = new GetWeather();
        $weather->index();
        return view('home');
    }
}

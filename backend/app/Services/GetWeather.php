<?php
namespace App\Services;

class GetWeather
{
  public function index()
  {
    $city_zip = "950-2102,jp";
    $url = "http://api.openweathermap.org/data/2.5/weather?zip=".$city_zip."&units=metric&APPID=".$apiid;

    $response = file_get_contents($url);
    echo $response;
  }
}

?>
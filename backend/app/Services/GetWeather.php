<?php
namespace App\Services;

//Services
use App\Services\GetApiContents;

class GetWeather
{
  public function getWeatherJson($city_zip)
  {
    $apiid = config('app.weather_app_id');
    $url = "http://api.openweathermap.org/data/2.5/forecast?zip=".$city_zip."&units=metric&APPID=".$apiid;

    $response = GetApiContents::tryGetContents($url);
    return $response;
  }
}

?>
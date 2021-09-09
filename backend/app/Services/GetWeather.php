<?php
namespace App\Services;

class GetWeather
{
  public function index($city_zip)
  {
    $apiid = env('WEATHER_APP_Id');
    $url = "http://api.openweathermap.org/data/2.5/forecast?zip=".$city_zip."&units=metric&APPID=".$apiid;

    $response = file_get_contents($url);
    $response = mb_convert_encoding($response,'UTF8','ASCII,JIS,UTF-8');
    $decord_response = json_decode($response);
    return $decord_response;
  }
}

?>
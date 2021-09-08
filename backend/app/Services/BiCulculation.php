<?php
namespace App\Services;

class BiCulculation
{
  public function index($weather_info){
    $BI[0] = $weather_info->cod;
    echo $BI[0];
  }
}
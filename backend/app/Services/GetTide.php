<?php

namespace App\Services;

class GetTide
{
  public function index(){
    $prefecture_code = "15";
    $harbor_code = "13";
    $y = date("Y");
    $m = date("m");
    $d = date("d");
    $term = "week";
 
    $url = "https://api.tide736.net/get_tide.php?pc=".$prefecture_code."&hc=".$harbor_code."&yr=".$y."&mn=".$m."&dy=".$d."&rg=".$term;
    
    $response = file_get_contents($url);
    $response = mb_convert_encoding($response,'UTF8');
    $decord_response = json_decode($response);
    return $decord_response;
  
  }
}
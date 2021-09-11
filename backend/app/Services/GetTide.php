<?php

namespace App\Services;

class GetTide
{
  public function getTideJson(){
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

  public function setTide($weather_info,$tide_info)
  {
    date_default_timezone_set('Asia/Tokyo');
    $today = date("Y-m-d");
    $tomorrow = date("Y-m-d", strtotime('+1 day'));

    /*APIの海面の高さが20分ごとで配列にされているので、
    3時間ごとで得られるように、$factorに9をセットしておく*/
    $factor = 9;

    $start_tide_time = round(date("G")/3)+1;

    $counts_assign = 0;

    //apiで得た潮の干満(cm)を$every_3hour_tideにセット
    for($i=$start_tide_time;$i<=$start_tide_time+7;$i++){
      $every_3hour_tide[] = $tide_info->tide->chart->$today->tide[$i*$factor]->cm;
      $counts_assign++;
      if($i>7)
        break;
    }

    for($i=1;$i<=8-$counts_assign;$i++)
      $every_3hour_tide[] = $tide_info->tide->chart->$tomorrow->tide[$i*$factor]->cm;

    return $every_3hour_tide;
  }
}
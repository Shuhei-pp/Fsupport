<?php
namespace App\Services;

class BiCulculation
{
  public function index($weather_info,$tide_info)
  {
    $today = date("Y-m-d");
    //APIの海面の高さが20分ごとで配列にされているので、
    //3時間ごとで得られるように、$factorに9をセットしておく
    $factor = 9;

    $tide = $tide_info->tide->chart->$today;
    //apiで得た潮の干満(cm)を$every_3hour_tideにセット
    for($i=1;$i<=8;$i++){
      $every_3hour_tide[] = $tide->tide[$i*$factor]->cm;
    }

    return $every_3hour_tide;
  }
}
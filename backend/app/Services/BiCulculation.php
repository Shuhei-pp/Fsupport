<?php
namespace App\Services;

class BiCulculation
{
  public function index($weather_info,$tide_info)
  {
    date_default_timezone_set('Asia/Tokyo');
    $today = date("Y-m-d");
    /*APIの海面の高さが20分ごとで配列にされているので、
    3時間ごとで得られるように、$factorに9をセットしておく*/
    $factor = 9;

    $start_time = date("G:i:s");
    var_dump($start_time);

    //apiで得た潮の干満(cm)を$every_3hour_tideにセット
    for($i=1;$i<=8;$i++){
      $every_3hour_tide[] = $tide_info->tide->chart->$today->tide[$i*$factor]->cm;
    }

    return $every_3hour_tide;
  }
}
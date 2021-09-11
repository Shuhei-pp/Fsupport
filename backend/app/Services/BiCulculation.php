<?php
namespace App\Services;

class BiCulculation
{
  public function index($weather_info,$tide_info)
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
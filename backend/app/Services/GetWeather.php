<?php
namespace App\Services;

//Services
use App\Services\GetApiContents;

//Models
use App\Models\Area;
class GetWeather
{
  /**
   * openweatherjsonを叩くためのパラメータを準備
   * 
   * @param integer $city_zip
   * return object $response
   */
  public static function getWeatherJson($city_zip)
  {
    $apiid = config('app.weather_app_id');
    $url = "http://api.openweathermap.org/data/2.5/forecast?zip=".$city_zip."&units=metric&APPID=".$apiid;

    $response = GetApiContents::tryGetContents($url);
    return $response;
  }

  /**
   * apiを叩くのに必要なパラメータを用意する
   * 
   * @param integer $area_id
   * return object $response
   */
  public static function getTideJson($area_id)
  {
    $prefecture_code = Area::find($area_id)->bigarea_id;
    $harbor_code = Area::find($area_id)->harbor_id;
    $y = date("Y");
    $m = date("m");
    $d = date("d");
    $term = "week";
 
    $url = "https://api.tide736.net/get_tide.php?pc=".$prefecture_code."&hc=".$harbor_code."&yr=".$y."&mn=".$m."&dy=".$d."&rg=".$term;

    $response = GetApiContents::tryGetContents($url);
    return $response;
  }

  /**
   * tideが配列ではなくオブジェクト型になっているので配列に変換
   * 
   * @param object $tide_info
   * return array $every_3hour_tide
   */
  public static function tideToArray($tide_info)
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

?>
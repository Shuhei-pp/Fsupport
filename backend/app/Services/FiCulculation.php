<?php
namespace App\Services;

class FiCulculation
{
 
  protected static $sunrise;
  protected static $sunset;
  protected static $ave_tide;

  /**
   * FiCulculation constructors
   * 
   * @param object $tide
   */
  public function __construct($tide_json)
  {
    $today = date("Y-m-d");
    self::$sunrise = $tide_json->tide->chart->$today->sun->rise;
    self::$sunset = $tide_json->tide->chart->$today->sun->set;
  }

  /**
   * 雲の%からpointを返すfiCloud関数
   * 
   * @param $tide
   */
  private static function fiCloud($clouds)
  {
    if($clouds <= 40){
      return 1.0;
    }
    if($clouds <= 80){
      return 1.1;
    }
    return 1.2;
  }

  /**
   * 潮の高さからtidepointを返すfiTide関数
   * 
   * @param $tide
   */
  private static function fiTide($tide)
  {
    $ave = self::$ave_tide;
    if($tide >= $ave+13){
      return 1.5;
    }
    if($tide >= $ave+6){
      return 1.2;
    }
    if($tide >= $ave){
      return 1;
    }
    return 0.9; 
  }

  /**
   * 日の出、日没の時間によって点数を返すfiSun関数
   * 
   * @param string $time
   */
  private static function fiSun($time)
  {
    //時刻から日の出と日の入りの時間を引き絶対値を求める
    $sr_diff = abs(strtotime($time)-strtotime(self::$sunrise));
    $ss_diff = abs(strtotime($time)-strtotime(self::$sunset));
    
    if ($sr_diff <= 3600 || $ss_diff <=3600)
    {
      return 5;
    }
    if ($sr_diff <= 7200 || $ss_diff <=7200)
    {
      return 4;
    }
    if ($sr_diff <= 10800 || $ss_diff <=10800)
    {
      return 3;
    }
    if ($sr_diff <= 14400 || $ss_diff <=14400)
    {
      return 2;
    }
    return 1;
  }

  /**
   * 月毎にポイントを返す
   * 
   * @param integer $month
   * return integer mix
   */
  private static function monthPoint($month)
  {
    if( 5<=$month && 11>$month)
    {
      return 3;
    }
    elseif( 3<=$month && 11>=$month )
    {
      return 2;
    }
    else
      return 1;
  }

  /**
   * 風の強さによって点数を返すfiWind関数
   * 
   * @param float $wind
   * return mixed
   */
  private static function fiWind($wind)
  {
    if($wind >= 5)
    {
      return 10/$wind;
    }
    elseif($wind >= 1)
    {
      $wind_p = (10/$wind) + 1;
      if($wind_p >= 10){
        return 10;
      }
      return $wind_p;
    }
    elseif ($wind <= 0)
    {
      return 0;
    } 
    else
    return 0;
  }

  /**
   * 釣果指数fiをセットする
   * 
   * @param object $weather
   * @param array $tide
   * 
   * return array $fi
   */
  public static function setFi($weather,$tide)
  {
    $repeat_times = count($tide);

    //クラス変数に潮の高さの平均を代入
    self::$ave_tide = array_sum($tide)/count($tide);

    //apiで得た潮の干満(cm)を$every_3hour_tideにセット
    for($i=0;$i<$repeat_times;$i++){
      //月を取り出し、ポイントへと変換
      $m = date('n', strtotime($weather->list[$i]->dt_txt));
      $mp = self::monthPoint($m);

      //windpointへ変換
      $wp = self::fiWind($weather->list[$i]->wind->speed);

      //時間を取り出してポイントに変換
      $time = date('H:i', strtotime($weather->list[$i]->dt_txt));
      $sp = self::fiSun($time);

      //tidepoint
      $tp = self::fiTide($tide[$i]);

      //cloudpoint
      $cp = self::fiCloud($weather->list[$i]->clouds->all);

      //81点満点なので100点満点にする
      $max81_fi = ($wp + $sp)* $tp * $mp * $cp;
      $fi[] = round($max81_fi*100/81,2);
    }
    return $fi;
  }
}
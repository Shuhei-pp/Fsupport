<?php
namespace App\Services;

class FiCulculation
{
 
  protected static $sunrise;
  protected static $sunset;

  /**
   * FiCulculation constructors
   * 
   * @param object $tide
   */
  public function __construct($tide)
  {
    $today = date("Y-m-d");
    self::$sunrise = $tide->tide->chart->$today->sun->rise;
    self::$sunset = $tide->tide->chart->$today->sun->set;
  }


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

    //apiで得た潮の干満(cm)を$every_3hour_tideにセット
    for($i=0;$i<$repeat_times;$i++){
      //月を取り出し、ポイントへと変換
      $m = date('n', strtotime($weather->list[$i]->dt_txt));
      $mp = self::monthPoint($m);

      //windpointへ変換
      $wp = self::fiWind($weather->list[$i]->wind->speed);
      $fi[] = round($mp * $wp,2);
    }
    return $fi;
  }
}
<?php
namespace App\Services;

class FiCulculation
{

  /**
   * 風の強さによって点数を返すfiWind関数
   */
  public static function fiWind($wind)
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
      $fi[] = round($tide[$i]*$weather->list[$i]->wind->speed);
      var_dump($weather->list[$i]->wind->speed);
      var_dump(round(self::fiWind($weather->list[$i]->wind->speed),2));
      echo '|';
    }

    return $fi;
  }
}
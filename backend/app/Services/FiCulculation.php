<?php
namespace App\Services;

class FiCulculation
{
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
    /**todo: この変数は結構使うので、他で定義したい*/
    $repeat_times = count($tide);

    //apiで得た潮の干満(cm)を$every_3hour_tideにセット
    for($i=0;$i<$repeat_times;$i++)
      $fi[] = round($tide[$i]*$weather->list[$i]->wind->speed);

    return $fi;
  }
}
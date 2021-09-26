<?php
namespace App\Services;

//Services
use App\Services\GetApiContents;
use App\Services\FiCulculation;

//Models
use App\Models\Area;

class GetWeather
{
  protected $area_id;
  public $data = [];
  public $temp = [];
  public $weather = [];
  public $tide = [];
  public $clouds = [];
  public $fi = [];

  /**
   * GetWeather Construction
   * 
   * @param int $area_id
   */
  public function __construct($area_id){
    $this->area_id = $area_id;
  }

  /**
   * openweatherjsonを叩くためのパラメータを準備
   * 
   * return object $response
   */
  public function getWeatherJson()
  {
    $city_zip = Area::find($this->area_id)->area_zip;
    $apiid = config('app.weather_app_id');
    $url = "http://api.openweathermap.org/data/2.5/forecast?lang=ja&zip=".$city_zip."&units=metric&APPID=".$apiid;

    $response = GetApiContents::tryGetContents($url);
    return $response;
  }

  /**
   * apiを叩くのに必要なパラメータを用意する
   * 
   * @param integer $area_id
   * return object $response
   */
  public  function getTideJson()
  {
    $prefecture_code = Area::find($this->area_id)->bigarea_id;
    $harbor_code = Area::find($this->area_id)->harbor_id;
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
   * return array $every_3hour_tide
   */
  public function tideToArray($tide_info)
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
      if($i>8)
      {
        break;
      }
      $every_3hour_tide[] = $tide_info->tide->chart->$today->tide[$i*$factor]->cm;
      $counts_assign++;
    }

    for($i=1;$i<=8-$counts_assign;$i++)
      $every_3hour_tide[] = $tide_info->tide->chart->$tomorrow->tide[$i*$factor]->cm;

    return $every_3hour_tide;
  }

  /**
   * 天気、潮の情報をオブジェクトにセット
   * 
   * return $this
   */
  public function setInfo()
  {
    //api呼び出し関数を呼び出し
    $weather = $this->getWeatherJson();
    $tide_json = $this->getTideJson();

    //fi計算するインスタンス作成
    $fi = new FiCulculation($tide_json);

    $tide = $this->tideToArray($tide_json);

    //fi計算
    $fi = $fi->setFi($weather,$tide);

    //インスタンスに天気情報を詰めていく
    for($i=0;$i<8;$i++){
      $timestamp = strtotime($weather->list[$i]->dt_txt)+32400;;
      $this->times[] = date("m月d日 H時",$timestamp);
      $this->weather[] = $weather->list[$i]->weather[0]->description;
      $this->temp[] = $weather->list[$i]->main->temp;
      $this->wind[] = $weather->list[$i]->wind->speed;
      $this->clouds[] = $weather->list[$i]->clouds->all;
      $this->tide[] = $tide[$i];
      $this->fi[] = $fi[$i];
    }
    return $this;
  }
}

?>
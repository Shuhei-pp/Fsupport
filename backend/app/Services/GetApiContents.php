<?php

namespace App\Services;

class GetApiContents
{

  /**
   * APIを叩く
   * 
   * @param string $url
   * return object $data
   */
  public static function tryGetContents($url)
  {
    try{
      if($data = @file_get_contents($url))
        return self::decodeToArr($data);
      else{
        throw new \Exception('ネットワーク環境を確認してください');
      }
    }catch(\Exception $e){
      abort(404);
    }
  }

  /**
   * 受けとったJSONデータを連想配列に変換
   * 
   * @param string $data
   * return object $decord_response
   */
  public static function decodeToArr($data){
    //読み取ったデータをutf8に変換
    $response = mb_convert_encoding($data,'UTF8','ASCII,JIS,UTF-8');
    //連想配列に変換
    $decord_response = json_decode($response);

    return $decord_response;
  }
}
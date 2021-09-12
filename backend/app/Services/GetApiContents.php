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
        return $data;
      else{
        throw new \Exception('ネットワーク環境を確認してください');
      }
    }catch(\Exception $e){
      abort(404);
    }
  }
}
<?php

namespace App\Http\Controllers;

//DB
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use stdClass;
use DateTime;

class SearchController extends Controller
{
    /**
     * サーチする択をAPIで返す
     * 
     * return object $option_object
     */
    public function getSearchOption()
    {
        $fish = DB::table('fish_kinds')->get();

        $areas = DB::table('areas')->get();

        $options_object = new stdClass();

        $options_object->fish = $fish;
        $options_object->areas = $areas;

        return $options_object;
    }

    /**
     * APIで絞り込んだ釣果一覧を取得。
     * 
     * @param Request $request
     * 
     * return array $frecords
     */
    public function searchFrecordLists(Request $request)
    {
        //絞り込む時刻を取得
        $occasion = new DateTime();
        if($request->occasion_number){
            $occasion_datetime = $occasion->modify('-'.$request->occasion_number.' week')->format('Y-m-d H:i:s');
        }else{
            //全データ取得時
            $occasion = 0;
            $occasion_datetime = date('Y-m-d H:i:s',$occasion);
        }


        $frecords = DB::table('fishingrecords')
                        ->select('fishingrecords.id as frecord_id','fishingrecords.*','areas.*','profiles.name','profiles.profile_image_name','frecord_fishs.fish_amount','fish_kinds.fish_name')
                        ->join('areas','fishingrecords.area_id','=','areas.id')
                        ->leftjoin('profiles','fishingrecords.user_id', '=','profiles.user_id')
                        ->leftjoin('frecord_fishs', 'fishingrecords.id', '=','frecord_fishs.frecord_id')
                        ->leftjoin('fish_kinds', 'frecord_fishs.fish_id', '=', 'fish_kinds.fish_id')
                        ->whereIn('fish_kinds.fish_id', $request->fish_id)//配列型で魚IDをリクエストパラメータで取得して絞り込み
                        ->whereIn('fishingrecords.area_id', $request->area_id)//エリアIDも同じく
                        ->where('fishingrecords.datetime','>=', $occasion_datetime)//時間の絞り込み
                        ->orderBy('datetime','desc')
                        ->get();
        return $frecords;
    }
}

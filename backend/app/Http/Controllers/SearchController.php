<?php

namespace App\Http\Controllers;

//DB
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use stdClass;

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
     * APIで釣果一覧を取得。絞り込みはフロントで行う。
     * 
     * return array $frecords
     */
    public function frecordLists()
    {
        $frecords = DB::table('fishingrecords')
                        ->select('fishingrecords.id as frecord_id','fishingrecords.*','areas.*','profiles.name','profiles.profile_image_name','frecord_fishs.fish_amount','fish_kinds.fish_name')
                        ->join('areas','fishingrecords.area_id','=','areas.id')
                        ->leftjoin('profiles','fishingrecords.user_id', '=','profiles.user_id')
                        ->leftjoin('frecord_fishs', 'fishingrecords.id', '=','frecord_fishs.frecord_id')
                        ->leftjoin('fish_kinds', 'frecord_fishs.fish_id', '=', 'fish_kinds.fish_id')
                        ->orderBy('datetime','desc')
                        ->get();
        return $frecords;
    }
}

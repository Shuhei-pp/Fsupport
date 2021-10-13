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
}

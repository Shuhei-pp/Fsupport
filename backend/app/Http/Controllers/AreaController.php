<?php

namespace App\Http\Controllers;

//Models
use App\Models\Area;

// Services
use App\Services\GetWeather;

//Auth
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AreaController extends Controller
{

    /**
     * 管理者だけeditpageに遷移
     * 
     * return view
     */
    public function toEditAreaPage()
    {
        //管理者じゃなかった場合はエラーページを返す
        if(Auth::check() && Auth::user()->admin){
            return view('area.edit');
        }
        return view('error.admin');
    }

    /**
     * エリア別のページを表示
     *
     * @param interger $area_id
     * return view
     */
    public function index($area_id){

        $weather = new GetWeather($area_id);

        $info = $weather->setInfo();

        return view('area',compact('info'));
    }
}

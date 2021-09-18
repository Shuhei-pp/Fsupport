<?php

namespace App\Http\Controllers;

//Models
use App\Models\BigArea;
use App\Models\Area;

//Services
use App\Services\GetApiContents;
use App\Services\GetWeather;

//Auth
use Illuminate\Support\Facades\Auth;

//Request
use Illuminate\Http\Request;

class AreaController extends Controller
{

    /**
     * Areastableにデータをプッシュ
     * 
     * @param Request $request
     * return redirect
     */
    public function editArea(Request $request)
    {

        $validated = $request->validate([
            $harbor_code = 'required|integer|between:1:1000',
            $area_name = 'required|string|max:10',
            $area_zip = 'required|string|max:8'
        ]);
        
        $area = new Area;

        $area->bigarea_id = $request->prefecture;
        $area->harbor_id = $request->harbor_code;
        $area->area_name = $request->area_name;
        $area->area_zip = $request->area_zip.",jp";

        $area->save();

        return redirect('area/edit');
    }

    /**
     * 管理者だけeditpageに遷移
     * 
     * return view
     */
    public function toEditAreaPage()
    {
        //管理者じゃなかった場合はエラーページを返す
        if(Auth::check() && Auth::user()->admin){
            $bigareas = Bigarea::all();
            return view('area.edit',compact('bigareas'));
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

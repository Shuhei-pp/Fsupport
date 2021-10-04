<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Fishingrecord;
use App\Models\Area;
use App\Models\User;

//DB
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MyPageController extends Controller
{

    /**
     * マイページに遷移する際のAPI
     * 
     * @param int $user_id
     * 
     * return Auth $user
     *        Area $areas
     *        obj $posts
     */
    public function showMyPage($user_id)
    {
        //ログインしていなかったらログインページへ返す
        if(!Auth::check()){
            return redirect(route('login'))->with('flash_message','ログインしてください');
        }
        $user = DB::table('users')->find($user_id);

        $areas = Area::all();

        //ここにこの処理を書いてもいいのかな...
        $posts = DB::table('areas')
                                ->leftjoin('fishingrecords', 'fishingrecords.area_id', '=', 'areas.id')
                                ->where('user_id', '=', $user_id)
                                ->orderBy('datetime','desc')
                                ->get();

        return view('user.mypage',compact('user','posts','areas'));
    }

}

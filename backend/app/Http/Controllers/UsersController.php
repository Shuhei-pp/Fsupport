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

class UsersController extends Controller
{
    
    /**
     * マイページへ遷移
     * 
     * return view
     */
    public function showMyPage($user_id)
    {
        //ログインしていなかったらログインページへ返す
        if(!Auth::check()){
            return redirect(route('login'))->with('flash_message','ログインしてください');
        }
        $user = Auth::user();
        $areas = Area::all();

        //ここにこの処理を書いてもいいのかな...
        $posts = DB::table('areas')
                                ->leftjoin('fishingrecords', 'fishingrecords.area_id', '=', 'areas.id')
                                ->where('user_id', '=', $user->id)
                                ->get();

        return view('user.mypage',compact('user','posts','areas'));
    }

    /**
     * adminだけをユーザー編集ページに遷移させる
     * 
     * return view
     */
    public function showEditPage()
    {
        //違った場合エラーページへ
        if(!(Auth::check() && Auth::user()->admin)){
            return view('error.admin');
        }

        $users = User::join('admin_ranks','users.admin','=','admin_ranks.id')->get();

        return view('user.list', compact('users'));
    }
}

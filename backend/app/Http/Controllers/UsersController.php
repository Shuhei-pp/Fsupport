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
     * ユーザー編集ページに遷移
     * 
     * @param int $user_id
     * return view
     */
    public function showEditPage($user_id)
    {
        if(!(Auth::check() && (Auth::user()->admin >= 1))){
            return view('error.admin');
        }

        $user = DB::table('users')
                    ->join('admin_ranks','users.admin','=','admin_ranks.id')
                    ->where('users.id',$user_id)
                    ->get();

        $admins = DB::table('admin_ranks')
                    ->get();

        return view('user.edit', compact('user','user_id','admins'));
    }

    /**
     * adminだけをユーザー一覧ページに遷移させる
     * 
     * return view
     */
    public function showListPage()
    {
        //違った場合エラーページへ
        if(!(Auth::check() && Auth::user()->admin)){
            return view('error.admin');
        }

        $users = User::select('users.id as user_id','users.email','admin_ranks.rank')
                    ->join('admin_ranks','users.admin','=','admin_ranks.id')
                    ->get();

        return view('user.list', compact('users'));
    }
}

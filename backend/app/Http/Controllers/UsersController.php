<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Fishingrecord;
use App\Models\Area;

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
        $posts = Fishingrecord::where('user_id',$user->id)->get();
        return view('user.mypage',compact('user','posts','areas'));
    }

    /**
     * adminだけをユーザー編集ページに遷移させる
     * 
     * return view
     */
    public function showEditPage()
    {
        if(Auth::check() && Auth::user()->admin){
            return view('user.edit');
        }
        return view('error.admin');
    }
}

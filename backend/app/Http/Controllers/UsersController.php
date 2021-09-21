<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

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
        var_dump($user_id);
        //ログインしていなかったらログインページへ返す
        if(Auth::check()){
            return view('user.mypage');
        }
        return redirect(route('login'))->with('flash_message','ログインしてください');
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

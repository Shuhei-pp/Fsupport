<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

//DB
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FishController extends Controller
{

    /**
     * 管理者専用の魚テーブル編集ページへ遷移
     */
    public function showListPage()
    {
        //編集者以上でない場合エラーページへ
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        $fishes = DB::table('fish_kinds')->get();

        return view('fish.list', compact('fishes'));
    }
}

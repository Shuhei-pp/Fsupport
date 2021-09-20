<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FishingRecordController extends Controller
{
    /**
     * 釣果を登録
     * 
     * Illuminate\Http\Request $request
     */
    public function create(Request $request){

        //ログインしていない場合ログインページへ遷移
        if (!(Auth::check()))
        {
            return redirect('login')->session('flash_message','釣果登録システムを利用する場合はログインしてください');
        }

        //バリデーションルール
        $rules = [
            'content' => 'required|string|max:256',
            'picture' => 'required|file|image|mines:jpeg,jpg,png|max:2048',
            'time' => 'required|before:"now"'
        ];

        $this->validate($request,$rules);

        
    }
}

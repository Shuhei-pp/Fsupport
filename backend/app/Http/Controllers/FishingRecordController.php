<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\FishingRecord;

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
            return redirect('login')->with('flash_message','釣果登録システムを利用する場合はログインしてください');
        }

        //バリデーションルール
        $rules = [
            'content' => 'required|string|max:256',
            'picture' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
            'time' => 'required|before:"now"'
        ];

        $this->validate($request,$rules);

        $frecord = new FishingRecord();
        $frecord->user_id = Auth::user()->id;
        $frecord->content = $request->content;
        $frecord->area_id = $request->area_id;
        $frecord->image_name = $request->picture;
        $frecord->time = $request->time;

        $frecord->save();

        return redirect('/')->with('flash_message','釣果登録が完了しました');
    }
}

<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Fishingrecord;
use App\Models\Area;
use App\Models\FrecordFishs;

//DB
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FishingRecordController extends Controller
{
    /**
     * 釣果レコードを削除
     * 
     * @param integer $fresult_id
     */
    public function delete($fresult_id){
        //非ログインはリダイレクト
        if(!Auth::check()){
            return redirect('login')->with('flash_message','ログインしてください');
        }

        $fresult = Fishingrecord::where('id', $fresult_id)->first();

        //投稿のuser_idとログインユーザーが一致しない場合もリダイレクト
        if(Auth::user()->id != $fresult->user_id){
            return redirect('login')->with('flash_message','投稿しているユーザーとは違うユーザーです。ログインし直してください');
        }

        $fresult->delete();

        return redirect(
            route('user.mypage',['user_id' => Auth::user()->id])
        )
        ->with('flash_message','釣果レコードを削除しました。');
    }


    /**
     * 釣果編集したものを保存
     * 
     * @param integer $fresult_id
     * @param Request $request
     * 
     */
    public function edit($fresult_id, Request $request)
    {
        //todo::同じ処理なのでまとめられるとこはまとめる
        //非ログインはリダイレクト
        if(!Auth::check()){
            return redirect('login')->with('flash_message','ログインしてください');
        }

        $fresult = Fishingrecord::where('id', $fresult_id)->first();

        //投稿のuser_idとログインユーザーが一致しない場合もリダイレクト
        if(Auth::user()->id != $fresult->user_id){
            return redirect('login')->with('flash_message','投稿しているユーザーとは違うユーザーです。ログインし直してください');
        }

        //バリデーションルール
        $rules = [
            'content' => 'required|string|max:256',
            'picture' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'date' => 'required|before:"now"',
            'time' => 'required'
        ];

        $this->validate($request,$rules);

        $image_path = $request->file('picture')->store('public/result_images/');

        $datetime = $request->date." ".$request->time;

        $frecord = Fishingrecord::find($fresult->id);
        $frecord->user_id = Auth::user()->id;
        $frecord->content = $request->content;
        $frecord->area_id = $request->area_id;
        $frecord->image_name = basename($image_path);
        //$frecord->time = $request->time;
        $frecord->datetime = $datetime;

        $frecord->save();

        return redirect('/')->with('flash_message','釣果編集が完了しました');
    }

    /**
     * 釣果編集ページに遷移
     * 
     * @param $fresult_id
     * return view
     */
    public function toEditPage($fresult_id)
    {
        //非ログインはリダイレクト
        if(!Auth::check()){
            return redirect('login')->with('flash_message','ログインしてください');
        }

        $fresult = Fishingrecord::where('id', $fresult_id)->first();
        $areas = Area::all();

        $datetime = explode(' ', $fresult->datetime);

        $date = $datetime[0];
        $time = $datetime[1];

        //user_idとログインユーザーが一致しない場合もリダイレクト
        if(Auth::user()->id != $fresult->user_id){
            return redirect('login')->with('flash_message','投稿しているユーザーとは違うユーザーです。ログインし直してください');
        }
        return view('fresult.p_edit',compact('fresult','areas','date','time'));
    }

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
            'picture' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'date' => 'required|before:"now"',
            'time' => 'required'
        ];

        $this->validate($request,$rules);

        $datetime = $request->date." ".$request->time;

        $image_path = $request->file('picture')->store('public/result_images/');

        $frecord = new Fishingrecord();
        $frecord->user_id = Auth::user()->id;
        $frecord->content = $request->content;
        $frecord->area_id = $request->area_id;
        $frecord->image_name = basename($image_path);
        $frecord->datetime = $datetime;

        $frecord->save();

        $fish_amount = new FrecordFishs();
        $fish_amount->frecord_id = $frecord->id;
        $fish_amount->fish_id = $request->fish_id;
        $fish_amount->fish_amount = $request->fish_amount;
        $fish_amount->save();

        return redirect(route('user.mypage',['user_id' => Auth::user()->id]))->with('flash_message','釣果登録が完了しました');
    }

    /**
     * homeで最近の釣果を一覧表示
     * 
     * return mix
     */
    public function frecordList() {
        $frecords = DB::table('fishingrecords')
                        ->select('fishingrecords.id as frecord_id','fishingrecords.*','areas.*','profiles.name','profiles.profile_image_name','frecord_fishs.fish_amount','fish_kinds.fish_name')
                        ->join('areas','fishingrecords.area_id','=','areas.id')
                        ->leftjoin('profiles','fishingrecords.user_id', '=','profiles.user_id')
                        ->leftjoin('frecord_fishs', 'fishingrecords.id', '=','frecord_fishs.frecord_id')
                        ->leftjoin('fish_kinds', 'frecord_fishs.fish_id', '=', 'fish_kinds.fish_id')
                        ->orderBy('datetime','desc')
                        ->limit(10)
                        ->get();
        return $frecords;
    }

    /**
     * areaページで最近のそのエリアの釣果を一覧表示
     * 
     * @params integer area_id
     * 
     * return mix
     */
    public function areaFrecordList($area_id)
    {
        $frecords = DB::table('fishingrecords')
                            ->join('users','users.id','=','fishingrecords.user_id')
                            ->leftjoin('profiles','fishingrecords.user_id', '=','profiles.user_id')
                            ->leftjoin('frecord_fishs', 'fishingrecords.id', '=','frecord_fishs.frecord_id')
                            ->leftjoin('fish_kinds', 'frecord_fishs.fish_id', '=', 'fish_kinds.fish_id')
                            ->where('fishingrecords.area_id','=',$area_id)
                            ->orderBy('datetime','desc')
                            ->limit(10)
                            ->get();

        return $frecords;
    }
     

    /**
     * apiで1つの釣果を取得
     * 
     * int frecordid
     * return mix
     */
    public function frecordApi($frecord_id){
        $frecord = DB::table('fishingrecords')
                                ->select('fishingrecords.id as frecord_id','fishingrecords.*','areas.*','profiles.name','frecord_fishs.fish_amount','fish_kinds.fish_name')
                                ->join('areas','fishingrecords.area_id','=','areas.id')
                                ->leftjoin('profiles','fishingrecords.user_id', '=','profiles.user_id')
                                ->leftjoin('frecord_fishs', 'fishingrecords.id', '=','frecord_fishs.frecord_id')
                                ->leftjoin('fish_kinds', 'frecord_fishs.fish_id', '=', 'fish_kinds.fish_id')
                                ->where('fishingrecords.id', '=', $frecord_id)
                                ->first();
        return $frecord;
    }
}

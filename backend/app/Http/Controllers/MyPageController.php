<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Area;
use App\Models\Profile;


//DB
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MyPageController extends Controller
{

    /**
     * マイページに遷移する
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
        $user = DB::table('users')
                ->select('users.*','profiles.name','profiles.profile_image_name','profiles.profile_text',)
                ->leftjoin('profiles','profiles.user_id','=','users.id')
                ->where('users.id',$user_id)
                ->first();

        $areas = Area::all();

        $posts = DB::table('areas')
                                ->select('areas.*','fishingrecords.*','fishingrecords.id as id', 'frecord_fishs.fish_amount', 'fish_kinds.fish_name')
                                ->leftjoin('fishingrecords', 'fishingrecords.area_id', '=', 'areas.id')
                                ->leftjoin('frecord_fishs', 'fishingrecords.id', '=','frecord_fishs.frecord_id')
                                ->leftjoin('fish_kinds', 'frecord_fishs.fish_id', '=', 'fish_kinds.fish_id')
                                ->where('user_id', '=', $user_id)
                                ->orderBy('datetime','desc')
                                ->get();

        $fishes = DB::table('fish_kinds')->get();

        return view('user.mypage',compact('user','posts','areas','fishes'));
    }

    /**
     * プロフィール編集ページへ
     * 
     * @param int $user_id
     * return view
     */
    public function toEditProfile($user_id)
    {
        //ログインチェック
        if(!(Auth::check() && (Auth::user()->id == $user_id))){
            return redirect( route('login') )->with('flash_message','ログインしてください');
        }

        $profile = DB::table('profiles')->where('user_id','=',$user_id)->first();

        return view('user.editprofile', compact('user_id','profile'));
    }

    /**
     * プロフィールを編集
     * 
     * @param int $user_id
     * @param Request $request
     */
    public function editProfile($user_id, Request $request)
    {
        //ログインチェック
        if(!(Auth::check() && (Auth::user()->id == $user_id))){
            return redirect( route('login') )->with('flash_message','ログインしてください');
        }

        //バリデーションルール
        $rules = [
            'name' => 'required|string|max:128',
            'text' => 'max:256',
            'picture' => 'image|mimes:jpeg,jpg,png|max:2048'
        ];

        $this->validate($request, $rules);

        $profile = Profile::where('user_id', '=', $user_id)->first();

        if(!$profile){
        //新規登録時
            $profile = new Profile();
        }


        $profile->user_id = $user_id;
        $profile->name = $request->name;
        $profile->profile_text = $request->text;
        if($request->picture){
            $image_path = $request->file('picture')->store('public/profile_image');
            $profile->profile_image_name = basename($image_path);
        }

        $profile->save();

        return redirect( route('user.mypage',['user_id' => $user_id]) )->with('flash_message','プロフィールを編集しました。');
    }
}

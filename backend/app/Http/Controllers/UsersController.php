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
     * vueのエリアページからマイページへ遷移
     * 
     * return redirect
     */
    public function goToMyPage()
    {
        if(!(Auth::check())){
            return redirect(route('login'))->with('flash_message','ログインしてください');
        }

        return redirect( route('user.mypage',['user_id' => Auth::id()] ));
    }

    /**
     * ユーザー編集ページに遷移
     * 
     * @param int $user_id
     * return view
     */
    public function showEditPage($user_id)
    {
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
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
     * ユーザー情報を削除
     * 
     * @param int $user_id
     * return redirect
     */
    public function delete($user_id)
    {
        if(!(Auth::check() && Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER'))) {
            return redirect( route('error.admin') );
        }

        $user = User::find($user_id);

        //自分を利用停止にすることはできない
        if($user_id == Auth::user()->id){
            return redirect( route('user.list'))->with('flash_message','自分を利用停止にすることはできません。');
        }

        //自分よりも高い権限or自分と同じ権限は利用停止にできない
        if($user->admin >= Auth::user()->admin){
            return redirect( route('user.list') )->with('flash_message','自分の権限以上のユーザーは利用停止にすることができません');
        }

        //既に利用停止の場合
        if($user->disabled_status == config('const.DISABLED_STATUS.DISABLED')){
            return redirect( route('user.list') )->with('flash_message','自分の権限以上のユーザーは利用停止にすることができません');
        }

        $user->disabled_status = config('const.DISABLED_STATUS.DISABLED');
        $user->save();

        return redirect( route('user.list'))->with('flash_message','利用停止にしました。');
    }

    /**
     * ユーザー情報の修正内容を保存
     *
     * @param int $user_id
     * @param Request $request
     *
     * return redirect
     */
    public function edit(Request $request,$user_id){
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        $user = User::find($user_id);

        //自分の権限は編集できない
        if($user_id == Auth::id()){
            return redirect( route('user.list') )->with('flash_message','自分の権限を設定することはできません。');
        }

        //自分よりも高い権限設定は禁止
        if($request->admin_id > Auth::user()->admin){
            return redirect( route('user.list') )->with('flash_message','他のユーザーに自分より高い権限を設定することはできません。');
        }

        //自分よりも高い権限のユーザーは編集できない
        if($user->admin > Auth::user()->admin){
            return redirect( route('user.list') )->with('flash_message','自分より高い権限のユーザーを設定することはできません。');
        }

        $user->admin = $request->admin_id;
        $user->save();

        return redirect( route('user.list') )->with('flash_message','修正しました');
    }

    /**
     * adminだけをユーザー一覧ページに遷移させる
     * 
     * return view
     */
    public function showListPage()
    {
        //違った場合エラーページへ
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        $users = User::select('users.id as user_id','users.email','admin_ranks.rank','disableds.disabled_id','disableds.disabled_status_name')
                    ->join('admin_ranks','users.admin','=','admin_ranks.id')
                    ->leftjoin('disableds','users.disabled_status','=','disableds.disabled_id')
                    ->get();

        return view('user.list', compact('users'));
    }
}

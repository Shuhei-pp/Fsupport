<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

//model 
use App\Models\FishKind;

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


    /**
     * 管理者用の魚追加ページへ遷移
     */
    public function showCreatePage()
    {
        //編集者以上でない場合エラーページへ
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        return view('fish.create');
    }

    /**
     * 管理者用の魚追加ページへ遷移
     * 
     * @param int $fish_id
     */
    public function toEditPage($fish_id)
    {
        //編集者以上でない場合エラーページへ
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        $fish = DB::table('fish_kinds')
                        ->select('fish_kinds.*','users.email')
                        ->where('fish_id','=',$fish_id)
                        ->join('users','fish_kinds.create_user_id','=','users.id')
                        ->first();

        return view('fish.edit',compact('fish') );
    }

    /**
     * 魚テーブルにpost
     * 
     * @param Request $request
     */
    public function create(Request $request)
    {
        //編集者以上でない場合エラーページへ
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        $this->validate($request,[ 'fish_name' => 'required|string|max:16' ]);

        //fish_kindsにinsert
        DB::table('fish_kinds')->insert(
            [
                'fish_name' => $request->fish_name,
                'create_user_id' => Auth::user()->id
            ]
        );

        return redirect( route('fish.list'))->with('flash_message','魚を追加しました。');
    }


    /**
     * 魚レコードを編集
     * 
     * @param Request $request
     * @param int $fish_id
     */
    public function edit(Request $request,$fish_id)
    {
        //編集者以上でない場合エラーページへ
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        $this->validate($request,[ 'fish_name' => 'required|string|max:16' ]);

        FishKind::where('fish_id',$fish_id)
                        ->update([
                            'fish_name' => $request->fish_name,
                            'create_user_id' => Auth::id()
                        ]
        );

        return redirect(route('fish.list'))->with('flash_message','魚を編集しました。');
    }

    /**
     * 魚レコードを削除
     * 
     * @param int $fish_id
     */
    public function delete($fish_id)
    {
        //編集者以上でない場合エラーページへ
        if(!(Auth::check() && (Auth::user()->admin >= config('const.ADMIN_RANK.PRE_ADMINER')))){
            return view('error.admin');
        }

        FishKind::where('fish_id',$fish_id)->delete();

        return redirect(route('fish.list'))->with('flash_message','魚を削除しました');
    }
}

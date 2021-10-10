<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Model
use App\Models\Comment;

//Auth
use Illuminate\Support\Facades\Auth;

//DB
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * apiでrequestを受け取り、dbにstore
     * 
     * @param Request $request
     */
    public function post(Request $request){
        //バリデーション追加するように
        Comment::create([
            'comment_user_id' => $request->user_id,
            'comment_frecord_id' => $request->frecord_id,
            'comment_text' => $request->text,
        ]);
    }

    /**
     * apiでコメントのリストを取得
     * 
     * @param int $frecord_id
     */
    public function getCommentList($frecord_id){
        return DB::table('comments')
                ->join('users','comments.comment_user_id','=','users.id')
                ->leftjoin('profiles','profiles.user_id','=','users.id')
                ->where('comments.comment_frecord_id','=',$frecord_id)
                ->get();
    }
}

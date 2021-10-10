<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Model
use App\Models\Comment;

//Auth
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * apiでrequestを受け取り、dbにstore
     * 
     * @param Request $request
     */
    public function post(Request $request){
        
        Comment::create([
            'comment_user_id' => $request->user_id,
            'comment_frecord_id' => $request->frecord_id,
            'comment_text' => $request->text,
        ]);
    }
}

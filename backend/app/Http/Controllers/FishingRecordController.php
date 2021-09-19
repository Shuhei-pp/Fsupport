<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FishingRecordController extends Controller
{
    /**
     * 釣果を登録
     * 
     * Illuminate\Http\Request $request
     */
    public function post(Request $request){
        //バリデーションルール
        $rules = [
            'content' => 'require|string|max:256',
            'picture' => 'file|image|mines:jpeg,jpg,png|max:2048',
            'time' => 'require|before:"now"'
        ];

        $this->validate($request,$rules);

        
    }
}

<?php

namespace App\Http\Controllers;

//Auth
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    /**
     * adminだけをユーザー編集ページに遷移させる
     * 
     * return view
     */
    public function showEditPage()
    {
        return view('user.edit');
    }
}

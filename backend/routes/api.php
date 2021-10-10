<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Auth
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//vue api routing

//エリア系ルーティング
Route::get('/', 'App\Http\Controllers\AreaController@index');
Route::get('/area/{area_id}', 'App\Http\Controllers\AreaController@showArea');

//釣果系APIルーティング
Route::get('/home/frecord/list', 'App\Http\Controllers\FishingRecordController@frecordList');
Route::get('/frecord/{frecord_id}', 'App\Http\Controllers\FishingRecordController@frecordApi');

//コメント系APIルーティング
Route::post('/comment/post', 'App\Http\Controllers\CommentController@post');

//ログイン中のユーザーをAPIで取得
Route::group(['middleware' => 'api'], function() {
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
    Route::get('/current_user', function (){
        return Auth::user();
    });
});



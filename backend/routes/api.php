<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//釣果系ルーティング
Route::post('/fresult/create', [App\Http\Controllers\FishingRecordController::class,'create']);
/*
Route::get('/fresult/edit/{fresult_id}', [App\Http\Controllers\FishingRecordController::class, 'toEditPage'])->name('edit.fresult');
Route::post('/fresult/edit/{fresult_id}', [App\Http\Controllers\FishingRecordController::class, 'edit'])->name('send.edit.fresult');
Route::get('/fresult/delete/{fresult_id}',[App\Http\Controllers\FishingRecordController::class, 'delete'])->name('delete.fresult');
*/

//ユーザー系ルーティング
/*Route::get('/user/list', [App\Http\Controllers\UsersController::class,'showListPage'])->name('user.list');
Route::get('/user/edit/{user_id}', [App\Http\Controllers\UsersController::class,'showEditPage'])->name('user.edit');
Route::post('/user/edit/{user_id}', [App\Http\Controllers\UsersController::class,'edit'])->name('post.edit.user');
Route::get('/user/delete/{user_id}', [App\Http\Controllers\UsersController::class,'delete'])->name('user.delete');*/
Route::get('/user/mypage/{user_id}', [App\Http\Controllers\MyPageController::class,'apiForMyPage']);


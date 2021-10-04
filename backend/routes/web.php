<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//vue routing
Route::get('/',function(){
    return view('vue.app');
})->where('any','.*');

Route::get('/area/{area_id}',function(){
    return view('vue.app');
})->where('any','.*');


// check: routeは->name()で名前をつけられる！　viewのURL修正も楽になるから修正しよう
//エリア系ルーティング
//Route::get('/', [App\Http\Controllers\AreaController::class,'index']);
Route::get('/area/new/edit', [App\Http\Controllers\AreaController::class,'toEditAreaPage'])->name('area_edit');
Route::post('/area/edit', [App\Http\Controllers\AreaController::class,'addArea']);
//Route::get('/area/{area_id}', [App\Http\Controllers\AreaController::class,'showArea'])->name('area.show');

//ユーザー系ルーティング
Route::get('/user/list', [App\Http\Controllers\UsersController::class,'showListPage'])->name('user.list');
Route::get('/user/edit/{user_id}', [App\Http\Controllers\UsersController::class,'showEditPage'])->name('user.edit');
Route::post('/user/edit/{user_id}', [App\Http\Controllers\UsersController::class,'edit'])->name('post.edit.user');
Route::get('/user/delete/{user_id}', [App\Http\Controllers\UsersController::class,'delete'])->name('user.delete');
Route::get('/user/gotomypage', [App\Http\Controllers\UsersController::class,'goToMyPage'])->name('gotomypage');
Route::get('/user/mypage/{user_id}', [App\Http\Controllers\MyPageController::class,'showMyPage'])->name('user.mypage');

//釣果系ルーティング
Route::post('/fresult/create', [App\Http\Controllers\FishingRecordController::class,'create'])->name('create.fresult');
Route::get('/fresult/edit/{fresult_id}', [App\Http\Controllers\FishingRecordController::class, 'toEditPage'])->name('edit.fresult');
Route::post('/fresult/edit/{fresult_id}', [App\Http\Controllers\FishingRecordController::class, 'edit'])->name('send.edit.fresult');
Route::get('/fresult/delete/{fresult_id}',[App\Http\Controllers\FishingRecordController::class, 'delete'])->name('delete.fresult');

Route::post('/register/pre_check', 'App\Http\Controllers\Auth\RegisterController@preCheck')->name('register.pre_check');
Route::get('/register/verify/{token}', 'App\Http\Controllers\Auth\RegisterController@showMyPage');

//Auth
Auth::routes();


/*
Route::get('/welcome', function () {
    return view('welcome');
});
*/
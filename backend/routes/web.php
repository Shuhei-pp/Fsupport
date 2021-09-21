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

Route::get('/welcome', function () {
    return view('welcome');
});

// check: routeは->name()で名前をつけられる！　viewのURL修正も楽になるから修正しよう
Route::post('/register/pre_check', 'App\Http\Controllers\Auth\RegisterController@preCheck')->name('register.pre_check');

Route::get('/register/verify/{token}', 'App\Http\Controllers\Auth\RegisterController@showMyPage');

Route::get('/', [App\Http\Controllers\AreaController::class,'index']);
Route::get('/area/edit', [App\Http\Controllers\AreaController::class,'toEditAreaPage'])->name('area_edit');
Route::post('/area/edit', [App\Http\Controllers\AreaController::class,'addArea']);
Route::get('/area/{area_id}', [App\Http\Controllers\AreaController::class,'showArea'])->name('area.show');

Route::get('/user/edit', [App\Http\Controllers\UsersController::class,'showEditPage'])->name('user.edit');
Route::get('/user/mypage/{user_id}', [App\Http\Controllers\UsersController::class,'showMyPage'])->name('user.mypage');

Route::post('/post/create', [App\Http\Controllers\FishingRecordController::class,'create'])->name('create_catch_result');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

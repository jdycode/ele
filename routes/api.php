<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//商家列表
Route::domain('www.ele.com')->group(function (){
    //得到商家列表接口
    Route::get('shop/list','Api\ShopController@list');
    //得到商家信息接口
    Route::get('shop/index','Api\ShopController@index');
});

//会员注册接口
Route::post('member/reg','Api\MemberController@reg');
//发送短信验证接口
Route::any('member/sms','Api\MemberController@sms');
//会员登录接口
Route::any('member/login','Api\MemberController@login');
//重置密码接口
Route::any('member/forget','Api\MemberController@forget');
//修改密码接口
Route::any('member/changePassword','Api\MemberController@changePassword');


